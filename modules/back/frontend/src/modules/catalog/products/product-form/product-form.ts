import {Injectable} from "@angular/core";
import {Response} from "@angular/http";
import {MyDatatableEntityForm} from "../../../../common/my-datatable/my-datatable-entity-form";
import {BackendService} from "../../../../services/backend.service";
import {LanguagesManager} from "../../../../services/languages-manager";
import {Language} from "../../../../services/language";
import {I18nForm} from "../../../../common/i18n-form";
import {MyCropperImage} from "../../../../common/my-cropper/my-cropper-image";
import {ProductI18Form} from "./product-i18-form";
import {FileUploaderModel} from "../../../../common/file-uploader/file-uploader-model";
import {AttributeForm} from "./attribute-form";
import {ImageForm} from "./image-form";
import {MyDatatableEntity} from "../../../../common/my-datatable/my-datatable-entity";
import {Category} from "../../categories/category";
import {Product} from "../product";

@Injectable()
export class ProductForm extends MyDatatableEntityForm {

    public categoryId: number = null;
    public sku: string;
    public isOnOffer: boolean = true;
    public price: number = 0;
    public figure: string = '';
    public preview: MyCropperImage = new MyCropperImage();
    public circuit: FileUploaderModel = new FileUploaderModel();
    public draft: FileUploaderModel = new FileUploaderModel();
    public certificate: FileUploaderModel = new FileUploaderModel();
    public attributes: AttributeForm[] = [];
    public images: ImageForm[] = [];
    public relatedProductsIds: number[] = [];
    public relatedProducts: Product[] = [];
    public filtersIds: number[] = [];
    public attachmentsIds: number[] = [];
    public attachments: Object[] = [];
    public filters: Object[] = [];

    private product: Product = null;

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    public init(entity: MyDatatableEntity = null): Promise<string> {
        this.product = <Product>entity;
        return super.init(entity)
            .then((message: string) => {
                return this.initFormSelects();
            });
    }

    private initFormSelects(): Promise<string> {
        this.isLoading = true;
        return new Promise<string>((resolve, reject) => {
            var url = 'catalog/product-form-select';
            if(this.categoryId) {
                url += '/' + this.categoryId;
            }
            if(this.product) {
                url += '?productId=' + this.product.id;
            }
            this.getBackend().get(url)
                .then((resp: Response) => {
                    var data = resp.json();
                    this.attachments = data['attachments'];
                    this.filters = data['filters'];
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

    public setCategory(category: Category) {
        this.categoryId = category ? category.id : null;
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    protected getBackendUrl():string {
        return 'catalog/products';
    }

    reset():any {
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
    }

    populate(data:any):any {
        this.sku = data['sku'];
        this.price = data['price'];
        this.isOnOffer = data['isOnOffer'];
        this.categoryId = data['categoryId'];
        this.preview.currentImageUrl = data['previewUrl'];
        this.figure = data['figure'];
        this.circuit.currentFileUrl = data['circuitUrl'];
        this.certificate.currentFileUrl = data['certificateUrl'];
        this.draft.currentFileUrl = data['draftUrl'];
        for(let attributeData of data['attributes']) {
            var attribute = new AttributeForm(this.langsManager);
            attribute.populate(attributeData);
            this.attributes.push(attribute);
        }
        for(let imageData of data['images']) {
            var image = new ImageForm(this.langsManager);
            image.populate(imageData);
            this.images.push(image);
        }
        this.filtersIds = data['filtersIds'];
        this.relatedProductsIds = data['relatedProductsIds'];
        this.attachmentsIds = data['attachmentsIds'];
    }

    getData():any {
        var imagesData: Object[] = [];
        for(let image of this.images) {
            imagesData.push(image.getData());
        }
        var attributesData: Object[] = [];
        for(let attribute of this.attributes) {
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
    }

    public loadRelatedProducts(query: string): Promise<Product[]> {
        return new Promise<Product[]>((resolve) => {
            var url = 'catalog/related-products/' + query;
            if(this.product) {
                url += '?id=' + this.product.id;
            }
            this.backend.get(url)
                .then((resp: Response) => {
                    // Оставляем только уже добавленные товары
                    var relProducts = this.relatedProducts;
                    this.relatedProducts = [];

                    for(let relProduct of relProducts) {
                        if(this.relatedProductsIds.indexOf(relProduct.id) >= 0) {
                            this.relatedProducts.push(relProduct);
                        }
                    }

                    for(let prodData of resp.json()) {
                        var product = new Product(prodData['id']);
                        product.name = prodData['name'];
                        var addProduct = this.relatedProductsIds.indexOf(product.id) === -1;
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
        return ProductI18Form;
    }

}