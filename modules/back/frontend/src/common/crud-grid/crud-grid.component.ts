import { Component, Input, Output, Type, OnInit, ViewChild, EventEmitter } from '@angular/core';
import { PanelSpinnerComponent } from "../panel-spinner/panel-spinner.component";
import { MyGridComponent } from "../my-grid/my-grid.component";
import { MyThumbComponent } from "../my-thumb/my-thumb.component";
import { CrudGridEntity } from "./crud-grid-entity";
import { CrudGridEntityManager } from "./crud-grid-entity-manager";
import { MyModalComponent } from "../my-modal/my-modal.component";
import { CrudGridEntityForm } from "./crud-grid-entity-form";
import { I18nTabsComponent } from "../i18n-tabs/i18n-tabs.component";
import {FormButtonComponent} from "../form-button/form-button.component";

@Component({
    selector: 'crud-grid',
    templateUrl: './crud-grid.html',
    directives: [
        <Type>PanelSpinnerComponent,
        <Type>MyGridComponent,
        <Type>MyThumbComponent,
        <Type>MyModalComponent,
        <Type>FormButtonComponent,
    ],
})
export class CrudGridComponent implements OnInit {

    @Input()
    public manager: CrudGridEntityManager;

    @Input()
    public sortable: boolean = false;

    @Input()
    public form: CrudGridEntityForm;

    @Input()
    public i18nTabs: I18nTabsComponent = null;

    @Input()
    public title: string;

    @Input()
    public createButtonText: string;

    @Input()
    public deleteMessage: string;

    @Input()
    public createFormTitle: string;

    @Input()
    public updateFormTitle: string;

    @Input()
    public grayBg: boolean = false;

    @ViewChild(<Type>MyModalComponent, undefined)
    private modal: MyModalComponent;

    public ngOnInit() {
        this.manager.loadEntities();
    }

    public deleteEntity(entity: CrudGridEntity) {
        this.manager.deleteEntity(entity);
    }

    public createEntity() {
        this.openModal();
    }

    public updateEntity(entity: CrudGridEntity) {
        this.openModal(entity);
    }

    private openModal(entity: CrudGridEntity = null) {
        var title = !entity ? this.createFormTitle : this.updateFormTitle;
        this.modal.setTitle(title);
        this.modal.open();
        this.form.init(entity)
            .then((message: string) => {
                if(this.i18nTabs) {
                    this.i18nTabs.init(this.form);
                }
            })
            .catch((message: string) => {
                alert(message);
            })
    }

    public save() {
        this.form.save()
            .then(() => {
                this.modal.close();
                this.manager.loadEntities();
            })
            .catch((message: string) => {
                if(message) {
                    alert(message);
                }
            });
    }

}
