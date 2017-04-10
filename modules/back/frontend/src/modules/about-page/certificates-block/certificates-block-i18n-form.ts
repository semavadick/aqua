import {I18nForm} from "../../../common/i18n-form";

export class CertificatesBlockI18nForm extends I18nForm {

    public menuName: string = '';
    public title: string = '';

    public saveI18n: boolean = true;

    reset(): any {
        this.menuName = '';
        this.title = '';
    }

    populate(data: any): any {
        this.menuName = data['menuName'];
        this.title = data['title'];
    }

    getData():any {
        return {
            menuName: this.menuName,
            title: this.title,
        };
    }

}