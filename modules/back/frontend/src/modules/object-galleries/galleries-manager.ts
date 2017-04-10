import {Injectable} from "@angular/core";
import {Response} from "@angular/http";
import {MyDatatableManager} from "../../common/my-datatable/my-datatable-manager";
import {BackendService} from "../../services/backend.service";
import {MyDatatableEntity} from "../../common/my-datatable/my-datatable-entity";
import {Gallery} from "./gallery";

@Injectable()
export class GalleriesManager extends MyDatatableManager {

    public poolTypes: Array<any> = [];

    constructor(private backend: BackendService) {
        super();
    }

    public loadPoolTypes(): Promise<string> {
        return new Promise<string>((resolve, reject) => {
            var url = this.getBackendUrl() + '/pool-types';
            this.getBackend().get(url)
                .then((resp: Response) => {
                    this.poolTypes = [];
                    for(let typeData of resp.json()) {
                        this.poolTypes.push(typeData);
                    }
                    resolve('ok');
                })
                .catch((resp: Response) => {
                    reject(resp.text());
                });
        });
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getEntityFromData(data:any): MyDatatableEntity {
        var gallery = new Gallery(data['id']);
        Object.assign(gallery, data);
        return gallery;
    }

    protected getBackendUrl():string {
        return 'object-galleries';
    }

}