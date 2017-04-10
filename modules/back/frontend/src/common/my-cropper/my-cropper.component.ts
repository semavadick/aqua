import { Component, Input, Type, ViewChild, OnInit, ElementRef, ViewEncapsulation } from '@angular/core';
import { MyCropperImage } from "./my-cropper-image";
declare var Cropper: any;

@Component({
    selector: 'my-cropper',
    templateUrl: './my-cropper.html',
    encapsulation: ViewEncapsulation.None
})
export class MyCropperComponent implements OnInit {

    public showCropper: boolean = false;

    @Input()
    public image: MyCropperImage;

    @Input()
    public aspectRatio: number = null;

    @Input()
    public grayBg: boolean = false;

    @Input()
    public disableCrop: boolean = false;

    private cropper: any;

    constructor(private eRef: ElementRef) { }

    public ngOnInit() {
        this.image.reseted.subscribe(() => {
            this.showCropper = false;
        });
        this.image.uploadedImageSet.subscribe((dataUrl: string) => {
            this.format = this.getImageFormat(dataUrl);

            if(this.disableCrop) {
                this.image.croppedImage = this.image.uploadedImage;
                this.image.currentImageUrl = this.image.croppedImage;
                return;
            }

            this.showCropper = true;
            setTimeout(() => {
                if(!this.cropper) {
                    this.initCropper(dataUrl);

                } else {
                    this.cropper.replace(dataUrl);
                }
            }, 100);
        });
    }

    public chooseFile($event: any) {
        $event.target.parentElement.querySelector('.image-cropper__file').click();
    }

    private initCropper(imageSrc: string) {
        var image: HTMLImageElement = this.eRef.nativeElement.querySelector('.cropper-cont img');
        image.onload = () => {
            if(this.cropper) {
                return;
            }
            var onCrop = () => {
                this.image.croppedImage = this.cropper.getCroppedCanvas().toDataURL('image/' + this.format);
            };
            this.cropper = new Cropper(image, {
                aspectRatio: this.aspectRatio ? this.aspectRatio : NaN,
                viewMode: 1,
                zoomable: false,
                built: onCrop,
                cropend: onCrop,
                autoCropArea: 1,
            });
        };
        image.setAttribute('src', imageSrc);
    }

    private format = 'jpeg';

    public fileChangeListener($event: any) {
        var file: File = $event.target.files[0];
        $event.target.value = '';
        if(!file) {
            return;
        }
        var myReader: FileReader = new FileReader();
        myReader.onloadend = (loadEvent: any) => {
            this.image.uploadedImage = loadEvent.target.result;
        };
        myReader.readAsDataURL(file);
    }

    private getImageFormat(dataUrl: string): string {
        var start = dataUrl.indexOf('/') + 1;
        var length = dataUrl.indexOf(';') - start;
        var format = dataUrl.substr(start, length);
        if(!format.length) {
            return 'jpeg';
        }
        return format;
    }

}
