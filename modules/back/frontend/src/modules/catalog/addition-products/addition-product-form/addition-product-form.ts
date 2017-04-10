import {Injectable} from "@angular/core";
import {Response} from "@angular/http";
import {MyDatatableEntityForm} from "../../../../common/my-datatable/my-datatable-entity-form";
import {BackendService} from "../../../../services/backend.service";
import {LanguagesManager} from "../../../../services/languages-manager";
import {Language} from "../../../../services/language";
import {I18nForm} from "../../../../common/i18n-form";
import {MyCropperImage} from "../../../../common/my-cropper/my-cropper-image";
import {AdditionProductI18Form} from "./addition-product-i18-form";
import {FileUploaderModel} from "../../../../common/file-uploader/file-uploader-model";
import {AdditionTabForm} from "./addition-tab-form";
import {AdditionOptionForm} from "./addition-option-form";
import {AdditionImageForm} from "./addition-image-form";
import {MyDatatableEntity} from "../../../../common/my-datatable/my-datatable-entity";
import {AdditionCategory} from "../../addition-categories/addition-category";
import {AdditionProduct} from "../addition-product";
import {Product} from "../../products/product";

@Injectable()
export class AdditionProductForm extends MyDatatableEntityForm {

    public categoryId: number = null;
    public sku: string;
    public isOnOffer: boolean = true;
    public price: number = 0;
    public kupelType: boolean = false;
    public figure: string = '';
    public preview: MyCropperImage = new MyCropperImage();
    public circuit: FileUploaderModel = new FileUploaderModel();
    public draft: FileUploaderModel = new FileUploaderModel();
    public certificate: FileUploaderModel = new FileUploaderModel();
    public tabs: AdditionTabForm[] = [];
    public options: AdditionOptionForm[] = [];
    public images: AdditionImageForm[] = [];
    public relatedProductsIds: number[] = [];
    public relatedAdditionProductsIds: number[] = [];
    public relatedProducts = [];
    private product: AdditionProduct = null;

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    public init(entity: MyDatatableEntity = null): Promise<string> {
        this.product = <AdditionProduct>entity;
        return super.init(entity)
            .then((message: string) => {
                return this.initFormSelects();
            });
    }

    private initFormSelects(): Promise<string> {
        this.isLoading = true;
        return new Promise<string>((resolve, reject) => {
            var url = 'catalog/addition-product-form-select';
            if(this.categoryId) {
                url += '/' + this.categoryId;
            }
            if(this.product) {
                url += '?productId=' + this.product.id;
            }
            this.getBackend().get(url)
                .then((resp: Response) => {
                    var data = resp.json();
                    this.relatedProducts = data['relatedProducts'];
                    this.isLoading = false;
                    resolve('ok');
                })
                .catch((resp: Response) => {
                    this.isLoading = false;
                    reject(resp.text());
                });
        });
    }

    public setCategory(category: AdditionCategory) {
        this.categoryId = category ? category.id : null;
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    protected getBackendUrl():string {
        return 'catalog/addition-products';
    }

    reset():any {
        this.sku = '';
        this.figure = '';
        this.isOnOffer = true;
        this.kupelType = false;
        this.price = 0;
        this.preview.reset();
        this.circuit.reset();
        this.certificate.reset();
        this.draft.reset();
        this.tabs = [];
        this.options = [];
        this.images = [];
        this.relatedProductsIds = [];
        this.relatedAdditionProductsIds = [];
        this.relatedProducts = [];
    }

    populate(data:any):any {
        this.sku = data['sku'];
        this.price = data['price'];
        this.isOnOffer = data['isOnOffer'];
        this.kupelType = data['kupelType'];
        this.categoryId = data['categoryId'];
        this.preview.currentImageUrl = data['previewUrl'];
        this.figure = data['figure'];
        this.circuit.currentFileUrl = data['circuitUrl'];
        this.certificate.currentFileUrl = data['certificateUrl'];
        this.draft.currentFileUrl = data['draftUrl'];
        for(let tabData of data['tabs']) {
            var tab = new AdditionTabForm(this.langsManager);
            tab.populate(tabData);
            this.tabs.push(tab);
        }
        for(let optionData of data['options']) {
            var option = new AdditionOptionForm(this.langsManager);
            option.populate(optionData);
            this.options.push(option);
        }
        for(let imageData of data['images']) {
            var image = new AdditionImageForm(this.langsManager);
            image.populate(imageData);
            this.images.push(image);
        }
        this.relatedProductsIds = data['relatedProductsIds'];
        this.relatedAdditionProductsIds = data['relatedAdditionProductsIds'];
    }

    getData():any {
        var imagesData: Object[] = [];
        for(let image of this.images) {
            imagesData.push(image.getData());
        }
        var tabsData: Object[] = [];
        for(let tab of this.tabs) {
            tabsData.push(tab.getData());
        }
        var optionsData: Object[] = [];
        for(let option of this.options) {
            optionsData.push(option.getData());
        }
        return {
            categoryId: this.categoryId,
            price: this.price,
            isOnOffer: this.isOnOffer,
            kupelType: this.kupelType,
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
            tabs: tabsData,
            options: optionsData,
            relatedProductsIds: this.relatedProductsIds,
            relatedAdditionProductsIds: this.relatedAdditionProductsIds
        };
    }

    public loadRelatedProducts(query: string): Promise {
        return new Promise((resolve) => {
            var url = 'catalog/related-addition-products/' + query;
            if(this.product) {
                url += '?id=' + this.product.id;
            }
            this.backend.get(url)
                .then((resp: Response) => {
                    // Оставляем только уже добавленные товары
                    var relProducts = this.relatedProducts;
                    this.relatedProducts = [];

                    for(let relProduct of relProducts) {
                        if(this.relatedProductsIds.indexOf(relProduct.id) >= 0 && relProduct.type != 1) {
                            this.relatedProducts.push(relProduct);
                        }
                        if(this.relatedAdditionProductsIds.indexOf(relProduct.id) >= 0 && relProduct.type == 1) {
                            this.relatedProducts.push(relProduct);
                        }
                    }

                    for(let prodData of resp.json()) {
                        var product = (prodData.type != 1) ? new Product(prodData['id']) : new AdditionProduct(prodData['id']);
                        product.name = prodData['name'];
                        product.type = prodData['type'];
                        var addProduct = (prodData['type'] != 1) ? this.relatedProductsIds.indexOf(product.id) === -1 : this.relatedAdditionProductsIds.indexOf(product.id) === -1;
                        if(addProduct) {
                            this.relatedProducts.push(product);
                        }
                    }

                    resolve(this.relatedProducts);
                })
                .catch((resp: Response) => {
                    alert(resp.text());
                });
        });
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm} {
        return AdditionProductI18Form;
    }

    public changeKupeliType(event){
        console.log(event);
    }

}