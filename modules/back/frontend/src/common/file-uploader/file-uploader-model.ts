import { EventEmitter } from '@angular/core';

export class FileUploaderModel {

    public currentFileUrl: string = null;

    public uploadedFileUrl: string = null;
    public uploadedFileName: string = null;
    public isDeleted: boolean = false;

    public onReset: EventEmitter<any> = new EventEmitter<any>();

    public reset() {
        this.currentFileUrl = null;
        this.uploadedFileUrl = null;
        this.uploadedFileName = null;
        this.isDeleted = false;
        this.onReset.emit(null);
    }

    public getName(): string {
        if(this.uploadedFileName) {
            return this.uploadedFileName;
        }
        return this.currentFileUrl;
    }

}