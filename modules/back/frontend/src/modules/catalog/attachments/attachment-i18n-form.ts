import {I18nForm} from "../../../common/i18n-form";

export class AttachmentI18nForm extends I18nForm {

    public text: string = '';

    reset(): any {
        this.text = '';
    }

    populate(data: any): any {
        Object.assign(this, data);
    }

    getData():any {
        return {
            text: this.text,
        };
    }

}