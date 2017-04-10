import { Injectable } from '@angular/core';
import { Response } from '@angular/http';
import { BackendService } from "../../../services/backend.service";
import { CrudGridEntityManager } from "../../../common/crud-grid/crud-grid-entity-manager";
import { CrudGridEntity } from "../../../common/crud-grid/crud-grid-entity";

@Injectable()
export class OfficesManager extends CrudGridEntityManager {

    public regions: Array<any> = [];

    public constructor(private backend: BackendService) {
        super();
    }

    public loadRegions(): Promise<string> {
        return new Promise<string>((resolve, reject) => {
            var url = this.getBackendUrl() + '/regions';
            this.getBackend().get(url)
                .then((resp: Response) => {
                    this.regions = [];
                    for(var regionData of resp.json()) {
                        this.regions.push(regionData);
                    }
                    resolve('ok');
                })
                .catch((resp: Response) => {
                    reject(resp.text());
                });
        });
    }

    protected getBackend(): BackendService {
        return this.backend;
    }

    protected getBackendUrl(): string {
        return 'about-page/offices';
    }

}