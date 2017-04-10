import { Component, Type, Input, Output, EventEmitter } from '@angular/core';
import {SearchForm} from "./search-form";

@Component({
    selector: 'search-form',
    templateUrl: './search-form.html',

})
export class SearchFormComponent {

    @Input()
    public form: SearchForm;

}