import {Injectable} from "@angular/core";
import {Response} from "@angular/http";
import {MyDatatableManager} from "../../common/my-datatable/my-datatable-manager";
import {BackendService} from "../../services/backend.service";
import {MyDatatableEntity} from "../../common/my-datatable/my-datatable-entity";
import {Order} from "./order";

@Injectable()
export class OrdersManager extends MyDatatableManager {

    public clients: Object = [];

    constructor(private backend: BackendService) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getEntityFromData(data:any): MyDatatableEntity {
        var order = new Order(data['id']);
        Object.assign(order, data);
        return order;
    }

    protected getBackendUrl():string {
        return 'orders';
    }

}