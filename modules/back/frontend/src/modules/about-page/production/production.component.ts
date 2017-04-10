import { Component, Type, ViewChild } from '@angular/core';
import { ProductionForm } from "./production-form";
import { FormGroupComponent } from "../../../common/form-group/form-group.component";
import { I18nTabsComponent } from "../../../common/i18n-tabs/i18n-tabs.component";
import { I18nCheckbox } from "../../../common/i18n-checkbox/i18n-checkbox.component";
import { FormPanelComponent } from "../../../common/form-panel/form-panel.component";
import {MyCropperComponent} from "../../../common/my-cropper/my-cropper.component";
import {MyWysiwygComponent} from "../../../common/my-wysiwyg/my-wysiwyg.component";
import {ProductionBannersComponent} from "../production-banners/production-banners.component";
import {ProductionImagesComponent} from "../production-images/production-images.component";

@Component({
    selector: 'company-production',
    templateUrl: './production.html',
    directives: [
        <Type>FormGroupComponent,
        <Type>I18nTabsComponent,
        <Type>FormPanelComponent,
        <Type>MyWysiwygComponent,
        <Type>ProductionBannersComponent,
        <Type>ProductionImagesComponent,
    ],
    providers: [ProductionForm],
})
export class ProductionComponent {

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    constructor(public form: ProductionForm) { }

}
