import {Form} from "../../../common/form";
import {PoolsBuildingStaticGalleryImageForm} from "./pools-building-static-gallery-image-form";
import {LanguagesManager} from "../../../services/languages-manager";

export class PoolsBuildingStaticGalleryForm extends Form {

    public id: number = null;
    public images: PoolsBuildingStaticGalleryImageForm[] = [];

    public constructor(private langsManager: LanguagesManager) {
        super();
    }

    reset():any {
        this.id = null;
        for(let image of this.images) {
            image.reset();
        }
    }

    populate(data:any):any {
        this.id = data['id'];
        for(let imageData of data['images']) {
            var image = new PoolsBuildingStaticGalleryImageForm(this.langsManager);
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
            id: this.id,
            images: imagesData,
        };
    }
}