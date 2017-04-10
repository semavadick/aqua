import { Injectable } from '@angular/core';
import { BackendService } from "../../../services/backend.service";
import { I18nForm } from "../../../common/i18n-form";
import { LanguagesManager } from "../../../services/languages-manager";
import { CertificatesBlockI18nForm } from "./certificates-block-i18n-form";
import { Language } from "../../../services/language";
import { FormPanelForm } from "../../../common/form-panel/form-panel-form";

@Injectable()
export class CertificatesBlockForm extends FormPanelForm {

    constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getBackendUrl():string {
        return 'about-page/certificates-block';
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    reset(): any { }

    populate(data: any): any { }

    getData(): any { return {}; }

    protected getI18nFormClass(): { new(language: Language): I18nForm }  {
        return CertificatesBlockI18nForm;
    }

}
