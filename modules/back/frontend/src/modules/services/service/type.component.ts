import { Component, Input, Output, Type, ViewChild, OnInit, EventEmitter } from '@angular/core';
import {MyCropperComponent} from "../../../common/my-cropper/my-cropper.component";
import {I18nTabsComponent} from "../../../common/i18n-tabs/i18n-tabs.component";
import {FormGroupComponent} from "../../../common/form-group/form-group.component";
import {TypeForm} from "./type-form";

@Component({
    selector: 'service-type',
    templateUrl: './type.html',
    directives: [
        <Type>MyCropperComponent,
        <Type>I18nTabsComponent,
        <Type>FormGroupComponent,
    ],
})
export class TypeComponent implements OnInit {

    @Input()
    public form: TypeForm;

    @ViewChild(<Type>I18nTabsComponent, undefined)
    private i18ns: I18nTabsComponent;

    @Output()
    public onDelete: EventEmitter<TypeForm> = new EventEmitter<TypeForm>();

    public ngOnInit() {
        this.i18ns.init(this.form);
    }

    public deleteType() {
        if(confirm('Удалить тип конструкции?')) {
            this.onDelete.emit(this.form);
        }
    }

}
