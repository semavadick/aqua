import {EntityForm} from "../entity-form";
import {CrudGridEntity} from "./crud-grid-entity";

export abstract class CrudGridEntityForm extends EntityForm {

    private entity: CrudGridEntity = null;

    protected abstract getBackendUrl(): string;

    public init(entity: CrudGridEntity = null): Promise<string> {
        this.entity = entity;
        if(!entity) {
            return this.initLocally();
        }
        return this.initFromUrl(this.getBackendUrl() + '/' + entity.id);
    }

    public save(): Promise<string> {
        var url = this.getBackendUrl();
        var isNewEntity = true;
        if(this.entity) {
            url += '/' + this.entity.id;
            isNewEntity = false;
        }
        return this.saveViaUrl(url, isNewEntity);
    }

}