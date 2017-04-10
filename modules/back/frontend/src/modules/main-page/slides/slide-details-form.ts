import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";
import { Injectable } from '@angular/core';
import { BackendService } from "../../../services/backend.service";
import { Response } from "@angular/http";
import {LanguagesManager} from "../../../services/languages-manager";
import {Language} from "../../../services/language";
import {SlideDetailsI18nForm} from "./slide-details-i18n-form";
import {I18nForm} from "../../../common/i18n-form";
import {CrudGridEntityForm} from "../../../common/crud-grid/crud-grid-entity-form";

@Injectable()
export class SlideDetailsForm extends CrudGridEntityForm {

    public image: MyCropperImage = new MyCropperImage();

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getBackendUrl():string {
        return 'main-page/slides';
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    reset(): any {
        this.image.reset();
    }

    populate(data: any): any {
        this.image.currentImageUrl = data['imageUrl'];
    }

    getData(): any {
        return {
            image: this.image.croppedImage
        };
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm }  {
        return SlideDetailsI18nForm;
    }

}