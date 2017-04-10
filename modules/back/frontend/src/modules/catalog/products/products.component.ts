import { Component, Type, ViewChild } from '@angular/core';
import {SearchFormComponent} from "./search-form/search-form.component";
import {MyDatatableComponent} from "../../../common/my-datatable/my-datatable.component";
import {SearchForm} from "./search-form/search-form";
import {ProductsManager} from "./products-manager";
import {ProductForm} from "./product-form/product-form";
import {Category} from "../categories/category";
import {ProductFormComponent} from "./product-form/product-form.component";
import {MyDatatableColumn} from "../../../common/my-datatable/my-datatable-column";

@Component({
    selector: 'catalog-products',
    templateUrl: './products.html',
    directives: [
        <Type>MyDatatableComponent,
        <Type>SearchFormComponent,
        <Type>ProductFormComponent,
    ],
    providers: [
        ProductForm, SearchForm, ProductsManager,
    ]
})
export class ProductsComponent {

    @ViewChild(<Type>ProductFormComponent, undefined)
    public productDetails: ProductFormComponent;

    public columns: MyDatatableColumn[] = [];

    public constructor(public manager: ProductsManager, public productForm: ProductForm, public searchForm: SearchForm) {
        var sortColumn = new MyDatatableColumn();
        sortColumn.header = '#';
        sortColumn.attribute = 'sort';
        this.columns.push(sortColumn);

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

    private category: Category = null;

    public setCategory(category: Category) {
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