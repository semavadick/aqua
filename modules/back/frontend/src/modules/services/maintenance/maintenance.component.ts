import { Component, Type, ViewChild } from '@angular/core';
import { FormGroupComponent } from "../../../common/form-group/form-group.component";
import { I18nTabsComponent } from "../../../common/i18n-tabs/i18n-tabs.component";
import { I18nCheckbox } from "../../../common/i18n-checkbox/i18n-checkbox.component";
import { FormPanelComponent } from "../../../common/form-panel/form-panel.component";
import {MyCropperComponent} from "../../../common/my-cropper/my-cropper.component";
import {MyWysiwygComponent} from "../../../common/my-wysiwyg/my-wysiwyg.component";
import { MaintenanceForm } from "./maintenance-form";
import {FileUploaderComponent} from "../../../common/file-uploader/file-uploader.component";
import {ServiceComponent} from "../service/service.component";
import {ServiceForm} from "../service/service-form";
import {LanguagesManager} from "../../../services/languages-manager";
import {AdvantageComponent} from "../service/advantage.component";
import {MyGridComponent} from "../../../common/my-grid/my-grid.component";

@Component({
    selector: 'maintenance-service',
    templateUrl: '../service/service.html',
    directives: [
        <Type>FormGroupComponent,
        <Type>I18nTabsComponent,
        <Type>FormPanelComponent,
        <Type>MyCropperComponent,
        <Type>MyWysiwygComponent,
        <Type>FileUploaderComponent,
        <Type>AdvantageComponent,
        <Type>MyGridComponent,
    ],
    providers: [MaintenanceForm],
})
export class MaintenanceComponent extends ServiceComponent {

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    public title: string = "Обслуживание бассейнов";

    constructor(public form: MaintenanceForm, private langsManager: LanguagesManager) {
        super();
    }

    protected getForm():ServiceForm {
        return this.form;
    }

    protected getLangsManager():LanguagesManager {
        return this.langsManager;
    }

}
