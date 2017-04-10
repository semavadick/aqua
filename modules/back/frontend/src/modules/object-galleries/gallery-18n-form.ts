import {I18nForm} from "../../common/i18n-form";

export class GalleryI18nForm extends I18nForm {

    public name: string = '';
    public address: string = '';
    public shortDescription: string = '';
    public description: string = '';
    public slug: string = '';
    public pageTitle: string = '';
    public pageMetaKeywords: string = '';
    public pageMetaDescription: string = '';

    reset(): any {
        this.name = '';
        this.address = '';
        this.shortDescription = '';
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
            address: this.name,
            shortDescription: this.shortDescription,
            description: this.description,
            slug: this.description,
            pageTitle: this.pageTitle,
            pageMetaKeywords: this.pageMetaKeywords,
            pageMetaDescription: this.pageMetaDescription,
        };
    }

}