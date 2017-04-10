import {I18nForm} from "../../../../common/i18n-form";

export class ProductI18Form extends I18nForm {

    public name: string = '';
    public description: string = '';
    public slug: string = '';
    public pageTitle: string = '';
    public pageMetaKeywords: string = '';
    public pageMetaDescription: string = '';

    reset(): any {
        this.name = '';
        this.description = '';
        this.slug = '';
        this.pageTitle = '';
        this.pageMetaKeywords = '';
        this.pageMetaDescription = '';
    }

    populate(data: any): any {
        Object.assign(this, data);
    }

    getData():any {
        return {
            name: this.name,
            description: this.description,
            slug: this.description,
            pageTitle: this.pageTitle,
            pageMetaKeywords: this.pageMetaKeywords,
            pageMetaDescription: this.pageMetaDescription,
        };
    }

}