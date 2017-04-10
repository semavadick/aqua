import { Component, Type, OnInit, ViewChild, Output, EventEmitter } from '@angular/core';
import {PanelSpinnerComponent} from "../../../../common/panel-spinner/panel-spinner.component";
import {Category} from "../category";
import {CategoriesTreeComponent} from "../categories-tree/categories-tree.component";
import {MyModalComponent} from "../../../../common/my-modal/my-modal.component";
import {I18nTabsComponent} from "../../../../common/i18n-tabs/i18n-tabs.component";
import {CategoryForm} from "./category-form";
import {LanguagesManager} from "../../../../services/languages-manager";
import {FilterForm} from "./filter-form";
import {I18nCheckbox} from "../../../../common/i18n-checkbox/i18n-checkbox.component";
import {FormGroupComponent} from "../../../../common/form-group/form-group.component";
import {FormButtonComponent} from "../../../../common/form-button/form-button.component";
import {MyCropperComponent} from "../../../../common/my-cropper/my-cropper.component";
import {MyWysiwygComponent} from "../../../../common/my-wysiwyg/my-wysiwyg.component";
import {FilterComponent} from "./filter.component";
import {MyGridComponent} from "../../../../common/my-grid/my-grid.component";
import {MyCheckbox} from "../../../../common/my-checkbox/my-checkbox.component";

@Component({
    selector: 'category-details',
    templateUrl: './category-details.html',
    directives: [
        <Type>CategoriesTreeComponent,
        <Type>PanelSpinnerComponent,
        <Type>MyModalComponent,
        <Type>I18nTabsComponent,
        <Type>I18nCheckbox,
        <Type>FormGroupComponent,
        <Type>FormButtonComponent,
        <Type>MyCropperComponent,
        <Type>MyWysiwygComponent,
        <Type>FilterComponent,
        <Type>MyGridComponent,
        <Type>MyCheckbox,
    ],
    providers: [
        CategoryForm,
    ]
})
export class CategoryDetailsComponent {

    @Output()
    public onSave: EventEmitter<any> = new EventEmitter<any>();

    @ViewChild(<Type>CategoriesTreeComponent, undefined)
    private tree: CategoriesTreeComponent;

    @ViewChild(<Type>MyModalComponent, undefined)
    private modal: MyModalComponent;

    @ViewChild(<Type>I18nTabsComponent, undefined)
    private i18ns: I18nTabsComponent;

    public constructor(public form: CategoryForm, private langsManager: LanguagesManager) { }

    public selectCategories(categories: Category[]) {
        this.form.setRelatedCategories(categories);
    }

    public createCategory(parent: Category = null, treeCategories: Category[]) {
        this.modal.setTitle('Добавление подкатегории');
        this.openModal(null, treeCategories, parent);

    }

    public updateCategory(category: Category, treeCategories: Category[]) {
        this.modal.setTitle('Редактирование категории');
        this.openModal(category, treeCategories, null);
    }

    private openModal(category: Category = null, treeCategories: Category[], parent: Category = null) {
        this.modal.open();
        this.form.init(category, parent)
            .then(() => {
                this.i18ns.init(this.form);
                this.tree.load(treeCategories, this.form.getRelatedCategories());
            })
            .catch((message: string) => {
                if(message) {
                    alert(message);
                }
            });
    }

    public save() {
        this.form.save()
            .then(() => {
                this.modal.close();
                this.onSave.emit(null);
            })
            .catch((message: string) => {
                if(message) {
                    alert(message);
                }
            });
    }

    public addFilter() {
        this.form.filters.push(new FilterForm(this.langsManager));
    }

    public deleteFilter(filter: FilterForm) {
        var index = this.form.filters.indexOf(filter);
        this.form.filters.splice(index, 1);
    }

}