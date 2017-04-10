import {I18nForm} from "../../../common/i18n-form";

export class OfficeI18nForm extends I18nForm {

    public name: string = '';
    public address: string = '';
    public phoneComment: string = '';
    public email: string = '';
    public comment: string = '';

    reset(): any {
        this.name = '';
        this.address = '';
        this.phoneComment = '';
        this.email = '';
        this.comment = '';
    }

    populate(data: any): any {
        Object.assign(this, data);
    }

    getData():any {
        return {
            name: this.name,
            address: this.address,
            phoneComment: this.phoneComment,
            email: this.email,
            comment: this.comment,
        };
    }

}