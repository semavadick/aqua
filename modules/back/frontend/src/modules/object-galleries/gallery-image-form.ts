import {MyCropperImage} from "../../common/my-cropper/my-cropper-image";
import {Form} from "../../common/form";

export class GalleryImageForm extends Form  {

    public id: number = null;
    public image: MyCropperImage = new MyCropperImage();
    public sort: number = null;

    reset(): any {
        this.id = null;
        this.image.reset();
        this.sort = null;
    }

    populate(data: any): any {
        this.id = data['id'];
        this.image.currentImageUrl = data['imageUrl'];
        this.sort = data['sort'];
    }

    getData(): any {
        return {
            id: this.id,
            image: this.image.croppedImage,
            sort: this.sort
        };
    }

    public getPreviewUrl() {
        var image = this.image;
        if(image.croppedImage) {
            return image.croppedImage;
        }
        if(image.uploadedImage) {
            return image.uploadedImage;
        }
        if(image.currentImageUrl) {
            return image.currentImageUrl;
        }
        return null;
    }
}