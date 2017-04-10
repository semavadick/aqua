import {Injectable} from '@angular/core';
import {MyDatatableSearchForm} from "../../../../common/my-datatable/my-datatable-search-form";
import {Category} from "../../categories/category";

@Injectable()
export class SearchForm implements MyDatatableSearchForm {

    public name: string;

    public sku: string;

    private category: Category = null;

    public setCategory(category: Category) {
        this.category = category;
    }

    public getAttributes(): Object {
        return {
            name: this.name,
            sku: this.sku,
            categoryId: this.category ? this.category.id : null,
        };
    }

}