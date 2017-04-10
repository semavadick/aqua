import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";
import {I18nForm} from "../../../common/i18n-form";

export class AdvantageI18nForm extends I18nForm {

    public text: string = '';

    public saveI18n: boolean = true;

    reset():any {
        this.text = '';
    }

    populate(data:any):any {
        this.text = data['text'];
    }

    getData():any {
        return {
            text: this.text,
        };
    }

}