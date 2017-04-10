import {I18nForm} from "../../../common/i18n-form";

export class ProductionBannerDetailsI18nForm extends I18nForm {

    public text: string = '';
    public link: string = '';

    reset(): any {
        this.text = '';
        this.link = '';
    }

    populate(data: any): any {
        Object.assign(this, data);
    }

    getData():any {
        return {
            text: this.text,
            link: this.link,
        };
    }

}