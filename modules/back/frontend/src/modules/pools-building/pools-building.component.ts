import { Component, Type } from '@angular/core';
import { ROUTER_DIRECTIVES } from '@angular/router';
import { HeaderComponent } from "../header/header.component";
import { PageSeoComponent } from "./page-seo/page-seo.component";
import {ProjectServiceComponent} from "./project-service/project-service.component";
import {DesignServiceComponent} from "./design-service/design-service.component";
import {BuildingServiceComponent} from "./building-service/building-service.component";
import {RebuildingComponent} from "./rebuilding/rebuilding.component";
import {AdvantagesComponent} from "./advantages/advantages.component";
import {FaqComponent} from "./faq/faq.component";
import {PoolTypesComponent} from "./pool-types/pool-types.component";

@Component({
    templateUrl: './pools-building.html',
    directives: [
        <Type>HeaderComponent, ROUTER_DIRECTIVES
    ],
})
export class PoolsBuildingComponent {

}
