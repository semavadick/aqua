import { Component, Type, OnInit, ViewChild } from '@angular/core';
import {CategoriesComponent} from "../categories/categories.component";
import {AdditionCategoriesComponent} from "../addition-categories/addition-categories.component";
import {ProductsComponent} from "../products/products.component";
import {AdditionProductsComponent} from "../addition-products/addition-products.component";
import {Category} from "../categories/category";
import {AdditionCategory} from "../addition-categories/addition-category";

@Component({
    templateUrl: './store.html',
    directives: [
        <Type>CategoriesComponent,
        <Type>AdditionCategoriesComponent,
        <Type>ProductsComponent,
        <Type>AdditionProductsComponent,
    ]
})
export class StoreComponent {

    @ViewChild(<Type>ProductsComponent, undefined)
    public products: ProductsComponent;

    @ViewChild(<Type>AdditionProductsComponent, undefined)
    public additionProducts: AdditionProductsComponent;

    @ViewChild(<Type>AdditionCategoriesComponent, undefined)
    public additionCategories: AdditionCategoriesComponent;

    @ViewChild(<Type>CategoriesComponent, undefined)
    public categories: CategoriesComponent;

    public selectCategory(category: Category) {
        this.products.setCategory(category);
        this.additionProducts.clearProducts();
        this.additionCategories.clearCategories();
        $('addition-catalog-products').hide();
        $('catalog-products').show();

    }

    public selectAdditionCategory(category: AdditionCategory) {
        this.additionProducts.setCategory(category);
        this.categories.clearCategories();
        this.products.clearProducts();
        $('catalog-products').hide();
        $('addition-catalog-products').show();

    }
}
