import { Component, Input, Output, Type, ViewChild, OnInit, EventEmitter } from '@angular/core';
import {I18nTabsComponent} from "../../../../common/i18n-tabs/i18n-tabs.component";
import {FormGroupComponent} from "../../../../common/form-group/form-group.component";
import {FilterForm} from "./filter-form";

@Component({
    selector: 'category-filter',
    templateUrl: './filter.html',
    directives: [
        <Type>I18nTabsComponent,
        <Type>FormGroupComponent,
    ],
})
export class FilterComponent implements OnInit {

    @Input()
    public form: FilterForm;

    @ViewChild(<Type>I18nTabsComponent, undefined)
    private i18ns: I18nTabsComponent;

    @Output()
    public onDelete: EventEmitter<FilterForm> = new EventEmitter<FilterForm>();

    public ngOnInit() {
        this.i18ns.init(this.form);
    }

    public deleteFilter() {
        if(confirm('Удалить фильтр?')) {
            this.onDelete.emit(this.form);
        }
    }

}
