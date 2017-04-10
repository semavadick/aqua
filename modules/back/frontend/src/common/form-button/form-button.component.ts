import { Component, Input } from '@angular/core';
import {Form} from "../form";

@Component({
    selector: 'form-button',
    templateUrl: './form-button.html'
})
export class FormButtonComponent {

    @Input()
    public form: Form;

    @Input()
    public attribute: string;

    @Input()
    public label: string;

}
