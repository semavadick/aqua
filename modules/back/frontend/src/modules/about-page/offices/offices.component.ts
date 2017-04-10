import { Component, Type, ViewChild } from '@angular/core';
import {OfficesManager} from "./offices-manager";
import {OfficeForm} from "./office-form";
import {CrudGridComponent} from "../../../common/crud-grid/crud-grid.component";
import {MyCropperComponent} from "../../../common/my-cropper/my-cropper.component";
import {MyWysiwygComponent} from "../../../common/my-wysiwyg/my-wysiwyg.component";
import {I18nTabsComponent} from "../../../common/i18n-tabs/i18n-tabs.component";
import {I18nCheckbox} from "../../../common/i18n-checkbox/i18n-checkbox.component";
import {FormGroupComponent} from "../../../common/form-group/form-group.component";

@Component({
    selector: 'offices-list',
    templateUrl: './offices.html',
    directives: [
        <Type>CrudGridComponent,
        <Type>MyCropperComponent,
        <Type>I18nTabsComponent,
        <Type>I18nCheckbox,
        <Type>FormGroupComponent,
        <Type>MyWysiwygComponent,
    ],
    providers: [OfficesManager, OfficeForm],
})
export class OfficesComponent {

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    constructor(public manager: OfficesManager, public form: OfficeForm) { }

    public selectRegion(regionId: number) {
        this.form.regionId = regionId;
    }

}
