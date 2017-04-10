"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require('@angular/core');
var publication_form_1 = require("./publication-form");
var publication_gallery_form_1 = require("./publication-gallery-form");
var languages_manager_1 = require("../../services/languages-manager");
var my_grid_component_1 = require("../../common/my-grid/my-grid.component");
var my_thumb_component_1 = require("../../common/my-thumb/my-thumb.component");
var publication_gallery_image_form_1 = require("./publication-gallery-image-form");
var my_modal_component_1 = require("../../common/my-modal/my-modal.component");
var i18n_tabs_component_1 = require("../../common/i18n-tabs/i18n-tabs.component");
var form_group_component_1 = require("../../common/form-group/form-group.component");
var form_button_component_1 = require("../../common/form-button/form-button.component");
var my_cropper_component_1 = require("../../common/my-cropper/my-cropper.component");
var PublicationGalleriesComponent = (function () {
    function PublicationGalleriesComponent(langsManager, eRef) {
        this.langsManager = langsManager;
        this.eRef = eRef;
        this.updatingModalForm = null;
        this.galleryToAddImages = null;
        this.modalForm = new publication_gallery_image_form_1.PublicationGalleryImageForm(this.langsManager);
    }
    PublicationGalleriesComponent.prototype.addGallery = function () {
        var gallery = new publication_gallery_form_1.PublicationGalleryForm(this.langsManager);
        this.form.galleries.push(gallery);
    };
    PublicationGalleriesComponent.prototype.updateImage = function (imageForm) {
        this.updatingModalForm = imageForm;
        this.modalForm.reset();
        this.modalForm.image.currentImageUrl = imageForm.image.currentImageUrl;
        this.modalForm.image.croppedImage = imageForm.image.croppedImage;
        this.modalForm.image.uploadedImage = imageForm.image.uploadedImage;
        for (var _i = 0, _a = imageForm.getI18ns(); _i < _a.length; _i++) {
            var i18n = _a[_i];
            for (var _b = 0, _c = this.modalForm.getI18ns(); _b < _c.length; _b++) {
                var i18nTmp = _c[_b];
                if (i18n.language.id == i18nTmp.language.id) {
                    i18nTmp['name'] = i18n['name'];
                    break;
                }
            }
        }
        this.modal.open();
        this.modal.setTitle('Редактирование изображения');
        this.i18ns.init(imageForm);
    };
    PublicationGalleriesComponent.prototype.saveImage = function () {
        this.modal.close();
        this.updatingModalForm.image.croppedImage = this.modalForm.image.croppedImage;
        this.updatingModalForm.image.uploadedImage = this.modalForm.image.uploadedImage;
        for (var _i = 0, _a = this.updatingModalForm.getI18ns(); _i < _a.length; _i++) {
            var i18n = _a[_i];
            for (var _b = 0, _c = this.modalForm.getI18ns(); _b < _c.length; _b++) {
                var i18nTmp = _c[_b];
                if (i18n.language.id == i18nTmp.language.id) {
                    i18n['name'] = i18nTmp['name'];
                    break;
                }
            }
        }
    };
    PublicationGalleriesComponent.prototype.deleteImage = function (gallery, image) {
        var index = gallery.images.indexOf(image);
        gallery.images.splice(index, 1);
    };
    PublicationGalleriesComponent.prototype.fileChangeListener = function ($event) {
        var _this = this;
        for (var _i = 0, _a = $event.target.files; _i < _a.length; _i++) {
            var file = _a[_i];
            var myReader = new FileReader();
            myReader.onloadend = function (loadEvent) {
                var dataUrl = loadEvent.target.result;
                var imageForm = new publication_gallery_image_form_1.PublicationGalleryImageForm(_this.langsManager);
                imageForm.image.uploadedImage = dataUrl;
                imageForm.image.croppedImage = dataUrl;
                _this.galleryToAddImages.images.push(imageForm);
            };
            myReader.readAsDataURL(file);
        }
        $event.target.value = '';
    };
    PublicationGalleriesComponent.prototype.addImages = function (gallery) {
        this.galleryToAddImages = gallery;
        this.eRef.nativeElement.querySelector('[type=file]').click();
    };
    PublicationGalleriesComponent.prototype.deleteGallery = function (gallery) {
        if (confirm('Удалить галерею?')) {
            var index = this.form.galleries.indexOf(gallery);
            this.form.galleries.splice(index, 1);
        }
    };
    __decorate([
        core_1.Input(), 
        __metadata('design:type', publication_form_1.PublicationForm)
    ], PublicationGalleriesComponent.prototype, "form", void 0);
    __decorate([
        core_1.ViewChild(my_modal_component_1.MyModalComponent, undefined), 
        __metadata('design:type', my_modal_component_1.MyModalComponent)
    ], PublicationGalleriesComponent.prototype, "modal", void 0);
    __decorate([
        core_1.ViewChild(i18n_tabs_component_1.I18nTabsComponent, undefined), 
        __metadata('design:type', i18n_tabs_component_1.I18nTabsComponent)
    ], PublicationGalleriesComponent.prototype, "i18ns", void 0);
    PublicationGalleriesComponent = __decorate([
        core_1.Component({
            selector: 'publication-galleries',
            templateUrl: './publication-galleries.html',
            directives: [
                my_grid_component_1.MyGridComponent, my_thumb_component_1.MyThumbComponent, my_modal_component_1.MyModalComponent,
                i18n_tabs_component_1.I18nTabsComponent, form_group_component_1.FormGroupComponent, form_button_component_1.FormButtonComponent,
                my_cropper_component_1.MyCropperComponent,
            ]
        }), 
        __metadata('design:paramtypes', [languages_manager_1.LanguagesManager, (typeof (_a = typeof core_1.ElementRef !== 'undefined' && core_1.ElementRef) === 'function' && _a) || Object])
    ], PublicationGalleriesComponent);
    return PublicationGalleriesComponent;
    var _a;
}());
exports.PublicationGalleriesComponent = PublicationGalleriesComponent;
//# sourceMappingURL=publication-galleries.component.js.map