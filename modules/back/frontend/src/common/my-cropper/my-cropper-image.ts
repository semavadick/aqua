import { EventEmitter } from '@angular/core';

export class MyCropperImage {

    public currentImageUrl: string = null;

    public croppedImage: string = null;

    private _uploadedImage: string = null;

    get uploadedImage():string {
        return this._uploadedImage;
    }

    set uploadedImage(value: string) {
        this._uploadedImage = value;
        if(value) {
            this.uploadedImageSet.emit(value);
        }
    }

    public reseted: EventEmitter<any> = new EventEmitter<any>();
    public uploadedImageSet: EventEmitter<string> = new EventEmitter<string>();

    public reset() {
        this.currentImageUrl = null;
        this.croppedImage = null;
        this._uploadedImage = null;
        this.reseted.emit(null);
    }

}