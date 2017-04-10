import {I18nForm} from "../../../common/i18n-form";
import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";

export class HistoryI18nForm extends I18nForm {

    public image: MyCropperImage = new MyCropperImage();

    public saveI18n: boolean = true;

    reset(): any {
        this.image.reset();
    }

    populate(data: any): any {
        this.image.currentImageUrl = data['imageUrl'];
    }

    getData():any {
        return {
            image: this.image.croppedImage,
        };
    }

}