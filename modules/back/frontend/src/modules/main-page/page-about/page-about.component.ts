import { Component, Type, ViewChild } from '@angular/core';
import { PageAboutForm } from "./page-about-form";
import { FormGroupComponent } from "../../../common/form-group/form-group.component";
import { I18nTabsComponent } from "../../../common/i18n-tabs/i18n-tabs.component";
import { I18nCheckbox } from "../../../common/i18n-checkbox/i18n-checkbox.component";
import { FormPanelComponent } from "../../../common/form-panel/form-panel.component";
import {MyWysiwygComponent} from "../../../common/my-wysiwyg/my-wysiwyg.component";

@Component({
    selector: 'page-about',
    templateUrl: './page-about.html',
    directives: [
        <Type>FormGroupComponent,
        <Type>I18nTabsComponent,
        <Type>FormPanelComponent,
        <Type>MyWysiwygComponent,
    ],
    providers: [PageAboutForm],
})
export class PageAboutComponent {

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    constructor(public form: PageAboutForm) { }

}
