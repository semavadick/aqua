import { CrudGridEntity } from "./crud-grid-entity";
import { Response } from "@angular/http";
import { BackendService } from "../../services/backend.service";

export abstract class CrudGridEntityManager {

    public isLoading = false;

    public entities: CrudGridEntity[];

    protected abstract getBackend(): BackendService;
    protected abstract getBackendUrl(): string;

    public loadEntities() {
        this.isLoading = true;
        this.getBackend().get(this.getBackendUrl())
            .then((resp: Response) => {
                this.entities = [];
                for(var entityData of resp.json()) {
                    var entity = new CrudGridEntity();
                    Object.assign(entity, entityData);
                    this.entities.push(entity);
                }
                this.isLoading = false;
            })
            .catch((resp: Response) => {
                alert(resp.text());
            });
    }

    public deleteEntity(entity: CrudGridEntity) {
        this.isLoading = true;
        var url = this.getBackendUrl() + '/' + entity.id;
        this.getBackend().delete(url)
            .then((resp: Response) => {
                this.isLoading = false;
                this.loadEntities();
            })
            .catch((resp: Response) => {
                alert(resp.text());
            })
    }

}