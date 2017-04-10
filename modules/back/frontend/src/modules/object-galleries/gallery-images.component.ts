import { Component, Input, Type, OnInit, ViewChild, ElementRef } from '@angular/core';
import {LanguagesManager} from "../../services/languages-manager";
import {MyGridComponent} from "../../common/my-grid/my-grid.component";
import {MyThumbComponent} from "../../common/my-thumb/my-thumb.component";
import {MyModalComponent} from "../../common/my-modal/my-modal.component";
import {I18nTabsComponent} from "../../common/i18n-tabs/i18n-tabs.component";
import {FormGroupComponent} from "../../common/form-group/form-group.component";
import {FormButtonComponent} from "../../common/form-button/form-button.component";
import {MyCropperComponent} from "../../common/my-cropper/my-cropper.component";
import {GalleryImageForm} from "./gallery-image-form";

@Component({
    selector: 'gallery-images',
    templateUrl: './gallery-images.html',
    directives: [
        <Type>MyGridComponent, <Type>MyThumbComponent, <Type>MyModalComponent,
        <Type>FormGroupComponent, <Type>FormButtonComponent,
        <Type>MyCropperComponent,
    ],
})
export class GalleryImagesComponent {

    @Input()
    public images: GalleryImageForm[] = [];

    @ViewChild(<Type>MyModalComponent, undefined)
    private modal: MyModalComponent;

    constructor(private eRef: ElementRef) {
        this.modalForm = new GalleryImageForm();

    }

    public modalForm: GalleryImageForm;
    public updatingModalForm: GalleryImageForm = null;

    public updateImage(imageForm: GalleryImageForm) {
        this.updatingModalForm = imageForm;
        this.modalForm.reset();
        this.modalForm.image.currentImageUrl = imageForm.image.currentImageUrl;
        this.modalForm.image.uploadedImage = imageForm.image.uploadedImage;
        this.modalForm.image.croppedImage = imageForm.image.croppedImage;
        this.modal.open();
        this.modal.setTitle('Редактирование изображения');
    }

    public saveImage() {
        this.modal.close();
        this.updatingModalForm.image.uploadedImage = this.modalForm.image.uploadedImage;
        this.updatingModalForm.image.croppedImage = this.modalForm.image.croppedImage;
    }

    public addImages() {
        this.eRef.nativeElement.querySelector('[type=file]').click();
    }

    public deleteImage(image: GalleryImageForm) {
        var index = this.images.indexOf(image);
        this.images.splice(index, 1);
    }

    public fileChangeListener($event: any) {
        for(let file of $event.target.files) {
            var myReader: FileReader = new FileReader();
            myReader.onloadend = (loadEvent: any) => {
                var dataUrl: string = loadEvent.target.result;
                var imageForm = new GalleryImageForm();
                imageForm.image.uploadedImage = dataUrl;
                imageForm.image.croppedImage = dataUrl;
                imageForm.sort = (this.images.length + 1);
                this.images.push(imageForm);
            };
            myReader.readAsDataURL(file);
        }
        $event.target.value = '';
    }
}
