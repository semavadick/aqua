import {MyDatatableEntity} from "../../common/my-datatable/my-datatable-entity";

export class User extends MyDatatableEntity {

    public email: string;
    public phone: string;
    public fullName: string;
    public companyName: string;
    public type: string;
    public ordersCount: number;
    public companyInfoFileUrl: number;

}