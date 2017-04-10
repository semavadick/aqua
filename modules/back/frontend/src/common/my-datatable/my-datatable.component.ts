import { Component, Input, Output, Type, OnInit, ViewChild, EventEmitter } from '@angular/core';
import {MyDatatableColumn} from "./my-datatable-column";
import {MyDatatableEntity} from "./my-datatable-entity";
import {MyDatatableManager} from "./my-datatable-manager";
import {MyDatatablePagination} from "./my-datatable-pagination";
import {MyDatatableSort} from "./my-datatable-sort";
import {PanelSpinnerComponent} from "../panel-spinner/panel-spinner.component";
import {MyModalComponent} from "../my-modal/my-modal.component";
import {FormButtonComponent} from "../form-button/form-button.component";
import {MyDatatableEntityForm} from "./my-datatable-entity-form";
import {MyDatatableSearchForm} from "./my-datatable-search-form";

@Component({
    selector: 'my-datatable',
    templateUrl: './my-datatable.html',
    directives: [
        <Type>PanelSpinnerComponent,
        <Type>MyModalComponent,
        <Type>FormButtonComponent,
    ],
})
export class MyDatatableComponent implements OnInit {

    @Input()
    public columns: MyDatatableColumn[] = [];

    @Input()
    public defaultSortAttribute: string = '';

    @Input()
    public manager: MyDatatableManager;

    @Input()
    public searchForm: MyDatatableSearchForm;


    @Input()
    public entityForm: MyDatatableEntityForm;

    @Output()
    public formInitialize: EventEmitter<any> = new EventEmitter<any>();

    @Input()
    public title: string = "";

    @Input()
    public createDisabled: boolean = false;

    @Input()
    public createButtonText: string = "";

    @Input()
    public deleteMessage: string = "Уверены, что хотите удалить данный элемент?";

    @Input()
    public createFormTitle: string;

    @Input()
    public updateFormTitle: string;

    public pagination: MyDatatablePagination = new MyDatatablePagination();

    public sort: MyDatatableSort = new MyDatatableSort();

    @ViewChild(<Type>MyModalComponent, undefined)
    private modal: MyModalComponent;

    ngOnInit():any {
        this.manager.setPagination(this.pagination);
        this.manager.setSort(this.sort);
        if(this.defaultSortAttribute) {
            this.sort.attribute = this.defaultSortAttribute;
        }
        if(this.searchForm) {
            this.manager.setSearchForm(this.searchForm);
        }
        this.manager.loadEntities();
    }

    public createEntity() {
        this.openModal();
    }

    public updateEntity(entity: MyDatatableEntity) {
        this.openModal(entity);
    }

    private openModal(entity: MyDatatableEntity = null) {
        var title = !entity ? this.createFormTitle : this.updateFormTitle;
        this.modal.setTitle(title);
        this.modal.open();
        this.entityForm.init(entity)
            .then((message: string) => {
                this.formInitialize.emit(null);
            })
            .catch((message: string) => {
                alert(message);
            })
    }

    public save() {
        this.entityForm.save()
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

    public deleteEntity(entity: MyDatatableEntity) {
        if(confirm(this.deleteMessage)) {
            this.manager.deleteEntity(entity);
        }
    }

    public goToPage(pageNumber: number) {
        this.pagination.currentPage = pageNumber;
        this.manager.loadEntities();
    }

    public goToPrevPage() {
        if(this.pagination.isOnFirstPage()) {
            return;
        }
        this.pagination.currentPage--;
        this.manager.loadEntities();
    }

    public goToNextPage() {
        if(this.pagination.isOnLastPage()) {
            return;
        }
        this.pagination.currentPage++;
        this.manager.loadEntities();
    }

    public sortByColumn(column: MyDatatableColumn) {
        if(!column.enableSorting) {
            return;
        }
        this.sort.sortBy(column);
        this.manager.loadEntities();
    }

    public search() {
        this.manager.loadEntities();
    }
}
