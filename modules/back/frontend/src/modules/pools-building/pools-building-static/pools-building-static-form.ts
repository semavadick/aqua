import { Injectable } from '@angular/core';
import { BackendService } from "../../../services/backend.service";
import { I18nForm } from "../../../common/i18n-form";
import { LanguagesManager } from "../../../services/languages-manager";
import { Language } from "../../../services/language";
import { FormPanelForm } from "../../../common/form-panel/form-panel-form";
import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";
import {PoolsBuildingStaticI18nForm} from "./pools-building-static-i18n-form";
import {PoolsBuildingStaticGalleryForm} from "./pools-building-static-gallery-form";

export abstract class PoolsBuildingStaticForm extends FormPanelForm {

    public bg: MyCropperImage = new MyCropperImage();
    public galleries: PoolsBuildingStaticGalleryForm[] = [];

    reset(): any {
        this.bg.reset();
        this.galleries = [];
    }

    populate(data: any): any {
        this.bg.currentImageUrl = data['bgUrl'];
        for(let galleryData of data['galleries']) {
            var gallery = new PoolsBuildingStaticGalleryForm(this.getLanguagesManager());
            gallery.populate(galleryData);
            this.galleries.push(gallery);
        }
    }

    getData(): any {
        var galleriesData: Object[] = [];
        for(let gallery of this.galleries) {
            galleriesData.push(gallery.getData());
        }
        return {
            bg: this.bg.croppedImage,
            galleries: galleriesData,
        };
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm} {
        return PoolsBuildingStaticI18nForm;
    }

    public setErrors(errors: Object) {
        super.setErrors(errors);
    }

    public abstract hasBg(): boolean;

    public save(): Promise<string> {
        var url = this.getBackendUrl();
        return this.saveViaUrl(url, false)
            .then(() => {
                return this.init();
            });;
    }
}
