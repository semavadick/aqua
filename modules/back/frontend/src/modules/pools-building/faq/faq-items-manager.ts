import { Injectable } from '@angular/core';
import { Response } from '@angular/http';
import { BackendService } from "../../../services/backend.service";
import {FaqItem} from "./faq-item";

@Injectable()
export class FaqItemsManager {

    public isLoading = false;

    public items: FaqItem[];

    private backendUrl: string = 'pools-building/faq';

    public constructor(private backend: BackendService) { }

    public loadItems() {
        this.isLoading = true;
        this.backend.get(this.backendUrl)
            .then((resp: Response) => {
                this.items = [];
                for(var entityData of resp.json()) {
                    var entity = new FaqItem();
                    Object.assign(entity, entityData);
                    this.items.push(entity);
                }
                this.isLoading = false;
            })
            .catch((resp: Response) => {
                alert(resp.text());
            });
    }

    public deleteItem(item: FaqItem) {
        this.isLoading = true;
        var url = this.backendUrl+ '/' + item.id;
        this.backend.delete(url)
            .then((resp: Response) => {
                this.isLoading = false;
                this.loadItems();
            })
            .catch((resp: Response) => {
                alert(resp.text());
            })
    }

}