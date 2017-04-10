import {MyDatatableEntity} from "../../../common/my-datatable/my-datatable-entity";

export class Product extends MyDatatableEntity {

    public id: number;
    public name: string;
    public sku: string;
    public type: number;
    public sort: number;
}