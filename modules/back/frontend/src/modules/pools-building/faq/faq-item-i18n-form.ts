import {I18nForm} from "../../../common/i18n-form";

export class FaqItemI18nForm extends I18nForm {

    public question: string = '';
    public answer: string = '';

    reset(): any {
        this.question = '';
        this.answer = '';
    }

    populate(data: any): any {
        Object.assign(this, data);
    }

    getData():any {
        return {
            question: this.question,
            answer: this.answer,
        };
    }

}