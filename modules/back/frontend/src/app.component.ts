import { Component, Type } from '@angular/core';
import { Router, ROUTER_DIRECTIVES } from '@angular/router';

@Component({
    selector: 'app-layout',
    templateUrl: 'app.html',
    directives: [<any[]>ROUTER_DIRECTIVES]
})
export class AppComponent {

}
