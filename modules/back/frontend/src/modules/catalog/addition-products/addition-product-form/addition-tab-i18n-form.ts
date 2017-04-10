import {MyCropperImage} from "../../../../common/my-cropper/my-cropper-image";
import {I18nForm} from "../../../../common/i18n-form";

export class AdditionTabI18nForm extends I18nForm  {

    public name: string;
    public content: string = '';

    public saveI18n: boolean = true;

    reset(): any {
        this.name = '';
        this.content = '';
    }

    populate(data: any): any {
        this.name = data['name'];
        this.content = data['content'];
    }

    getData(): any {
        return {
            name: this.name,
            content: this.content,
        };
    }

}