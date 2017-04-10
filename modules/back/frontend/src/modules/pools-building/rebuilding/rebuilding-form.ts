import { Injectable } from '@angular/core';
import { BackendService } from "../../../services/backend.service";
import { I18nForm } from "../../../common/i18n-form";
import { LanguagesManager } from "../../../services/languages-manager";
import { RebuildingI18nForm } from "./rebuilding-i18n-form";
import { Language } from "../../../services/language";
import {PoolsBuildingStaticForm} from "../pools-building-static/pools-building-static-form";

@Injectable()
export class RebuildingForm extends PoolsBuildingStaticForm {

    constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getBackendUrl():string {
        return 'pools-building/rebuilding';
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm }  {
        return RebuildingI18nForm;
    }

    public hasBg():boolean {
        return true;
    }
}
