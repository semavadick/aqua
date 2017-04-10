import {I18nForm} from "../../../common/i18n-form";

export class AdvantageI18nForm extends I18nForm {

    public tagline: string = '';
    public text: string = '';

    reset(): any {
        this.tagline = '';
        this.text = '';
    }

    populate(data: any): any {
        Object.assign(this, data);
    }

    getData():any {
        return {
            tagline: this.tagline,
            text: this.text,
        };
    }

}