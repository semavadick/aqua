import { Injectable } from '@angular/core';
import { BackendService } from "../../../services/backend.service";
import { I18nForm } from "../../../common/i18n-form";
import { LanguagesManager } from "../../../services/languages-manager";
import { CompetenceI18nForm } from "./competence-i18n-form";
import { Language } from "../../../services/language";
import { FormPanelForm } from "../../../common/form-panel/form-panel-form";
import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";

@Injectable()
export class CompetenceForm extends FormPanelForm {

    public image: MyCropperImage = new MyCropperImage();

    constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getBackendUrl():string {
        return 'about-page/competence';
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
        return CompetenceI18nForm;
    }

}
