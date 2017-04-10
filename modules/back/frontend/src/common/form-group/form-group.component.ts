import { Component, Input } from '@angular/core';
import {Form} from "../form";

@Component({
    selector: 'form-group',
    templateUrl: './form-group.html'
})
export class FormGroupComponent {

    @Input()
    public form: Form;

    @Input()
    public attribute: string;

    @Input()
    public label: string;

    @Input()
    public horizontal: boolean = true;

}
