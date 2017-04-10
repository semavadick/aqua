import { Component, Input, Type, OnInit, ViewChild, ElementRef } from '@angular/core';
import {PoolsBuildingStaticForm} from "./pools-building-static-form";
import {PoolsBuildingStaticGalleryForm} from "./pools-building-static-gallery-form";
import {LanguagesManager} from "../../../services/languages-manager";
import {MyGridComponent} from "../../../common/my-grid/my-grid.component";
import {MyThumbComponent} from "../../../common/my-thumb/my-thumb.component";
import {PoolsBuildingStaticGalleryImageForm} from "./pools-building-static-gallery-image-form";
import {MyModalComponent} from "../../../common/my-modal/my-modal.component";
import {I18nTabsComponent} from "../../../common/i18n-tabs/i18n-tabs.component";
import {FormGroupComponent} from "../../../common/form-group/form-group.component";
import {FormButtonComponent} from "../../../common/form-button/form-button.component";
import {MyCropperComponent} from "../../../common/my-cropper/my-cropper.component";

@Component({
    selector: 'pools-building-static-galleries',
    templateUrl: './pools-building-static-galleries.html',
    directives: [
        <Type>MyGridComponent, <Type>MyThumbComponent, <Type>MyModalComponent,
        <Type>I18nTabsComponent, <Type>FormGroupComponent, <Type>FormButtonComponent,
        <Type>MyCropperComponent,
    ]
})
export class PoolsBuildingStaticGalleriesComponent {

    @Input()
    public form: PoolsBuildingStaticForm;

    @ViewChild(<Type>MyModalComponent, undefined)
    private modal: MyModalComponent;

    @ViewChild(<Type>I18nTabsComponent, undefined)
    private i18ns: I18nTabsComponent;

    constructor(private langsManager: LanguagesManager, private eRef: ElementRef) {
        this.modalForm = new PoolsBuildingStaticGalleryImageForm(this.langsManager);
    }

    public addGallery() {
        var gallery = new PoolsBuildingStaticGalleryForm(this.langsManager);
        this.form.galleries.push(gallery);
    }

    public modalForm: PoolsBuildingStaticGalleryImageForm;
    public updatingModalForm: PoolsBuildingStaticGalleryImageForm = null;

    public updateImage(imageForm: PoolsBuildingStaticGalleryImageForm) {
        this.updatingModalForm = imageForm;
        this.modalForm.reset();
        this.modalForm.image.currentImageUrl = imageForm.image.currentImageUrl;
        this.modalForm.image.croppedImage = imageForm.image.croppedImage;
        this.modalForm.image.uploadedImage = imageForm.image.uploadedImage;
        for(let i18n of imageForm.getI18ns()) {
            for(let i18nTmp of this.modalForm.getI18ns()) {
                if(i18n.language.id == i18nTmp.language.id) {
                    i18nTmp['name'] = i18n['name'];
                    break;
                }
            }
        }
        this.modal.open();
        this.modal.setTitle('Редактирование изображения');
        this.i18ns.init(imageForm);
    }

    public saveImage() {
        this.modal.close();
        this.updatingModalForm.image.croppedImage = this.modalForm.image.croppedImage;
        this.updatingModalForm.image.uploadedImage = this.modalForm.image.uploadedImage;
        for(let i18n of this.updatingModalForm.getI18ns()) {
            for(let i18nTmp of this.modalForm.getI18ns()) {
                if(i18n.language.id == i18nTmp.language.id) {
                    i18n['name'] = i18nTmp['name'];
                    break;
                }
            }
        }
    }

    public deleteImage(gallery: PoolsBuildingStaticGalleryForm, image: PoolsBuildingStaticGalleryImageForm) {
        var index = gallery.images.indexOf(image);
        gallery.images.splice(index, 1);
    }

    public fileChangeListener($event: any) {
        for(let file of $event.target.files) {
            var myReader: FileReader = new FileReader();
            myReader.onloadend = (loadEvent: any) => {
                var dataUrl: string = loadEvent.target.result;
                var imageForm = new PoolsBuildingStaticGalleryImageForm(this.langsManager);
                imageForm.image.uploadedImage = dataUrl;
                imageForm.image.croppedImage = dataUrl;
                imageForm.sort = (this.images.length + 1);
                this.galleryToAddImages.images.push(imageForm);
            };
            myReader.readAsDataURL(file);
        }
        $event.target.value = '';
    }

    private galleryToAddImages: PoolsBuildingStaticGalleryForm = null;

    public addImages(gallery: PoolsBuildingStaticGalleryForm) {
        this.galleryToAddImages = gallery;
        this.eRef.nativeElement.querySelector('[type=file]').click();
    }

    public deleteGallery(gallery: PoolsBuildingStaticGalleryForm) {
        if(confirm('Удалить галерею?')) {
            var index = this.form.galleries.indexOf(gallery);
            this.form.galleries.splice(index, 1);
        }
    }

}
