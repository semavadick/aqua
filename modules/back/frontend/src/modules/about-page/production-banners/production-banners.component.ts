import { Component, Type, ViewChild } from '@angular/core';
import {ProductionBannersManager} from "./production-banners-manager";
import {ProductionBannerDetailsForm} from "./production-banner-details-form";
import {CrudGridComponent} from "../../../common/crud-grid/crud-grid.component";
import {MyCropperComponent} from "../../../common/my-cropper/my-cropper.component";
import {MyWysiwygComponent} from "../../../common/my-wysiwyg/my-wysiwyg.component";
import {I18nTabsComponent} from "../../../common/i18n-tabs/i18n-tabs.component";
import {I18nCheckbox} from "../../../common/i18n-checkbox/i18n-checkbox.component";
import {FormGroupComponent} from "../../../common/form-group/form-group.component";

@Component({
    selector: 'production-banners',
    templateUrl: './production-banners.html',
    directives: [
        <Type>CrudGridComponent,
        <Type>MyCropperComponent,
        <Type>MyWysiwygComponent,
        <Type>I18nTabsComponent,
        <Type>I18nCheckbox,
        <Type>FormGroupComponent,
    ],
    providers: [ProductionBannersManager, ProductionBannerDetailsForm],
})
export class ProductionBannersComponent {

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    constructor(public manager: ProductionBannersManager, public form: ProductionBannerDetailsForm) { }

}
