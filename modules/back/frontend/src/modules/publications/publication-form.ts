import {Injectable} from "@angular/core";
import {MyDatatableEntityForm} from "../../common/my-datatable/my-datatable-entity-form";
import {BackendService} from "../../services/backend.service";
import {LanguagesManager} from "../../services/languages-manager";
import {Language} from "../../services/language";
import {I18nForm} from "../../common/i18n-form";
import {PublicationI18nForm} from "./publication-i18n-form";
import {MyCropperImage} from "../../common/my-cropper/my-cropper-image";
import {PublicationGalleryForm} from "../publications/publication-gallery-form";

export abstract class PublicationForm extends MyDatatableEntityForm {

    public preview: MyCropperImage = new MyCropperImage();
    public bg: MyCropperImage = new MyCropperImage();
    public galleries: PublicationGalleryForm[] = [];
    public addedDate = '';
    public addedTime = '';
    public active:boolean = true;

    reset():any {
        this.preview.reset();
        this.bg.reset();
        this.galleries = [];
        this.addedDate = '';
        this.addedTime = '';
        this.active = true;
    }

    populate(data:any):any {
        this.preview.currentImageUrl = data['previewUrl'];
        this.bg.currentImageUrl = data['bgUrl'];
        this.active = data['active'];
        var datetime = data['added'].split(' ');
        this.addedDate = datetime[0];
        this.addedTime = datetime[1];
        for(let galleryData of data['galleries']) {
            var gallery = new PublicationGalleryForm(this.getLanguagesManager());
            gallery.populate(galleryData);
            this.galleries.push(gallery);
        }
    }

    getData():any {
        var galleriesData: Object[] = [];
        for(let gallery of this.galleries) {
            galleriesData.push(gallery.getData());
        }
        return {
            preview: this.preview.croppedImage,
            bg: this.bg.croppedImage,
            added: this.addedDate + ' ' + this.addedTime,
            active: this.active,
            galleries: galleriesData,
        };
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm} {
        return PublicationI18nForm;
    }

}