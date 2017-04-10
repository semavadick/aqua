import { Component, Type, ViewChild } from '@angular/core';
import { CertificatesBlockForm } from "./certificates-block-form";
import { FormGroupComponent } from "../../../common/form-group/form-group.component";
import { I18nTabsComponent } from "../../../common/i18n-tabs/i18n-tabs.component";
import { I18nCheckbox } from "../../../common/i18n-checkbox/i18n-checkbox.component";
import { FormPanelComponent } from "../../../common/form-panel/form-panel.component";

@Component({
    selector: 'certificates-block',
    templateUrl: './certificates-block.html',
    directives: [
        <Type>FormGroupComponent,
        <Type>I18nTabsComponent,
        <Type>FormPanelComponent,
    ],
    providers: [CertificatesBlockForm],
})
export class CertificatesBlockComponent {

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    constructor(public form: CertificatesBlockForm) { }

}
