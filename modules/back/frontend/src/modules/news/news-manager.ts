import {Injectable} from "@angular/core";
import {MyDatatableManager} from "../../common/my-datatable/my-datatable-manager";
import {BackendService} from "../../services/backend.service";
import {MyDatatableEntity} from "../../common/my-datatable/my-datatable-entity";
import {NewsItem} from "./news-item";

@Injectable()
export class NewsManager extends MyDatatableManager {

    constructor(private backend: BackendService) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getEntityFromData(data:any): MyDatatableEntity {
        var newsItem = new NewsItem(data['id']);
        Object.assign(newsItem, data);
        return newsItem;
    }

    protected getBackendUrl():string {
        return 'news';
    }

}