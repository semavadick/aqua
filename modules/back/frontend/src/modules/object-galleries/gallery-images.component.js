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
var my_grid_component_1 = require("../../common/my-grid/my-grid.component");
var my_thumb_component_1 = require("../../common/my-thumb/my-thumb.component");
var my_modal_component_1 = require("../../common/my-modal/my-modal.component");
var form_group_component_1 = require("../../common/form-group/form-group.component");
var form_button_component_1 = require("../../common/form-button/form-button.component");
var my_cropper_component_1 = require("../../common/my-cropper/my-cropper.component");
var gallery_image_form_1 = require("./gallery-image-form");
var GalleryImagesComponent = (function () {
    function GalleryImagesComponent(eRef) {
        this.eRef = eRef;
        this.images = [];
        this.updatingModalForm = null;
        this.modalForm = new gallery_image_form_1.GalleryImageForm();
    }
    GalleryImagesComponent.prototype.updateImage = function (imageForm) {
        this.updatingModalForm = imageForm;
        this.modalForm.reset();
        this.modalForm.image.currentImageUrl = imageForm.image.currentImageUrl;
        this.modalForm.image.uploadedImage = imageForm.image.uploadedImage;
        this.modalForm.image.croppedImage = imageForm.image.croppedImage;
        this.modal.open();
        this.modal.setTitle('Редактирование изображения');
    };
    GalleryImagesComponent.prototype.saveImage = function () {
        this.modal.close();
        this.updatingModalForm.image.uploadedImage = this.modalForm.image.uploadedImage;
        this.updatingModalForm.image.croppedImage = this.modalForm.image.croppedImage;
    };
    GalleryImagesComponent.prototype.addImages = function () {
        this.eRef.nativeElement.querySelector('[type=file]').click();
    };
    GalleryImagesComponent.prototype.deleteImage = function (image) {
        var index = this.images.indexOf(image);
        this.images.splice(index, 1);
    };
    GalleryImagesComponent.prototype.fileChangeListener = function ($event) {
        var _this = this;
        for (var _i = 0, _a = $event.target.files; _i < _a.length; _i++) {
            var file = _a[_i];
            var myReader = new FileReader();
            myReader.onloadend = function (loadEvent) {
                var dataUrl = loadEvent.target.result;
                var imageForm = new gallery_image_form_1.GalleryImageForm();
                imageForm.image.uploadedImage = dataUrl;
                imageForm.image.croppedImage = dataUrl;
                _this.images.push(imageForm);
            };
            myReader.readAsDataURL(file);
        }
        $event.target.value = '';
    };
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Array)
    ], GalleryImagesComponent.prototype, "images", void 0);
    __decorate([
        core_1.ViewChild(my_modal_component_1.MyModalComponent, undefined), 
        __metadata('design:type', my_modal_component_1.MyModalComponent)
    ], GalleryImagesComponent.prototype, "modal", void 0);
    GalleryImagesComponent = __decorate([
        core_1.Component({
            selector: 'gallery-images',
            templateUrl: './gallery-images.html',
            directives: [
                my_grid_component_1.MyGridComponent, my_thumb_component_1.MyThumbComponent, my_modal_component_1.MyModalComponent,
                form_group_component_1.FormGroupComponent, form_button_component_1.FormButtonComponent,
                my_cropper_component_1.MyCropperComponent,
            ]
        }), 
        __metadata('design:paramtypes', [(typeof (_a = typeof core_1.ElementRef !== 'undefined' && core_1.ElementRef) === 'function' && _a) || Object])
    ], GalleryImagesComponent);
    return GalleryImagesComponent;
    var _a;
}());
exports.GalleryImagesComponent = GalleryImagesComponent;
//# sourceMappingURL=gallery-images.component.js.map