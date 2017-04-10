import {Injectable} from '@angular/core';
import {MyDatatableSearchForm} from "../../../../common/my-datatable/my-datatable-search-form";
import {AdditionCategory} from "../../addition-categories/addition-category";

@Injectable()
export class AdditionSearchForm implements MyDatatableSearchForm {

    public name: string;

    public sku: string;

    private category: AdditionCategory = null;

    public setCategory(category: AdditionCategory) {
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