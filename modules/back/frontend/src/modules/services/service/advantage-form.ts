import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";
import {EntityForm} from "../../../common/entity-form";
import {BackendService} from "../../../services/backend.service";
import {LanguagesManager} from "../../../services/languages-manager";
import {Language} from "../../../services/language";
import {I18nForm} from "../../../common/i18n-form";
import {AdvantageI18nForm} from "./advantage-18n-form";

export class AdvantageForm extends EntityForm {

    public id: number = null;
    public icon: MyCropperImage = new MyCropperImage();

    public constructor(private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return undefined;
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    reset(): any {
        this.id = null;
        this.icon.reset();
        for(let i18n of this.getI18ns()) {
            i18n.reset();
        }
    }

    populate(data: any): any {
        this.id = data['id'];
        this.icon.currentImageUrl = data['iconUrl'];
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

    getData(): any {
        var i18nsData: Object[] = [];
        for(let i18n of this.getI18ns()) {
            var i18nData = i18n.getData();
            i18nData['saveI18n'] = i18n.saveI18n;
            i18nData['languageId'] = i18n.language.id;
            i18nsData.push(i18nData);
        }
        return {
            id: this.id,
            icon: this.icon.croppedImage,
            i18ns: i18nsData,
        };
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm }  {
        return AdvantageI18nForm;
    }

}