import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";
import {Injectable} from '@angular/core';
import {ProductionImageDetailsI18nForm} from "./production-image-details-i18n-form";
import {BackendService} from "../../../services/backend.service";
import {LanguagesManager} from "../../../services/languages-manager";
import {CrudGridEntityForm} from "../../../common/crud-grid/crud-grid-entity-form";
import {Language} from "../../../services/language";
import {I18nForm} from "../../../common/i18n-form";

@Injectable()
export class ProductionImageDetailsForm extends CrudGridEntityForm {

    public image: MyCropperImage = new MyCropperImage();

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getBackendUrl():string {
        return 'about-page/production-images';
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
        return ProductionImageDetailsI18nForm;
    }

}