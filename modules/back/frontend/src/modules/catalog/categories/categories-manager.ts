import { Component, Injectable } from '@angular/core';
import { Response } from '@angular/http';
import {Category} from "./category";
import {BackendService} from "../../../services/backend.service";

@Injectable()
export class CategoriesManager {

    public isLoading = false;

    public categories: Category[] = [];

    private backendUrl: string = 'catalog/categories';

    public constructor(private backend: BackendService) { }

    public loadCategories():Promise<string> {
        this.isLoading = true;
        return new Promise<string>((resolve, reject) => {
            this.backend.get(this.backendUrl)
                .then((resp: Response) => {
                    this.isLoading = false;
                    this.categories = [];
                    for(let categoryData of resp.json()) {
                        this.categories.push(this.getCategoryFromData(categoryData));
                    }
                    resolve('ok');
                })
                .catch((resp: Response) => {
                    reject(resp.text());
                })
        });
    }

    private getCategoryFromData(data: any): Category {
        var category = new Category();
        category.id = data['id'];
        category.name = data['name'];
        for(let childData of data['children']) {
            category.children.push(this.getCategoryFromData(childData));
        }
        return category;
    }

    public deleteCategory(category: Category):Promise<string> {
        this.isLoading = true;
        var url = this.backendUrl + '/' + category.id;
        return new Promise<string>((resolve, reject) => {
            this.backend.delete(url)
                .then((resp: Response) => {
                    this.isLoading = false;
                    resolve('ok');
                })
                .catch((resp: Response) => {
                    reject(resp.text());
                })
        });
    }

    public sortCategories(categories: Category[], parent: Category) {
        this.isLoading = true;
        var url = this.backendUrl + '/sort';
        var categoriesIds: number[] = [];
        for(let category of categories) {
            categoriesIds.push(category.id);
        }
        var options = {
            parentId: parent ? parent.id : null,
            categoriesIds: categoriesIds
        };
        this.backend.put(url, options)
            .then((resp: Response) => {
                this.isLoading = false;
            })
            .catch((resp: Response) => {
                this.isLoading = false;
                alert(resp.text());
            })
    }

}
