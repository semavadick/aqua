import { Type }  from '@angular/core';
import { Route }  from '@angular/router';
import {PoolsBuildingComponent} from "./pools-building.component";
import {PageSeoComponent} from "./page-seo/page-seo.component";
import {PoolTypesComponent} from "./pool-types/pool-types.component";
import {AdvantagesComponent} from "./advantages/advantages.component";
import {FaqComponent} from "./faq/faq.component";
import {ProjectServiceComponent} from "./project-service/project-service.component";
import {DesignServiceComponent} from "./design-service/design-service.component";
import {BuildingServiceComponent} from "./building-service/building-service.component";
import {RebuildingComponent} from "./rebuilding/rebuilding.component";

export const poolsBuildingRoute: Route = {
    path: 'pools-building',
    component: <Type>PoolsBuildingComponent,
    children: [
        {
            path: 'types',
            component: <Type>PoolTypesComponent
        },
        {
            path: 'advantages',
            component: <Type>AdvantagesComponent
        },
        {
            path: 'faq',
            component: <Type>FaqComponent
        },
        {
            path: 'project',
            component: <Type>ProjectServiceComponent
        },
        {
            path: 'design',
            component: <Type>DesignServiceComponent
        },
        {
            path: 'building',
            component: <Type>BuildingServiceComponent
        },
        {
            path: 'rebuilding',
            component: <Type>RebuildingComponent
        },
        {
            path: 'seo',
            component: <Type>PageSeoComponent
        },
    ],
};