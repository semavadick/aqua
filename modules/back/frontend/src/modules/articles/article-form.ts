import {Injectable} from "@angular/core";
import {BackendService} from "../../services/backend.service";
import {LanguagesManager} from "../../services/languages-manager";
import {PublicationForm} from "../publications/publication-form";
import {Category} from "../catalog/categories/category";

@Injectable()
export class ArticleForm extends PublicationForm {

    public categoriesIds: number[] = [];

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackendUrl():string {
        return 'articles';
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    reset():any {
        super.reset();
        this.categoriesIds = [];
    }

    populate(data:any): any {
        super.populate(data);
        this.categoriesIds = data['categoriesIds'];
    }

    getData():any {
        return Object.assign(super.getData(), {
            categoriesIds: this.categoriesIds,
        });
    }

    public getCategories(): Category[] {
        var categories: Category[] = [];
        for(let id of this.categoriesIds) {
            var category = new Category();
            category.id = id;
            categories.push(category);
        }
        return categories;
    }

    public setCategories(categories: Category[]) {
        this.categoriesIds = [];
        for(let category of categories) {
            this.categoriesIds.push(category.id);
        }
    }

}