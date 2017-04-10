import { Component, Input, Output, EventEmitter, OnInit } from '@angular/core';

@Component({
    selector: 'my-thumb',
    template: `
        <div class="thumbnail" style="margin-bottom: 0;" [class.bg-grey-300]="grayBg">
            <div class="thumb">
                <img *ngIf="imageUrl" src="{{ imageUrl }}">

                <div *ngIf="content" [innerHTML]="content" class="caption"></div>

                <div class="caption-overflow">
                    <span>
                        <button (click)="onUpdate.emit(null)" title="Редактировать" type="button" class="btn bg-info-600 btn-icon">
                            <i class="icon-pen"></i>
                        </button>
                        <button (click)="deleteItem()" title="Удалить" type="button" class="btn bg-warning-700 btn-icon" style="margin-left: 10px;">
                            <i class="icon-trash"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
    `,
})
export class MyThumbComponent {

    @Input()
    public content: string;

    @Input()
    public imageUrl: string;

    @Input()
    public grayBg: boolean = false;

    @Input()
    public deleteMessage: string = "Вы действительно хотите удалить данный элемент?";

    @Output()
    public onUpdate: EventEmitter<any> = new EventEmitter<any>();

    @Output()
    public onDelete: EventEmitter<any> = new EventEmitter<any>();

    public deleteItem() {
        if(confirm(this.deleteMessage)) {
            this.onDelete.emit(null);
        }
    }
}
