import { Component, Type, OnInit, ViewChild, Output, EventEmitter } from '@angular/core';
import {PanelSpinnerComponent} from "../../../common/panel-spinner/panel-spinner.component";
import {CategoriesManager} from "./categories-manager";
import {Category} from "./category";
import {CategoriesTreeComponent} from "./categories-tree/categories-tree.component";
import {MyModalComponent} from "../../../common/my-modal/my-modal.component";
import {I18nTabsComponent} from "../../../common/i18n-tabs/i18n-tabs.component";
import {I18nCheckbox} from "../../../common/i18n-checkbox/i18n-checkbox.component";
import {FormGroupComponent} from "../../../common/form-group/form-group.component";
import {FormButtonComponent} from "../../../common/form-button/form-button.component";
import {CategoryDetailsComponent} from "./category-details/category-details.component";

@Component({
    selector: 'catalog-categories',
    templateUrl: './categories.html',
    directives: [
        <Type>PanelSpinnerComponent,
        <Type>CategoriesTreeComponent,
        <Type>CategoryDetailsComponent,
    ],
    providers: [
        CategoriesManager,
    ]
})
export class CategoriesComponent implements OnInit {

    @Output()
    public onSelect: EventEmitter<Category> = new EventEmitter<Category>();

    @ViewChild(<Type>CategoriesTreeComponent, undefined)
    private tree: CategoriesTreeComponent;

    @ViewChild(<Type>CategoryDetailsComponent, undefined)
    private categoryDetails: CategoryDetailsComponent;

    private selectedCategory: Category = null;

    public constructor(public manager: CategoriesManager) { }

    public ngOnInit() {
        this.updateCategories();
    }

    private updateCategories() {
        this.manager.loadCategories()
            .then(() => {
                var selected: Array<Category> = [];
                if(this.selectedCategory) {
                    selected.push(this.selectedCategory);
                }
                this.tree.load(this.manager.categories, selected);
            })
            .catch((message: string) => {
                if(message) {
                    alert(message);
                }
            });
    }

    public sortCategories($event: {parent: Category, categories: Category[]}) {
        this.manager.sortCategories($event.categories, $event.parent)
    }

    public selectCategories(categories: Category[]) {
        var category = (categories != undefined && categories.length) ? categories[0] : null;
        this.selectedCategory = category;
        this.onSelect.emit(category);
    }

    public createCategory(parent: Category = null) {
        this.categoryDetails.createCategory(parent, this.manager.categories);
    }

    public updateCategory(category: Category) {
        this.categoryDetails.updateCategory(category, this.manager.categories);
    }

    public deleteCategory(category: Category) {
        this.manager.deleteCategory(category)
            .then(() => {
                this.updateCategories();
            })
            .catch((message: string) => {
                if(message) {
                    alert(message);
                }
            });
    }

    public clearCategories(){
        this.tree.selectedCategories = [];
        this.tree.tree.select_all();
    }
}