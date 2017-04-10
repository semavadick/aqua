import {Injectable} from '@angular/core';
import {MyDatatableSearchForm} from "../../common/my-datatable/my-datatable-search-form";

@Injectable()
export class PublicationsSearchForm implements MyDatatableSearchForm {

    public id: number;
    public name: number;

    public getAttributes(): Object {
        return {
            id: this.id,
            name: this.name,
        };
    }

}