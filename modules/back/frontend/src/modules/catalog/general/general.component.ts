import { Component, Type, OnInit, ViewChild } from '@angular/core';
import {GeneralForm} from "./general-form";
import {FormPanelComponent} from "../../../common/form-panel/form-panel.component";
import {FormGroupComponent} from "../../../common/form-group/form-group.component";
import {I18nTabsComponent} from "../../../common/i18n-tabs/i18n-tabs.component";
import {MyCropperComponent} from "../../../common/my-cropper/my-cropper.component";
import {FileUploaderComponent} from "../../../common/file-uploader/file-uploader.component";
import {MyWysiwygComponent} from "../../../common/my-wysiwyg/my-wysiwyg.component";

@Component({
    selector: 'catalog-general',
    templateUrl: './general.html',
    directives: [
        <Type>FormGroupComponent,
        <Type>I18nTabsComponent,
        <Type>FormPanelComponent,
        <Type>MyCropperComponent,
        <Type>FileUploaderComponent,
        <Type>MyWysiwygComponent,
    ],
    providers: [
        GeneralForm
    ]
})
export class GeneralComponent {

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    public constructor(public form: GeneralForm) {

    }

}
