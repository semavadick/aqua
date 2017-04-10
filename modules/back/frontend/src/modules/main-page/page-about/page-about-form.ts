import { Injectable } from '@angular/core';
import { BackendService } from "../../../services/backend.service";
import { I18nForm } from "../../../common/i18n-form";
import { LanguagesManager } from "../../../services/languages-manager";
import { PageAboutI18nForm } from "./page-about-i18n-form";
import { Language } from "../../../services/language";
import { FormPanelForm } from "../../../common/form-panel/form-panel-form";

@Injectable()
export class PageAboutForm extends FormPanelForm {

    constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getBackendUrl():string {
        return 'main-page/about';
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    reset(): any { }

    populate(data: any): any { }

    getData(): any { return {}; }

    protected getI18nFormClass(): { new(language: Language): I18nForm }  {
        return PageAboutI18nForm;
    }

}
