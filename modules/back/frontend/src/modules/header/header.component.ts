import { Component, Input } from '@angular/core';
import {WebUser} from "../../services/web-user";

@Component({
    selector: 'page-header',
    templateUrl: './header.html',
})
export class HeaderComponent {

    @Input()
    public title: string;

    constructor(private wUser: WebUser) { }

}
