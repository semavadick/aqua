import {I18nForm} from "../../../common/i18n-form";
import {FileUploaderModel} from "../../../common/file-uploader/file-uploader-model";

export abstract class PoolsBuildingStaticI18nForm extends I18nForm {

    public name: string = '';
    public shortDescription: string = '';
    public description: string = '';
    public slug: string = '';
    public pageTitle: string = '';
    public pageMetaKeywords: string = '';
    public pageMetaDescription: string = '';

    reset(): any {
        this.name = '';
        this.shortDescription = '';
        this.description = '';
        this.slug = '';
        this.pageTitle = '';
        this.pageMetaKeywords = '';
        this.pageMetaDescription = '';
    }

    populate(data: any): any {
        this.name = data['name'];
        this.shortDescription = data['shortDescription'];
        this.description = data['description'];
        this.slug = data['slug'];
        this.pageTitle = data['pageTitle'];
        this.pageMetaKeywords = data['pageMetaKeywords'];
        this.pageMetaDescription = data['pageMetaDescription'];
    }

    getData():any {
        return {
            name: this.name,
            shortDescription: this.shortDescription,
            description: this.description,
            slug: this.slug,
            pageTitle: this.pageTitle,
            pageMetaKeywords: this.pageMetaKeywords,
            pageMetaDescription: this.pageMetaDescription,
        };
    }
}