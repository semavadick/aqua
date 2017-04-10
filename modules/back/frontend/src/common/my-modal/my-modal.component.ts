import { Component, Input, Type, ViewChild, OnInit } from '@angular/core';

@Component({
    selector: 'my-modal',
    templateUrl: './my-modal.html'
})
export class MyModalComponent {

    public opened: boolean = false;
    public title: string = '';

    public open() {
        this.opened = true;
    }

    public close() {
        this.opened = false;
    }

    public setTitle(title: string) {
        this.title = title;
    }

}
