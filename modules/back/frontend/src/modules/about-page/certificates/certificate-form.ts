import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";
import {Injectable} from '@angular/core';
import {CrudGridEntityForm} from "../../../common/crud-grid/crud-grid-entity-form";
import {BackendService} from "../../../services/backend.service";
import {LanguagesManager} from "../../../services/languages-manager";
import {CertificateI18nForm} from "./certificate-i18n-form";
import {I18nForm} from "../../../common/i18n-form";
import {Language} from "../../../services/language";

@Injectable()
export class CertificateForm extends CrudGridEntityForm {

    public image: MyCropperImage = new MyCropperImage();
    public id: number = null;
    public sort: number = null;

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }
    protected getBackendUrl(): string {
        return 'about-page/certificates';
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    reset(): any {
        this.image.reset();
        this.id = null;
        this.sort = null;
    }

    populate(data: any): any {
        this.image.currentImageUrl = data['imageUrl'];
        this.id = data['id'];
        this.sort = data['sort'];
    }

    getData(): any {
        return {
            image: this.image.croppedImage,
            sort: this.sort,
            id: this.id
        };
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm }  {
        return CertificateI18nForm;
    }

}