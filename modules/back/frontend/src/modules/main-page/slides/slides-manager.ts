import { Injectable } from '@angular/core';
import { BackendService } from "../../../services/backend.service";
import { CrudGridEntityManager } from "../../../common/crud-grid/crud-grid-entity-manager";

@Injectable()
export class SlidesManager extends CrudGridEntityManager {

    public constructor(private backend: BackendService) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getBackendUrl():string {
        return 'main-page/slides';
    }

}