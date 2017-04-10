import {ServiceI18nForm} from "../service/service-i18n-form";

export class ExclusiveI18nForm extends ServiceI18nForm {

    public hasAdditDescription():boolean {
        return true;
    }

    public hasVideo():boolean {
        return true;
    }
}