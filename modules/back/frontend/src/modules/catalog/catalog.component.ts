import { Component, Type, OnInit, ViewChild } from '@angular/core';
import { ROUTER_DIRECTIVES } from '@angular/router';
import { HeaderComponent } from "../header/header.component";

@Component({
    templateUrl: './catalog.html',
    directives: [
        <Type>HeaderComponent,
        ROUTER_DIRECTIVES,
    ]
})
export class CatalogComponent {

}
