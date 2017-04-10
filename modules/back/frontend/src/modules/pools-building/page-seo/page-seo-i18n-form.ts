import {I18nForm} from "../../../common/i18n-form";

export class PageSeoI18nForm extends I18nForm {

    public title: string = '';
    public metaKeywords: string = '';
    public metaDescription: string = '';

    public saveI18n: boolean = true;

    reset(): any {
        this.title = '';
        this.metaKeywords = '';
        this.metaDescription = '';
    }

    populate(data: any): any {
        Object.assign(this, data);
    }

    getData():any {
        return {
            title: this.title,
            metaKeywords: this.metaKeywords,
            metaDescription: this.metaDescription,
        };
    }

}