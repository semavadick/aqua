import {Injectable} from '@angular/core';
import {MyDatatableSearchForm} from "../../../common/my-datatable/my-datatable-search-form";

@Injectable()
export class SearchForm implements MyDatatableSearchForm {

    public id: number;
    public phone: number;
    public email: number;
    public companyName: number;

    public getAttributes(): Object {
        return {
            id: this.id,
            phone: this.phone,
            email: this.email,
            companyName: this.companyName,
        };
    }

}