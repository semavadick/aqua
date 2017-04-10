import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";
import {Injectable} from '@angular/core';
import {CrudGridEntityForm} from "../../../common/crud-grid/crud-grid-entity-form";
import {BackendService} from "../../../services/backend.service";
import {LanguagesManager} from "../../../services/languages-manager";
import {StageDetailsI18nForm} from "./stage-details-i18n-form";
import {I18nForm} from "../../../common/i18n-form";
import {Language} from "../../../services/language";

@Injectable()
export class StageDetailsForm extends CrudGridEntityForm {

    public year: number = 1990;
    public image: MyCropperImage = new MyCropperImage();

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }
    protected getBackendUrl(): string {
        return 'about-page/history-stages';
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    reset(): any {
        this.image.reset();
        this.year = 1990;
    }

    populate(data: any): any {
        this.image.currentImageUrl = data['imageUrl'];
        this.year = data['year'];
    }

    getData(): any {
        return {
            image: this.image.croppedImage,
            year: this.year
        };
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm }  {
        return StageDetailsI18nForm;
    }

}