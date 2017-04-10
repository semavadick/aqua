import {ServiceI18nForm} from "../service/service-i18n-form";

export class MaintenanceI18nForm extends ServiceI18nForm {

    public hasAdditDescription():boolean {
        return false;
    }

    public hasVideo():boolean {
        return false;
    }
}