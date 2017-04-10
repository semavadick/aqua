import { Injectable } from '@angular/core';
import { BackendService } from "../../../services/backend.service";
import { CrudGridEntityManager } from "../../../common/crud-grid/crud-grid-entity-manager";

@Injectable()
export class ProductionBannersManager extends CrudGridEntityManager {

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getBackendUrl():string {
        return 'about-page/production-banners';
    }

    public constructor(private backend: BackendService) {
        super();
    }

}