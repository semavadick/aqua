import {Injectable} from "@angular/core";
import {MyDatatableManager} from "../../common/my-datatable/my-datatable-manager";
import {BackendService} from "../../services/backend.service";
import {MyDatatableEntity} from "../../common/my-datatable/my-datatable-entity";
import {User} from "./user";

@Injectable()
export class UsersManager extends MyDatatableManager {

    constructor(private backend: BackendService) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getEntityFromData(data:any): MyDatatableEntity {
        var article = new User(data['id']);
        Object.assign(article, data);
        return article;
    }

    protected getBackendUrl():string {
        return 'users';
    }

}