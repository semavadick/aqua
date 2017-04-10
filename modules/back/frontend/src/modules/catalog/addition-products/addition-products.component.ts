import { Component, Type, ViewChild } from '@angular/core';
import {AdditionSearchFormComponent} from "./addition-search-form/addition-search-form.component";
import {MyDatatableComponent} from "../../../common/my-datatable/my-datatable.component";
import {AdditionSearchForm} from "./addition-search-form/addition-search-form";
import {AdditionProductsManager} from "./addition-products-manager";
import {AdditionProductForm} from "./addition-product-form/addition-product-form";
import {AdditionCategory} from "../addition-categories/addition-category";
import {AdditionProductFormComponent} from "./addition-product-form/addition-product-form.component";
import {MyDatatableColumn} from "../../../common/my-datatable/my-datatable-column";

@Component({
    selector: 'addition-catalog-products',
    templateUrl: './addition-products.html',
    directives: [
        <Type>MyDatatableComponent,
        <Type>AdditionSearchFormComponent,
        <Type>AdditionProductFormComponent,
    ],
    providers: [
        AdditionProductForm, AdditionSearchForm, AdditionProductsManager,
    ]
})
export class AdditionProductsComponent {

    @ViewChild(<Type>AdditionProductFormComponent, undefined)
    public productDetails: AdditionProductFormComponent;

    public columns: MyDatatableColumn[] = [];

    public constructor(public manager: AdditionProductsManager, public productForm: AdditionProductForm, public searchForm: AdditionSearchForm) {
        var idColumn = new MyDatatableColumn();
        idColumn.header = '#';
        idColumn.attribute = 'sort';
        this.columns.push(idColumn);

        var nameColumn = new MyDatatableColumn();
        nameColumn.header = 'SKU';
        nameColumn.attribute = 'sku';
        this.columns.push(nameColumn);

        var nameColumn = new MyDatatableColumn();
        nameColumn.header = 'Название';
        nameColumn.attribute = 'name';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);

        var nameColumn = new MyDatatableColumn();
        nameColumn.header = 'Цена';
        nameColumn.attribute = 'price';
        this.columns.push(nameColumn);
    }

    private category: AdditionCategory = null;

    public setCategory(category: AdditionCategory) {
        this.category = category;
        this.searchForm.setCategory(category);
        this.productForm.setCategory(category);
        this.manager.loadEntities();
    }

    public formInitialized() {
        this.productDetails.initI18ns();
    }

    public clearProducts() {
        this.manager.entities = [];
    }

}