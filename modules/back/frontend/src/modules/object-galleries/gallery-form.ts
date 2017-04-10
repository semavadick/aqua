import {Injectable} from "@angular/core";
import {BackendService} from "../../services/backend.service";
import {LanguagesManager} from "../../services/languages-manager";
import {MyDatatableEntityForm} from "../../common/my-datatable/my-datatable-entity-form";
import {I18nForm} from "../../common/i18n-form";
import {Language} from "../../services/language";
import {GalleryI18nForm} from "./gallery-18n-form";
import {GalleryImageForm} from "./gallery-image-form";
import {CrudGridEntity} from "../../common/crud-grid/crud-grid-entity";
import {GalleriesManager} from "./galleries-manager";

@Injectable()
export class GalleryForm extends MyDatatableEntityForm  {

    public isTop: boolean = false;
    public isExclusive: boolean = false;
    public coordsLat: number = 0;
    public coordsLng: number = 0;
    public typeIds: number[] = [];

    public images: GalleryImageForm[] = [];

    public constructor(private backend: BackendService, private langsManager: LanguagesManager, private galleriesManager: GalleriesManager) {
        super();
    }

    public init(entity: CrudGridEntity = null): Promise<string> {
        return super.init(entity)
            .then((message: string) => {
                return this.galleriesManager.loadPoolTypes();
            });
    }

    protected getBackendUrl():string {
        return 'object-galleries';
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    reset():any {
        this.isTop = false;
        this.isExclusive = false;
        this.coordsLat = 0;
        this.coordsLng = 0;
        this.typeIds = [];
        this.images = [];
    }

    populate(data:any):any {
        this.isTop = data['isTop'];
        this.isExclusive = data['isExclusive'];
        this.coordsLat = data['coordsLat'];
        this.coordsLng = data['coordsLng'];
        this.typeIds = data['typeIds'];
        for(let imageData of data['images']) {
            var image = new GalleryImageForm();
            image.populate(imageData);
            this.images.push(image);
        }
    }

    getData():any {
        var imagesData: Object[] = [];
        for(let image of this.images) {
            imagesData.push(image.getData());
        }
        return {
            isTop: this.isTop,
            isExclusive: this.isExclusive,
            coordsLat: this.coordsLat,
            coordsLng: this.coordsLng,
            typeIds: this.typeIds,
            images: imagesData,
        };
    }

    protected getI18nFormClass():{new(language: Language): I18nForm} {
        return GalleryI18nForm;
    }

}