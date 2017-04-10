import { Component, Type, ViewChild } from '@angular/core';
import {AttachmentsManager} from "./attachments-manager";
import {AttachmentForm} from "./attachment-form";
import {CrudGridComponent} from "../../../common/crud-grid/crud-grid.component";
import {MyCropperComponent} from "../../../common/my-cropper/my-cropper.component";
import {MyWysiwygComponent} from "../../../common/my-wysiwyg/my-wysiwyg.component";
import {I18nTabsComponent} from "../../../common/i18n-tabs/i18n-tabs.component";
import {I18nCheckbox} from "../../../common/i18n-checkbox/i18n-checkbox.component";
import {FormGroupComponent} from "../../../common/form-group/form-group.component";

@Component({
    selector: 'catalog-attachments',
    templateUrl: './attachments.html',
    directives: [
        <Type>CrudGridComponent,
        <Type>MyCropperComponent,
        <Type>MyWysiwygComponent,
        <Type>I18nTabsComponent,
        <Type>I18nCheckbox,
        <Type>FormGroupComponent,
    ],
    providers: [AttachmentsManager, AttachmentForm],
})
export class AttachmentsComponent {

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    constructor(public manager: AttachmentsManager, public form: AttachmentForm) { }

}
