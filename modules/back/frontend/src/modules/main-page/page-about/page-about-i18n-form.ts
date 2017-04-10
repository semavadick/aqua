import {I18nForm} from "../../../common/i18n-form";

export class PageAboutI18nForm extends I18nForm {

    public title: string = '';
    public text: string = '';
    public video: string = '';

    public saveI18n: boolean = false;

    reset(): any {
        this.title = '';
        this.text = '';
        this.video = '';
    }

    populate(data: any): any {
        Object.assign(this, data);
    }

    getData():any {
        return {
            title: this.title,
            text: this.text,
            video: this.video,
        };
    }

}