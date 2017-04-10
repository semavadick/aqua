import { Injectable } from '@angular/core';
import { BackendService } from "../../../services/backend.service";
import { I18nForm } from "../../../common/i18n-form";
import { LanguagesManager } from "../../../services/languages-manager";
import { ExclusiveI18nForm } from "./exclusive-i18n-form";
import { Language } from "../../../services/language";
import {ServiceForm} from "../service/service-form";

@Injectable()
export class ExclusiveForm extends ServiceForm {

    constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getBackendUrl():string {
        return 'services/exclusive';
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm }  {
        return ExclusiveI18nForm;
    }

    public hasBg():boolean {
        return true;
    }

    public hasTypes(): boolean {
        return true;
    }

}
