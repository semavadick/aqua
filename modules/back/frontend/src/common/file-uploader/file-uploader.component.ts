import { Component, Input, Type, ElementRef, ViewEncapsulation } from '@angular/core';
import { FileUploaderModel } from "./file-uploader-model";
declare var Cropper: any;

@Component({
    selector: 'file-uploader',
    templateUrl: './file-uploader.html',
    encapsulation: ViewEncapsulation.None
})
export class FileUploaderComponent {

    @Input()
    public deleteAllowed: boolean = false;

    @Input()
    public file: FileUploaderModel;

    constructor(private eRef: ElementRef) { }

    public deleteFile() {
        this.file.reset();
        this.file.isDeleted = true;
    }

    public chooseFile($event: any) {
        $event.target.parentElement.querySelector('input[type=file]').click();
    }

    public fileChangeListener($event: any) {
        var file: File = $event.target.files[0];
        $event.target.value = '';
        if(!file) {
            return;
        }
        var myReader: FileReader = new FileReader();
        myReader.onloadend = (loadEvent: any) => {
            var dataUrl: string = loadEvent.target.result;
            this.file.uploadedFileUrl = dataUrl;
            this.file.uploadedFileName = file.name;
        };
        myReader.readAsDataURL(file);
    }

}
