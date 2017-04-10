"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require("@angular/core");
var my_datatable_entity_form_1 = require("../../../../common/my-datatable/my-datatable-entity-form");
var backend_service_1 = require("../../../../services/backend.service");
var languages_manager_1 = require("../../../../services/languages-manager");
var my_cropper_image_1 = require("../../../../common/my-cropper/my-cropper-image");
var product_i18_form_1 = require("./product-i18-form");
var file_uploader_model_1 = require("../../../../common/file-uploader/file-uploader-model");
var attribute_form_1 = require("./attribute-form");
var image_form_1 = require("./image-form");
var product_1 = require("../product");
var ProductForm = (function (_super) {
    __extends(ProductForm, _super);
    function ProductForm(backend, langsManager) {
        _super.call(this);
        this.backend = backend;
        this.langsManager = langsManager;
        this.categoryId = null;
        this.isOnOffer = true;
        this.price = 0;
        this.figure = '';
        this.preview = new my_cropper_image_1.MyCropperImage();
        this.circuit = new file_uploader_model_1.FileUploaderModel();
        this.draft = new file_uploader_model_1.FileUploaderModel();
        this.certificate = new file_uploader_model_1.FileUploaderModel();
        this.attributes = [];
        this.images = [];
        this.relatedProductsIds = [];
        this.relatedProducts = [];
        this.filtersIds = [];
        this.attachmentsIds = [];
        this.attachments = [];
        this.filters = [];
        this.product = null;
    }
    ProductForm.prototype.init = function (entity) {
        var _this = this;
        if (entity === void 0) { entity = null; }
        this.product = entity;
        return _super.prototype.init.call(this, entity)
            .then(function (message) {
            return _this.initFormSelects();
        });
    };
    ProductForm.prototype.initFormSelects = function () {
        var _this = this;
        this.isLoading = true;
        return new Promise(function (resolve, reject) {
            var url = 'catalog/product-form-select';
            if (_this.categoryId) {
                url += '/' + _this.categoryId;
            }
            if (_this.product) {
                url += '?productId=' + _this.product.id;
            }
            _this.getBackend().get(url)
                .then(function (resp) {
                var data = resp.json();
                _this.attachments = data['attachments'];
                _this.filters = data['filters'];
                _this.relatedProducts = data['relatedProducts'];
                _this.isLoading = false;
                resolve('ok');
            })
                .catch(function (resp) {
                _this.isLoading = false;
                reject(resp.text());
            });
        });
    };
    ProductForm.prototype.setCategory = function (category) {
        this.categoryId = category ? category.id : null;
    };
    ProductForm.prototype.getBackend = function () {
        return this.backend;
    };
    ProductForm.prototype.getLanguagesManager = function () {
        return this.langsManager;
    };
    ProductForm.prototype.getBackendUrl = function () {
        return 'catalog/products';
    };
    ProductForm.prototype.reset = function () {
        this.sku = '';
        this.figure = '';
        this.isOnOffer = true;
        this.price = 0;
        this.preview.reset();
        this.circuit.reset();
        this.certificate.reset();
        this.draft.reset();
        this.attributes = [];
        this.images = [];
        this.filtersIds = [];
        this.relatedProductsIds = [];
        this.relatedProducts = [];
        this.attachmentsIds = [];
    };
    ProductForm.prototype.populate = function (data) {
        this.sku = data['sku'];
        this.price = data['price'];
        this.isOnOffer = data['isOnOffer'];
        this.categoryId = data['categoryId'];
        this.preview.currentImageUrl = data['previewUrl'];
        this.figure = data['figure'];
        this.circuit.currentFileUrl = data['circuitUrl'];
        this.certificate.currentFileUrl = data['certificateUrl'];
        this.draft.currentFileUrl = data['draftUrl'];
        for (var _i = 0, _a = data['attributes']; _i < _a.length; _i++) {
            var attributeData = _a[_i];
            var attribute = new attribute_form_1.AttributeForm(this.langsManager);
            attribute.populate(attributeData);
            this.attributes.push(attribute);
        }
        for (var _b = 0, _c = data['images']; _b < _c.length; _b++) {
            var imageData = _c[_b];
            var image = new image_form_1.ImageForm(this.langsManager);
            image.populate(imageData);
            this.images.push(image);
        }
        this.filtersIds = data['filtersIds'];
        this.relatedProductsIds = data['relatedProductsIds'];
        this.attachmentsIds = data['attachmentsIds'];
    };
    ProductForm.prototype.getData = function () {
        var imagesData = [];
        for (var _i = 0, _a = this.images; _i < _a.length; _i++) {
            var image = _a[_i];
            imagesData.push(image.getData());
        }
        var attributesData = [];
        for (var _b = 0, _c = this.attributes; _b < _c.length; _b++) {
            var attribute = _c[_b];
            attributesData.push(attribute.getData());
        }
        return {
            categoryId: this.categoryId,
            price: this.price,
            isOnOffer: this.isOnOffer,
            sku: this.sku,
            preview: this.preview.croppedImage,
            figure: this.figure,
            draftUrl: this.draft.uploadedFileUrl,
            draftName: this.draft.uploadedFileName,
            draftIsDeleted: this.draft.isDeleted,
            circuitUrl: this.circuit.uploadedFileUrl,
            circuitName: this.circuit.uploadedFileName,
            circuitIsDeleted: this.circuit.isDeleted,
            certificateUrl: this.certificate.uploadedFileUrl,
            certificateName: this.certificate.uploadedFileName,
            certificateIsDeleted: this.certificate.isDeleted,
            images: imagesData,
            attributes: attributesData,
            filtersIds: this.filtersIds,
            attachmentsIds: this.attachmentsIds,
            relatedProductsIds: this.relatedProductsIds,
        };
    };
    ProductForm.prototype.loadRelatedProducts = function (query) {
        var _this = this;
        return new Promise(function (resolve) {
            var url = 'catalog/related-products/' + query;
            if (_this.product) {
                url += '?id=' + _this.product.id;
            }
            _this.backend.get(url)
                .then(function (resp) {
                // Оставляем только уже добавленные товары
                var relProducts = _this.relatedProducts;
                _this.relatedProducts = [];
                for (var _i = 0, relProducts_1 = relProducts; _i < relProducts_1.length; _i++) {
                    var relProduct = relProducts_1[_i];
                    if (_this.relatedProductsIds.indexOf(relProduct.id) >= 0) {
                        _this.relatedProducts.push(relProduct);
                    }
                }
                for (var _a = 0, _b = resp.json(); _a < _b.length; _a++) {
                    var prodData = _b[_a];
                    var product = new product_1.Product(prodData['id']);
                    product.name = prodData['name'];
                    var addProduct = _this.relatedProductsIds.indexOf(product.id) === -1;
                    if (addProduct) {
                        _this.relatedProducts.push(product);
                    }
                }
                resolve(_this.relatedProducts);
            })
                .catch(function (resp) {
                alert(resp.text());
            });
        });
    };
    ProductForm.prototype.getI18nFormClass = function () {
        return product_i18_form_1.ProductI18Form;
    };
    ProductForm = __decorate([
        core_1.Injectable(), 
        __metadata('design:paramtypes', [backend_service_1.BackendService, languages_manager_1.LanguagesManager])
    ], ProductForm);
    return ProductForm;
}(my_datatable_entity_form_1.MyDatatableEntityForm));
exports.ProductForm = ProductForm;
//# sourceMappingURL=product-form.js.map