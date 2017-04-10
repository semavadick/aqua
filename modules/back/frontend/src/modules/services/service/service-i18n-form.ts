import {I18nForm} from "../../../common/i18n-form";
import {FileUploaderModel} from "../../../common/file-uploader/file-uploader-model";

export abstract class ServiceI18nForm extends I18nForm {

    public name: string = '';
    public description: string = '';
    public additDescription: string = '';
    public video: string = '';
    public slug: string = '';
    public pageTitle: string = '';
    public pageMetaKeywords: string = '';
    public pageMetaDescription: string = '';

    public saveI18n: boolean = true;

    reset(): any {
        this.name = '';
        this.description = '';
        this.slug = '';
        this.pageTitle = '';
        this.pageMetaKeywords = '';
        this.pageMetaDescription = '';
        this.video = '';
    }

    populate(data: any): any {
        this.name = data['name'];
        this.additDescription = data['additDescription'];
        this.description = data['description'];
        this.video = data['video'];
        this.slug = data['slug'];
        this.pageTitle = data['pageTitle'];
        this.pageMetaKeywords = data['pageMetaKeywords'];
        this.pageMetaDescription = data['pageMetaDescription'];
    }

    getData():any {
        return {
            name: this.name,
            description: this.description,
            additDescription: this.additDescription,
            video: this.video,
            slug: this.slug,
            pageTitle: this.pageTitle,
            pageMetaKeywords: this.pageMetaKeywords,
            pageMetaDescription: this.pageMetaDescription,
        };
    }

    public abstract hasAdditDescription(): boolean;

    public abstract hasVideo(): boolean;

}