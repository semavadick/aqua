import {I18nForm} from "../../../common/i18n-form";
import {FileUploaderModel} from "../../../common/file-uploader/file-uploader-model";
import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";

export class GeneralI18nForm extends I18nForm {

    public deliveryDescription: string = '';
    public title: string = '';
    public metaKeywords: string = '';
    public metaDescription: string = '';
    public catalogImage: MyCropperImage = new MyCropperImage();
    public catalogFile: FileUploaderModel = new FileUploaderModel();

    public saveI18n: boolean = true;

    reset(): any {
        this.deliveryDescription = '';
        this.title = '';
        this.metaKeywords = '';
        this.metaDescription = '';
        this.catalogImage.reset();
        this.catalogFile.reset();
    }

    populate(data: any): any {
        this.deliveryDescription = data['deliveryDescription'];
        this.title = data['title'];
        this.metaKeywords = data['metaKeywords'];
        this.metaDescription = data['metaDescription'];
        this.catalogImage.currentImageUrl = data['catalogImageUrl'];
        this.catalogFile.currentFileUrl = data['catalogFileUrl'];
    }

    getData():any {
        return {
            deliveryDescription: this.deliveryDescription,
            title: this.title,
            metaKeywords: this.metaKeywords,
            metaDescription: this.metaDescription,
            catalogImage: this.catalogImage.croppedImage,
            catalogFileUrl: this.catalogFile.uploadedFileUrl,
            catalogFileName: this.catalogFile.uploadedFileName,
        };
    }

}