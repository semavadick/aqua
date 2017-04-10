import { Component, Type, Input, Output, EventEmitter, ViewChild } from '@angular/core';
import {AdditionProductForm} from "./addition-product-form";
import {I18nTabsComponent} from "../../../../common/i18n-tabs/i18n-tabs.component";
import {I18nCheckbox} from "../../../../common/i18n-checkbox/i18n-checkbox.component";
import {FormGroupComponent} from "../../../../common/form-group/form-group.component";
import {FormButtonComponent} from "../../../../common/form-button/form-button.component";
import {MyCropperComponent} from "../../../../common/my-cropper/my-cropper.component";
import {MyWysiwygComponent} from "../../../../common/my-wysiwyg/my-wysiwyg.component";
import {MyGridComponent} from "../../../../common/my-grid/my-grid.component";
import {AdditionProductImagesComponent} from "./addition-product-images.component";
import {AdditionProductTabsComponent} from "./addition-product-tabs.component.ts";
import {AdditionProductOptionsComponent} from "./addition-product-options.component";
import {AdditionRelatedProductsComponent} from "./addition-related-products.component.ts";
import {MyCheckbox} from "../../../../common/my-checkbox/my-checkbox.component";
import {MyCheckboxSwitcheryDouble} from "../../../../common/my-checkbox-switchery-double/my-checkbox-switchery-double.component";
import {FileUploaderComponent} from "../../../../common/file-uploader/file-uploader.component";
import {MultiSelect} from "../../../../common/multi-select/multi-select.component";

@Component({
    selector: 'addition-product-form',
    templateUrl: './addition-product-form.html',
    directives: [
        <Type>I18nTabsComponent,
        <Type>I18nCheckbox,
        <Type>FormGroupComponent,
        <Type>FormButtonComponent,
        <Type>MyCropperComponent,
        <Type>MyWysiwygComponent,
        <Type>MyGridComponent,
        <Type>AdditionProductImagesComponent,
        <Type>AdditionProductTabsComponent,
        <Type>AdditionProductOptionsComponent,
        <Type>AdditionRelatedProductsComponent,
        <Type>MyCheckbox,
        <Type>MyCheckboxSwitcheryDouble,
        <Type>FileUploaderComponent,
        <Type>MultiSelect,
    ],

})
export class AdditionProductFormComponent {

    @Input()
    public form: AdditionProductForm;

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    public initI18ns() {
        this.i18nTabs.init(this.form);
    }

}