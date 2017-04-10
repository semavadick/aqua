import {Injectable} from "@angular/core";
import {MyDatatableManager} from "../../../common/my-datatable/my-datatable-manager";
import {BackendService} from "../../../services/backend.service";
import {MyDatatableEntity} from "../../../common/my-datatable/my-datatable-entity";
import {Product} from "./product";

@Injectable()
export class ProductsManager extends MyDatatableManager {

    private drakeInstance = null;

    constructor(private backend: BackendService) {
        super();
    }

    public loadEntities() {
        this.isLoading = true;
        var pagination = this.pagination;
        var sort = this.sort;
        var url = this.getBackendUrl();
        var attributes = (this.searchForm) ? this.searchForm.getAttributes() : null;
        if(attributes && attributes.categoryId) {
            this.pagination.limit = 0;
        } else {
            this.pagination.limit = 50;
        }
        url += '/' + pagination.getOffset() + '-' + pagination.limit;
        url += '/' + sort.attribute + '-' + sort.direction;
        if(attributes) {
            url += '/' + JSON.stringify(attributes);
        }

        this.getBackend().get(url)
            .then((resp: Response) => {
                var data = resp.json();
                this.entities = [];
                this.pagination.total = data['total'];
                var i = (pagination.hasMoreThanOnePage()) ? (pagination.getOffset() + 1) : 1;
                if(this.sort.direction != 0) {
                    i = (pagination.hasMoreThanOnePage()) ? (data['total'] - pagination.getOffset()) : data['total'];
                }
                for(var entityData of data['entities']) {
                    if(!attributes || !attributes.categoryId) {
                        entityData['sort'] = i;
                    }
                    this.entities.push(this.getEntityFromData(entityData));
                    if(this.sort.direction == 0){
                        i++;
                    } else i--;
                }
                this.isLoading = false;
                var _self = this;
                setTimeout(function(){
                    _self.initDraggable($('catalog-products table.dataTable tbody'));
                }, 0);
            })
            .catch((resp: Response) => {
                alert(resp.text());
            });
    }

    private initDraggable(container){
        var attributes = this.searchForm.getAttributes(),
            _self = this;

        if(attributes.categoryId != null
            && attributes.sku == undefined && attributes.name == undefined
            && this.sort && this.sort.attribute == 'sort' && this.pagination.total > 0
        ) {
            container.parent().addClass('dragable');
            if(this.drakeInstance != null) {
                this.drakeInstance.destroy();
                this.drakeInstance = null;
            }
            this.drakeInstance = dragula([container[0]], {
                moves: function (el, source, handle, sibling) {
                    return ($(handle).closest('td').attr('data-column-attr') == 'sort');
                },
            });
            this.drakeInstance.on('drop', function(el, target, source, sibling){
                var entityIndex = parseInt($(el).attr('data-index')),
                    siblingIndex = (sibling) ? parseInt($(sibling).attr('data-index')) : null;
                _self.sortEntity(entityIndex, siblingIndex);
            })
        } else if(this.drakeInstance != null) {
            container.parent().removeClass('dragable');
            this.drakeInstance.destroy();
            this.drakeInstance = null;
        }
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getEntityFromData(data:any): MyDatatableEntity {
        var product = new Product(data['id']);
        Object.assign(product, data);
        return product;
    }

    protected getBackendUrl():string {
        return 'catalog/products';
    }

}