import { Component, Type, ViewChild } from '@angular/core';
import { AdvantagesBlockForm } from "./advantages-block-form";
import { FormGroupComponent } from "../../../common/form-group/form-group.component";
import { I18nTabsComponent } from "../../../common/i18n-tabs/i18n-tabs.component";
import { I18nCheckbox } from "../../../common/i18n-checkbox/i18n-checkbox.component";
import { FormPanelComponent } from "../../../common/form-panel/form-panel.component";
import {MyCropperComponent} from "../../../common/my-cropper/my-cropper.component";

@Component({
    selector: 'advantages-block',
    templateUrl: './advantages-block.html',
    directives: [
        <Type>FormGroupComponent,
        <Type>I18nTabsComponent,
        <Type>FormPanelComponent,
    ],
    providers: [AdvantagesBlockForm],
})
export class AdvantagesBlockComponent {

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    constructor(public form: AdvantagesBlockForm) { }

}
