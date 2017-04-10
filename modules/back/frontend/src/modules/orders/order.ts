import {MyDatatableEntity} from "../../common/my-datatable/my-datatable-entity";

export class Order extends MyDatatableEntity {

    public client: string;
    public totalCost: number;
    public statusLabel: string;
    public added: string;

}