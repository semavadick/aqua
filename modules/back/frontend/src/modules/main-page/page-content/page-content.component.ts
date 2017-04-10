import { Component, Type, ViewChild } from '@angular/core';
import { PageContentForm } from "./page-content-form";
import { FormGroupComponent } from "../../../common/form-group/form-group.component";
import { I18nTabsComponent } from "../../../common/i18n-tabs/i18n-tabs.component";
import { I18nCheckbox } from "../../../common/i18n-checkbox/i18n-checkbox.component";
import { FormPanelComponent } from "../../../common/form-panel/form-panel.component";
import {MyCropperComponent} from "../../../common/my-cropper/my-cropper.component";
import {FileUploaderComponent} from "../../../common/file-uploader/file-uploader.component";

@Component({
    selector: 'page-content',
    templateUrl: './page-content.html',
    directives: [
        <Type>FormGroupComponent,
        <Type>I18nTabsComponent,
        <Type>FormPanelComponent,
        <Type>MyCropperComponent,
        <Type>FileUploaderComponent,
    ],
    providers: [PageContentForm],
})
export class PageContentComponent {

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    constructor(public form: PageContentForm) { }

}
