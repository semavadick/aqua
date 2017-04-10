import { Injectable } from '@angular/core';
import { BackendService } from "../../../services/backend.service";
import { I18nForm } from "../../../common/i18n-form";
import { LanguagesManager } from "../../../services/languages-manager";
import { MaintenanceI18nForm } from "./maintenance-i18n-form";
import { Language } from "../../../services/language";
import {ServiceForm} from "../service/service-form";

@Injectable()
export class MaintenanceForm extends ServiceForm {

    constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getBackendUrl():string {
        return 'services/maintenance';
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm }  {
        return MaintenanceI18nForm;
    }

    public hasBg():boolean {
        return false;
    }

    public hasTypes(): boolean {
        return false;
    }

}
