import {MyCropperImage} from "../../../common/my-cropper/my-cropper-image";
import {Injectable} from '@angular/core';
import {CrudGridEntityForm} from "../../../common/crud-grid/crud-grid-entity-form";
import {BackendService} from "../../../services/backend.service";
import {LanguagesManager} from "../../../services/languages-manager";
import {OfficeI18nForm} from "./office-i18n-form";
import {I18nForm} from "../../../common/i18n-form";
import {Language} from "../../../services/language";
import {OfficesManager} from "./offices-manager";
import {CrudGridEntity} from "../../../common/crud-grid/crud-grid-entity";

@Injectable()
export class OfficeForm extends CrudGridEntityForm {

    public regionId: any = null;
    public phone = '';
    public coordsLat = 0.0;
    public coordsLng = 0.0;

    public constructor(private backend: BackendService, private langsManager: LanguagesManager, private officesManager: OfficesManager) {
        super();
    }

    public init(entity: CrudGridEntity = null): Promise<string> {
        return new Promise<string>((resolve, reject) => {
            super.init(entity)
                .then((message: string) => {
                    this.officesManager.loadRegions()
                        .then(() => {
                            if(!this.regionId) {
                                for(let region of this.officesManager.regions) {
                                    this.regionId = region.id;
                                    break;
                                }
                            }
                            resolve(message);
                        });
                })
                .catch((message: string) => {
                    reject(message);
                });
        });
    }

    protected getBackend():BackendService {
        return this.backend;
    }
    protected getBackendUrl(): string {
        return 'about-page/offices';
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    reset(): any {
        this.regionId = null;
        this.phone = '';
        this.coordsLat = 0;
        this.coordsLng = 0;
    }

    populate(data: any): any {
        this.regionId = data['regionId'];
        this.phone = data['phone'];
        this.coordsLat = data['coordsLat'];
        this.coordsLng = data['coordsLng'];
    }

    getData(): any {
        return {
            regionId: this.regionId,
            phone: this.phone,
            coordsLat: this.coordsLat,
            coordsLng: this.coordsLng,
        };
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm }  {
        return OfficeI18nForm;
    }

}