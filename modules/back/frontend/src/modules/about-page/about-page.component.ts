import { Component, Type } from '@angular/core';
import { ROUTER_DIRECTIVES } from '@angular/router';
import { HeaderComponent } from "../header/header.component";

@Component({
    templateUrl: './about-page.html',
    directives: [
        <Type>HeaderComponent, <any[]>ROUTER_DIRECTIVES,
    ],
})
export class AboutPageComponent {

}