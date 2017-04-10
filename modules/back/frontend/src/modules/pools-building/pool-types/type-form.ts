import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";
import {Injectable} from '@angular/core';
import {CrudGridEntityForm} from "../../../common/crud-grid/crud-grid-entity-form";
import {BackendService} from "../../../services/backend.service";
import {LanguagesManager} from "../../../services/languages-manager";
import {TypeI18nForm} from "./type-i18n-form";
import {I18nForm} from "../../../common/i18n-form";
import {Language} from "../../../services/language";
import {AdvantageForm} from "./advantage-form";

@Injectable()
export class TypeForm extends CrudGridEntityForm {

    public preview: MyCropperImage = new MyCropperImage();
    public widePreview: MyCropperImage = new MyCropperImage();
    public bg: MyCropperImage = new MyCropperImage();

    public advantages: AdvantageForm[] = [];

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return this.backend;
    }
    protected getBackendUrl(): string {
        return 'pools-building/pool-types';
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    reset(): any {
        this.preview.reset();
        this.widePreview.reset();
        this.bg.reset();
        this.advantages = [];
    }

    populate(data: any): any {
        this.preview.currentImageUrl = data['previewUrl'];
        this.widePreview.currentImageUrl = data['widePreviewUrl'];
        this.bg.currentImageUrl = data['bgUrl'];
        for(let advData of data['advantages']) {
            var advantage = new AdvantageForm(this.langsManager);
            advantage.populate(advData);
            this.advantages.push(advantage);
        }
    }

    getData(): any {
        var advsData: Object[] = [];
        for(let advantage of this.advantages) {
            advsData.push(advantage.getData());
        }
        return {
            preview: this.preview.croppedImage,
            widePreview: this.widePreview.croppedImage,
            bg: this.bg.croppedImage,
            advantages: advsData,
        };
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm }  {
        return TypeI18nForm;
    }

    public setErrors(errors: Object) {
        super.setErrors(errors);
        var i = 0;
        for(let advErrors of errors['advantages']) {
            this.advantages[i].setErrors(advErrors);
            i++;
        }
    }

}