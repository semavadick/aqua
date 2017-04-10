import { Component, Type, ViewChild } from '@angular/core';
import {CertificatesManager} from "./certificates-manager";
import {CertificateForm} from "./certificate-form";
import {CrudGridComponent} from "../../../common/crud-grid/crud-grid.component";
import {MyCropperComponent} from "../../../common/my-cropper/my-cropper.component";
import {MyWysiwygComponent} from "../../../common/my-wysiwyg/my-wysiwyg.component";
import {I18nTabsComponent} from "../../../common/i18n-tabs/i18n-tabs.component";
import {I18nCheckbox} from "../../../common/i18n-checkbox/i18n-checkbox.component";
import {FormGroupComponent} from "../../../common/form-group/form-group.component";

@Component({
    selector: 'certificates-list',
    templateUrl: './certificates.html',
    directives: [
        <Type>CrudGridComponent,
        <Type>MyCropperComponent,
        <Type>I18nTabsComponent,
        <Type>I18nCheckbox,
        <Type>FormGroupComponent,
    ],
    providers: [CertificatesManager, CertificateForm],
})
export class CertificatesComponent {

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    constructor(public manager: CertificatesManager, public form: CertificateForm) { }

}
