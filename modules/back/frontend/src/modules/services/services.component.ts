import { Component, Type } from '@angular/core';
import { ROUTER_DIRECTIVES } from '@angular/router';
import { HeaderComponent } from "../header/header.component";

@Component({
    templateUrl: './services.html',
    directives: [
        <Type>HeaderComponent,
        ROUTER_DIRECTIVES,
    ],
})
export class ServicesComponent {

}
