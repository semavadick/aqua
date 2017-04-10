import {I18nForm} from "../../../common/i18n-form";

export class RegionI18nForm extends I18nForm {

    public name: string = '';

    reset(): any {
        this.name = '';
    }

    populate(data: any): any {
        Object.assign(this, data);
    }

    getData():any {
        return {
            name: this.name,
        };
    }

}