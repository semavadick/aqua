import { Injectable } from '@angular/core';
import { BackendService } from "../../../services/backend.service";
import { CrudGridEntityManager } from "../../../common/crud-grid/crud-grid-entity-manager";

@Injectable()
export class CertificatesManager extends CrudGridEntityManager {

    public constructor(private backend: BackendService) {
        super();
    }

    public callbackSort(items) {
        var url = this.getBackendUrl() + '/sort';
        this.getBackend().post(url, {'items': items})
            .then((resp: Response) => {

            })
            .catch((resp: Response) => {
                alert(resp.text());
            });
    }

    protected getBackend(): BackendService {
        return this.backend;
    }

    protected getBackendUrl(): string {
        return 'about-page/certificates';
    }

}