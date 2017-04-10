import {I18nForm} from "../../../common/i18n-form";

export class ProductionI18nForm extends I18nForm {

    public title: string = '';
    public text: string = '';

    public saveI18n: boolean = true;

    reset(): any {
        this.title = '';
        this.text = '';
    }

    populate(data: any): any {
        Object.assign(this, data);
    }

    getData():any {
        return {
            title: this.title,
            text: this.text,
        };
    }

}