import { Injectable } from '@angular/core';
import { BackendService } from "../../../services/backend.service";
import { I18nForm } from "../../../common/i18n-form";
import { LanguagesManager } from "../../../services/languages-manager";
import { Language } from "../../../services/language";
import {GeneralI18nForm} from "./general-i18n-form";
import {FormPanelForm} from "../../../common/form-panel/form-panel-form";

@Injectable()
export class GeneralForm extends FormPanelForm {

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackendUrl():string {
        return 'catalog/general';
    }

    reset():any { }

    populate(data:any):any {
    }

    getData():any {
        return {

        };
    }

    protected getBackend(): BackendService {
        return this.backend;
    }

    protected getLanguagesManager(): LanguagesManager {
        return this.langsManager;
    }

    protected getI18nFormClass():{new(language: Language): I18nForm } {
        return GeneralI18nForm;
    }

}
