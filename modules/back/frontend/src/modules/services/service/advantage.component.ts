import { Component, Input, Output, Type, ViewChild, OnInit, EventEmitter } from '@angular/core';
import {MyCropperComponent} from "../../../common/my-cropper/my-cropper.component";
import {I18nTabsComponent} from "../../../common/i18n-tabs/i18n-tabs.component";
import {FormGroupComponent} from "../../../common/form-group/form-group.component";
import {AdvantageForm} from "./advantage-form";

@Component({
    selector: 'service-advantage',
    templateUrl: './advantage.html',
    directives: [
        <Type>MyCropperComponent,
        <Type>I18nTabsComponent,
        <Type>FormGroupComponent,
    ],
})
export class AdvantageComponent implements OnInit {

    @Input()
    public form: AdvantageForm;

    @ViewChild(<Type>I18nTabsComponent, undefined)
    private i18ns: I18nTabsComponent;

    @Output()
    public onDelete: EventEmitter<AdvantageForm> = new EventEmitter<AdvantageForm>();

    public ngOnInit() {
        this.i18ns.init(this.form);
    }

    public deleteAdvantage() {
        if(confirm('Удалить преимущество?')) {
            this.onDelete.emit(this.form);
        }
    }

}
