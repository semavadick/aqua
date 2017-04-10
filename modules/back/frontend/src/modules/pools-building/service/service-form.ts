import { Injectable } from '@angular/core';
import { BackendService } from "../../../services/backend.service";
import { I18nForm } from "../../../common/i18n-form";
import { LanguagesManager } from "../../../services/languages-manager";
import { Language } from "../../../services/language";
import { FormPanelForm } from "../../../common/form-panel/form-panel-form";
import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";

export abstract class ServiceForm extends FormPanelForm {

    public icon: MyCropperImage = new MyCropperImage();
    public image: MyCropperImage = new MyCropperImage();

    reset(): any {
        this.icon.reset();
        this.image.reset();
    }

    populate(data: any): any {
        this.icon.currentImageUrl = data['iconUrl'];
        this.image.currentImageUrl = data['imageUrl'];
    }

    getData(): any {
        return {
            icon: this.icon.croppedImage,
            image: this.image.croppedImage,
        };
    }

}
