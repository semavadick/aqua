import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";
import {Injectable} from '@angular/core';
import {CrudGridEntityForm} from "../../../common/crud-grid/crud-grid-entity-form";
import {BackendService} from "../../../services/backend.service";
import {LanguagesManager} from "../../../services/languages-manager";
import {RegionI18nForm} from "./region-i18n-form";
import {I18nForm} from "../../../common/i18n-form";
import {Language} from "../../../services/language";

@Injectable()
export class RegionForm extends CrudGridEntityForm {

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }
    protected getBackendUrl(): string {
        return 'about-page/regions';
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
        return RegionI18nForm;
    }

}