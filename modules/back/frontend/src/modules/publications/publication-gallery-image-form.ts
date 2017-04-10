import {Form} from "../../common/form";
import {MyCropperImage} from "../../common/my-cropper/my-cropper-image";
import {PublicationGalleryImageI18nForm} from "./publication-gallery-image-i18n-form";
import {LanguagesManager} from "../../services/languages-manager";
import {EntityForm} from "../../common/entity-form";
import {BackendService} from "../../services/backend.service";
import {Language} from "../../services/language";
import {I18nForm} from "../../common/i18n-form";

export class PublicationGalleryImageForm extends EntityForm {

    public id: number = null;
    public image: MyCropperImage = new MyCropperImage();
    public sort: number = null;

    constructor(private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return undefined;
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    protected getI18nFormClass():{ new(language: Language): I18nForm} {
        return PublicationGalleryImageI18nForm;
    }

    reset():any {
        this.id = null;
        this.image.reset();
        this.sort = null;
        for(let i18n of this.getI18ns()) {
            i18n.reset();
        }
    }

    populate(data:any):any {
        this.id = data['id'];
        this.image.currentImageUrl = data['imageUrl'];
        this.sort = data['sort'];
        for(let i18nData of data['i18ns']) {
            var languageId = i18nData['languageId'];
            for(let i18n of this.getI18ns()) {
                if(i18n.language.id == languageId) {
                    i18n.populate(i18nData);
                    break;
                }
            }
        }
    }

    getData():any {
        var i18nsData: Object[] = [];
        for(let i18n of this.getI18ns()) {
            var i18nData = i18n.getData();
            i18nData['languageId'] = i18n.language.id;
            i18nsData.push(i18nData);
        }
        return {
            id: this.id,
            image: this.image.croppedImage,
            sort: this.sort,
            i18ns: i18nsData,
        };
    }

    public getPreviewUrl() {
        var image = this.image;
        if(image.croppedImage) {
            return image.croppedImage;
        }
        if(image.uploadedImage) {
            return image.uploadedImage;
        }
        if(image.currentImageUrl) {
            return image.currentImageUrl;
        }
        return null;
    }

}