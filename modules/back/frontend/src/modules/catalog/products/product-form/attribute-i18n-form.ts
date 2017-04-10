import {MyCropperImage} from "../../../../common/my-cropper/my-cropper-image";
import {I18nForm} from "../../../../common/i18n-form";

export class AttributeI18nForm extends I18nForm  {

    public name: string;
    public value: string;

    public saveI18n: boolean = true;

    reset(): any {
        this.name = '';
        this.value = '';
    }

    populate(data: any): any {
        this.name = data['name'];
        this.value = data['value'];
    }

    getData(): any {
        return {
            name: this.name,
            value: this.value,
        };
    }

}