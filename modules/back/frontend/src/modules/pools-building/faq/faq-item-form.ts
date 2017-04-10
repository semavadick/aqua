import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";
import {Injectable} from '@angular/core';
import {CrudGridEntityForm} from "../../../common/crud-grid/crud-grid-entity-form";
import {BackendService} from "../../../services/backend.service";
import {LanguagesManager} from "../../../services/languages-manager";
import {FaqItemI18nForm} from "./faq-item-i18n-form";
import {I18nForm} from "../../../common/i18n-form";
import {Language} from "../../../services/language";

@Injectable()
export class FaqItemForm extends CrudGridEntityForm {

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }
    protected getBackendUrl(): string {
        return 'pools-building/faq';
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    reset(): any {

    }

    populate(data: any): any {

    }

    getData(): any {
        return {

        };
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm }  {
        return FaqItemI18nForm;
    }

}