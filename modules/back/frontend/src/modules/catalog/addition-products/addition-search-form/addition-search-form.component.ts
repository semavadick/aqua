import { Component, Type, Input, Output, EventEmitter } from '@angular/core';
import {AdditionSearchForm} from "./addition-search-form";

@Component({
    selector: 'addition-search-form',
    templateUrl: './addition-search-form.html',

})
export class AdditionSearchFormComponent {

    @Input()
    public form: AdditionSearchForm;

}