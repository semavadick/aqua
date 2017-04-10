import {Form} from "../../common/form";
import {MyCropperImage} from "../../common/my-cropper/my-cropper-image";
import {I18nForm} from "../../common/i18n-form";

export class PublicationGalleryImageI18nForm extends I18nForm {

    public name: string = '';

    public saveI18n: boolean = true;

    reset():any {
        this.name = '';
    }

    populate(data:any):any {
        this.name = data['name'];
    }

    getData():any {
        return {
            name: this.name,
        };
    }

}