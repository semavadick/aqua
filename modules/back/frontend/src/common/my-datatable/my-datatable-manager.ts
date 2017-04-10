import {MyDatatableEntity} from "./my-datatable-entity";
import {BackendService} from "../../services/backend.service";
import {Response} from "@angular/http";
import {MyDatatablePagination} from "./my-datatable-pagination";
import {MyDatatableSort} from "./my-datatable-sort";
import {MyDatatableSearchForm} from "./my-datatable-search-form";

export abstract class MyDatatableManager {

    public isLoading: boolean = false;

    public entities: MyDatatableEntity[] = [];

    private pagination: MyDatatablePagination = null;
    private sort: MyDatatableSort = null;
    private searchForm: MyDatatableSearchForm = null;

    protected abstract getBackend(): BackendService;
    protected abstract getEntityFromData(data: any): MyDatatableEntity;
    protected abstract getBackendUrl(): string;

    public setPagination(pagination: MyDatatablePagination) {
        this.pagination = pagination;
    }

    public setSort(sort: MyDatatableSort) {
        this.sort = sort;
    }

    public setSearchForm(form: MyDatatableSearchForm) {
        this.searchForm = form;
    }

    public loadEntities() {
        this.isLoading = true;
        var pagination = this.pagination;
        var sort = this.sort;
        var url = this.getBackendUrl();
        url += '/' + pagination.getOffset() + '-' + pagination.limit;
        url += '/' + sort.attribute + '-' + sort.direction;
        if(this.searchForm) {
            url += '/' + JSON.stringify(this.searchForm.getAttributes());
        }
        this.getBackend().get(url)
            .then((resp: Response) => {
                var data = resp.json();
                this.entities = [];
                for(var entityData of data['entities']) {
                    this.entities.push(this.getEntityFromData(entityData))
                }
                this.pagination.total = data['total'];
                this.isLoading = false;
            })
            .catch((resp: Response) => {
                alert(resp.text());
            });
    }

    public deleteEntity(entity: MyDatatableEntity) {
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

    protected sortEntity(entityIndex, siblingEntityIndex) {
        var sortEntity = this.entities[entityIndex];
        var newEntities = [],
            ids = [];

        if(siblingEntityIndex != null) {
            var siblingEntity = this.entities[siblingEntityIndex];
            if(this.sort.direction == 0) {
                sortEntity.sort = (sortEntity.sort > siblingEntity.sort) ? siblingEntity.sort : (siblingEntity.sort - 1);
            } else {
                sortEntity.sort = (sortEntity.sort < siblingEntity.sort) ? siblingEntity.sort : (siblingEntity.sort + 1);
            }

            var i = (this.sort.direction == 0) ? 1 : this.entities.length;
            for(let entity of this.entities) {
                if(entity.id == sortEntity.id) continue;
                if(sortEntity.sort == i) {
                    newEntities.push(sortEntity);
                    ids.push(sortEntity.id);
                    if(this.sort.direction == 0){
                        i++;
                    }  else i--;
                }
                entity.sort = i;
                newEntities.push(entity);
                ids.push(entity.id);
                if(this.sort.direction == 0){
                    i++;
                }  else i--;
            }
        } else {
            sortEntity.sort = (this.sort.direction == 0) ? this.entities.length : 1;
            var i = (this.sort.direction == 0) ? 1 : this.entities.length;
            for(let entity of this.entities) {
                if(entity.id == sortEntity.id) continue;
                entity.sort = i;
                newEntities.push(entity);
                ids.push(entity.id);
                if(this.sort.direction == 0){
                    i++;
                }  else i--;
            }
            newEntities.push(sortEntity);
            ids.push(sortEntity.id);
        }
        this.entities = newEntities;

        var url = this.getBackendUrl() + '/sort';
        this.getBackend().post(url, {'ids': ids, 'direction': this.sort.direction})
            .then((resp: Response) => {

            })
            .catch((resp: Response) => {
                alert(resp.text());
            });
    }

}