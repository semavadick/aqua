import { Component, Type, ViewChild } from '@angular/core';
import { FormGroupComponent } from "../../../common/form-group/form-group.component";
import { I18nTabsComponent } from "../../../common/i18n-tabs/i18n-tabs.component";
import { I18nCheckbox } from "../../../common/i18n-checkbox/i18n-checkbox.component";
import { FormPanelComponent } from "../../../common/form-panel/form-panel.component";
import {MyCropperComponent} from "../../../common/my-cropper/my-cropper.component";
import {MyWysiwygComponent} from "../../../common/my-wysiwyg/my-wysiwyg.component";
import { ProjectServiceForm } from "./project-service-form";
import {FileUploaderComponent} from "../../../common/file-uploader/file-uploader.component";

@Component({
    selector: 'project-service',
    templateUrl: '../service/service.html',
    directives: [
        <Type>FormGroupComponent,
        <Type>I18nTabsComponent,
        <Type>FormPanelComponent,
        <Type>MyCropperComponent,
        <Type>MyWysiwygComponent,
        <Type>FileUploaderComponent,
    ],
    providers: [ProjectServiceForm],
})
export class ProjectServiceComponent {

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    public title: string = "Проектирование";

    constructor(public form: ProjectServiceForm) { }

}
