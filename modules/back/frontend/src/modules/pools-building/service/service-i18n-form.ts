import {I18nForm} from "../../../common/i18n-form";
import {FileUploaderModel} from "../../../common/file-uploader/file-uploader-model";

export abstract class ServiceI18nForm extends I18nForm {

    public title: string = '';
    public text: string = '';
    public presentation: FileUploaderModel = new FileUploaderModel();

    public saveI18n: boolean = true;

    reset(): any {
        this.title = '';
        this.text = '';
        this.presentation.reset();
    }

    populate(data: any): any {
        this.title = data['title'];
        this.text = data['text'];
        this.presentation.currentFileUrl = data['presentationUrl'];
    }

    getData():any {
        return {
            title: this.title,
            text: this.text,
            presentationUrl: this.presentation.uploadedFileUrl,
            presentationName: this.presentation.uploadedFileName,
        };
    }

}