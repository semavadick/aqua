import { Component, Type, ViewChild } from '@angular/core';
import {TypesManager} from "./types-manager";
import {TypeForm} from "./type-form";
import {CrudGridComponent} from "../../../common/crud-grid/crud-grid.component";
import {MyCropperComponent} from "../../../common/my-cropper/my-cropper.component";
import {MyWysiwygComponent} from "../../../common/my-wysiwyg/my-wysiwyg.component";
import {I18nTabsComponent} from "../../../common/i18n-tabs/i18n-tabs.component";
import {I18nCheckbox} from "../../../common/i18n-checkbox/i18n-checkbox.component";
import {FormGroupComponent} from "../../../common/form-group/form-group.component";
import {FileUploaderComponent} from "../../../common/file-uploader/file-uploader.component";
import {MyGridComponent} from "../../../common/my-grid/my-grid.component";
import {AdvantageForm} from "./advantage-form";
import {LanguagesManager} from "../../../services/languages-manager";
import {AdvantageComponent} from "./advantage.component";

@Component({
    selector: 'pool-types',
    templateUrl: './pool-types.html',
    directives: [
        <Type>CrudGridComponent,
        <Type>MyCropperComponent,
        <Type>MyWysiwygComponent,
        <Type>I18nTabsComponent,
        <Type>I18nCheckbox,
        <Type>FormGroupComponent,
        <Type>FileUploaderComponent,
        <Type>MyGridComponent,
        <Type>AdvantageComponent,
    ],
    providers: [TypesManager, TypeForm],
})
export class PoolTypesComponent {

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18nTabs: I18nTabsComponent;

    constructor(public manager: TypesManager, public form: TypeForm, private langsManager: LanguagesManager) { }

    public addAdvantage() {
        this.form.advantages.push(new AdvantageForm(this.langsManager));
    }

    public deleteAdvantage(advantage: AdvantageForm) {
        var index = this.form.advantages.indexOf(advantage);
        this.form.advantages.splice(index, 1);
    }

}
