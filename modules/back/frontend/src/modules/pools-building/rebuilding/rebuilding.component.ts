import { Component, Type, ViewChild } from '@angular/core';
import { FormGroupComponent } from "../../../common/form-group/form-group.component";
import { I18nTabsComponent } from "../../../common/i18n-tabs/i18n-tabs.component";
import { I18nCheckbox } from "../../../common/i18n-checkbox/i18n-checkbox.component";
import { FormPanelComponent } from "../../../common/form-panel/form-panel.component";
import {MyCropperComponent} from "../../../common/my-cropper/my-cropper.component";
import {MyWysiwygComponent} from "../../../common/my-wysiwyg/my-wysiwyg.component";
import { RebuildingForm } from "./rebuilding-form";
import {FileUploaderComponent} from "../../../common/file-uploader/file-uploader.component";
import {PoolsBuildingStaticComponent} from "../pools-building-static/pools-building-static.component";
import {PoolsBuildingStaticForm} from "../pools-building-static/pools-building-static-form";
import {LanguagesManager} from "../../../services/languages-manager";
import {MyGridComponent} from "../../../common/my-grid/my-grid.component";
import {PoolsBuildingStaticGalleriesComponent} from "../pools-building-static/pools-building-static-galleries.component";

@Component({
    selector: 'rebuilding',
    templateUrl: '../pools-building-static/pools-building-static.html',
    directives: [
        <Type>FormGroupComponent,
        <Type>I18nTabsComponent,
        <Type>FormPanelComponent,
        <Type>MyCropperComponent,
        <Type>MyWysiwygComponent,
        <Type>FileUploaderComponent,
        <Type>PoolsBuildingStaticGalleriesComponent,
        <Type>MyGridComponent,
        <Type>I18nCheckbox
    ],
    providers: [RebuildingForm],
})
export class RebuildingComponent extends PoolsBuildingStaticComponent {

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    public title: string = "Реконструкция бассейнов";

    constructor(public form: RebuildingForm, private langsManager: LanguagesManager) {
        super();
    }

    protected getForm():RebuildingForm {
        return this.form;
    }

    protected getLangsManager():LanguagesManager {
        return this.langsManager;
    }

    public formInitialized(data: any) {
        this.i18ns.init(this.form);
    }
}
