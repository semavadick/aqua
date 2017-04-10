import { Component, Type, ViewChild } from '@angular/core';
import {RegionsComponent} from "../regions/regions.component";
import {OfficesComponent} from "../offices/offices.component";

@Component({
    selector: 'contacts',
    templateUrl: './contacts.html',
    directives: [
        <Type>RegionsComponent,
        <Type>OfficesComponent,
    ],
})
export class ContactsComponent {

}
