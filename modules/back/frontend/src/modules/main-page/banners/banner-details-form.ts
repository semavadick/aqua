import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";
import {Injectable} from '@angular/core';
import {BannerDetailsI18nForm} from "./banner-details-i18n-form";
import {BackendService} from "../../../services/backend.service";
import {LanguagesManager} from "../../../services/languages-manager";
import {CrudGridEntityForm} from "../../../common/crud-grid/crud-grid-entity-form";
import {Language} from "../../../services/language";
import {I18nForm} from "../../../common/i18n-form";

@Injectable()
export class BannerDetailsForm extends CrudGridEntityForm {

    public image: MyCropperImage = new MyCropperImage();

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getBackendUrl():string {
        return 'main-page/banners';
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
        return BannerDetailsI18nForm;
    }

}