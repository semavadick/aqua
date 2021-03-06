import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";
import {Injectable} from '@angular/core';
import {CrudGridEntityForm} from "../../../common/crud-grid/crud-grid-entity-form";
import {BackendService} from "../../../services/backend.service";
import {LanguagesManager} from "../../../services/languages-manager";
import {AttachmentI18nForm} from "./attachment-i18n-form";
import {I18nForm} from "../../../common/i18n-form";
import {Language} from "../../../services/language";

@Injectable()
export class AttachmentForm extends CrudGridEntityForm {

    public icon: MyCropperImage = new MyCropperImage();

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }
    protected getBackendUrl(): string {
        return 'catalog/attachments';
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    reset(): any {
        this.icon.reset();
    }

    populate(data: any): any {
        this.icon.currentImageUrl = data['iconUrl'];
    }

    getData(): any {
        return {
            icon: this.icon.croppedImage,
        };
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm }  {
        return AttachmentI18nForm;
    }

}