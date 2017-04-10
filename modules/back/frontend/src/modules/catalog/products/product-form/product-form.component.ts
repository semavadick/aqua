import { Component, Type, Input, Output, EventEmitter, ViewChild } from '@angular/core';
import {ProductForm} from "./product-form";
import {I18nTabsComponent} from "../../../../common/i18n-tabs/i18n-tabs.component";
import {I18nCheckbox} from "../../../../common/i18n-checkbox/i18n-checkbox.component";
import {FormGroupComponent} from "../../../../common/form-group/form-group.component";
import {FormButtonComponent} from "../../../../common/form-button/form-button.component";
import {MyCropperComponent} from "../../../../common/my-cropper/my-cropper.component";
import {MyWysiwygComponent} from "../../../../common/my-wysiwyg/my-wysiwyg.component";
import {MyGridComponent} from "../../../../common/my-grid/my-grid.component";
import {ProductImagesComponent} from "./product-images.component";
import {ProductAttributesComponent} from "./product-attributes.component";
import {RelatedProductsComponent} from "./related-products.component";
import {MyCheckbox} from "../../../../common/my-checkbox/my-checkbox.component";
import {FileUploaderComponent} from "../../../../common/file-uploader/file-uploader.component";
import {MultiSelect} from "../../../../common/multi-select/multi-select.component";

@Component({
    selector: 'product-form',
    templateUrl: './product-form.html',
    directives: [
        <Type>I18nTabsComponent,
        <Type>I18nCheckbox,
        <Type>FormGroupComponent,
        <Type>FormButtonComponent,
        <Type>MyCropperComponent,
        <Type>MyWysiwygComponent,
        <Type>MyGridComponent,
        <Type>ProductImagesComponent,
        <Type>ProductAttributesComponent,
        <Type>RelatedProductsComponent,
        <Type>MyCheckbox,
        <Type>FileUploaderComponent,
        <Type>MultiSelect,
    ],

})
export class ProductFormComponent {

    @Input()
    public form: ProductForm;

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    public initI18ns() {
        this.i18nTabs.init(this.form);
    }

}