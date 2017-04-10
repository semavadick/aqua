import {Injectable} from '@angular/core';
import {MyDatatableSearchForm} from "../../../common/my-datatable/my-datatable-search-form";
import {OrderForm} from "../order-form/order-form";
import {OrdersManager} from "../orders-manager";
import {BackendService} from "../../services/backend.service";

@Injectable()
export class SearchForm implements MyDatatableSearchForm {

    public id: number;
    public status: number = null;
    public clientId: number = null;

    public statuses: Object[] = [
        {
            id: null,
            label: 'Любой',
        },
    ];

    public clients: Object[] = [
        {
            id: null,
            text: 'Любой',
        },
    ];

    public constructor(public manager: OrdersManager) {
        this.statuses = this.statuses.concat(OrderForm.statuses);
        this.clients = this.clients.concat(this.manager.clients);
    }

    public getAttributes(): Object {
        return {
            id: this.id,
            status: this.status,
            clientId: this.clientId,
        };
    }

}