import {MyCropperImage} from "../../../../common/my-cropper/my-cropper-image";
import {EntityForm} from "../../../../common/entity-form";
import {BackendService} from "../../../../services/backend.service";
import {LanguagesManager} from "../../../../services/languages-manager";
import {Language} from "../../../../services/language";
import {I18nForm} from "../../../../common/i18n-form";
import {AttributeI18nForm} from "./attribute-i18n-form";

export class AttributeForm extends EntityForm  {

    public id: number = null;

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
        return AttributeI18nForm;
    }

    reset(): any {
        this.id = null;
        for(let i18n of this.getI18ns()) {
            i18n.reset();
        }
    }

    populate(data: any): any {
        this.id = data['id'];
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
            i18ns: i18nsData,
        };
    }

}