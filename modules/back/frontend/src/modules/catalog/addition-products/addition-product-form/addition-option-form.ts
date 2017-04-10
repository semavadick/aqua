import {MyCropperImage} from "../../../../common/my-cropper/my-cropper-image";
import {EntityForm} from "../../../../common/entity-form";
import {BackendService} from "../../../../services/backend.service";
import {LanguagesManager} from "../../../../services/languages-manager";
import {Language} from "../../../../services/language";
import {I18nForm} from "../../../../common/i18n-form";
import {AdditionOptionI18nForm} from "./addition-option-i18n-form";

export class AdditionOptionForm extends EntityForm  {

    public id: number = null;
    public type: number = null;
    public main: number = null;
    public show_default: boolean = false;

    constructor(private langsManager: LanguagesManager) {
        super();
    }

    protected getBackend():BackendService {
        return null;
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    protected getI18nFormClass():{ new(language: Language): I18nForm } {
        return AdditionOptionI18nForm;
    }

    reset(): any {
        this.id = null;
        this.type = null;
        this.main = null;
        for(let i18n of this.getI18ns()) {
            i18n.reset();
        }
    }

    populate(data: any): any {
        this.id = data['id'];
        this.type = data['type'];
        this.main = data['main'];
        if(data['type'] == 4 || data['type'] == 3 || data['type'] == 2) this.show_default = true;
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
            i18nData['languageId'] = i18n.language.id;
            i18nsData.push(i18nData);
        }
        return {
            id: this.id,
            type: parseInt(this.type),
            main: parseInt(this.main),
            i18ns: i18nsData,
        };
    }

}