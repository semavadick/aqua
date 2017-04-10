import { Type }  from '@angular/core';
import { Route }  from '@angular/router';
import {CatalogComponent} from "./catalog.component";
import {AttachmentsComponent} from "./attachments/advantages.component";
import {GeneralComponent} from "./general/general.component";
import {StoreComponent} from "./store/store.component";

export const catalogRoute: Route = {
    path: 'catalog',
    component: <Type>CatalogComponent,
    children: [
        {
            path: 'store',
            component: <Type>StoreComponent
        },
        {
            path: 'attachments',
            component: <Type>AttachmentsComponent
        },
        {
            path: 'general',
            component: <Type>GeneralComponent
        },
    ],
};