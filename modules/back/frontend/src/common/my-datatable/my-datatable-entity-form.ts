import {EntityForm} from "../entity-form";
import {MyDatatableEntity} from "./my-datatable-entity";

export abstract class MyDatatableEntityForm extends EntityForm {

    private entity: MyDatatableEntity = null;

    protected abstract getBackendUrl(): string;

    public init(entity: MyDatatableEntity = null): Promise<string> {
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