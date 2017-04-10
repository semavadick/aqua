import { Component, Type, OnInit, ViewChild, Output, EventEmitter } from '@angular/core';
import {PanelSpinnerComponent} from "../../../common/panel-spinner/panel-spinner.component";
import {AdditionCategoriesManager} from "./addition-categories-manager";
import {AdditionCategory} from "./addition-category";
import {AdditionCategoriesTreeComponent} from "./addition-categories-tree/addition-categories-tree.component";
import {MyModalComponent} from "../../../common/my-modal/my-modal.component";
import {I18nTabsComponent} from "../../../common/i18n-tabs/i18n-tabs.component";
import {I18nCheckbox} from "../../../common/i18n-checkbox/i18n-checkbox.component";
import {FormGroupComponent} from "../../../common/form-group/form-group.component";
import {FormButtonComponent} from "../../../common/form-button/form-button.component";
import {AdditionCategoryDetailsComponent} from "./addition-category-details/addition-category-details.component";

@Component({
    selector: 'addition-catalog-categories',
    templateUrl: './addition-categories.html',
    directives: [
        <Type>PanelSpinnerComponent,
        <Type>AdditionCategoriesTreeComponent,
        <Type>AdditionCategoryDetailsComponent,
    ],
    providers: [
        AdditionCategoriesManager,
    ]
})
export class AdditionCategoriesComponent implements OnInit {

    @Output()
    public onSelect: EventEmitter<AdditionCategory> = new EventEmitter<AdditionCategory>();

    @ViewChild(<Type>AdditionCategoriesTreeComponent, undefined)
    private tree: AdditionCategoriesTreeComponent;

    @ViewChild(<Type>AdditionCategoryDetailsComponent, undefined)
    private categoryDetails: AdditionCategoryDetailsComponent;

    @ViewChild(<Type>AdditionCategory, undefined)
    private selectedCategory: AdditionCategory = null;

    public constructor(public manager: AdditionCategoriesManager) {
    }

    public ngOnInit() {
        this.updateCategories();
    }

    private updateCategories() {
        this.manager.loadCategories()
            .then(() => {
                var selected: Array<AdditionCategory> = [];
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

    public sortCategories($event: {parent: AdditionCategory, categories: AdditionCategory[]}) {
        this.manager.sortCategories($event.categories, $event.parent)
    }

    public selectCategories(categories: AdditionCategory[]) {
        var category = categories.length ? categories[0] : null;
        this.selectedCategory = category;
        this.onSelect.emit(category);
    }

    public createCategory(parent: AdditionCategory = null) {
        this.categoryDetails.createCategory(parent, this.manager.categories);
    }

    public updateCategory(category: AdditionCategory) {
        this.categoryDetails.updateCategory(category, this.manager.categories);
    }

    public deleteCategory(category: AdditionCategory) {
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

    public clearCategories() {
        this.tree.selectedCategories = [];
        this.tree.tree.select_all();
    }
}