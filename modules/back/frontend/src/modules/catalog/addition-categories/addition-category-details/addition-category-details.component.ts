import { Component, Type, OnInit, ViewChild, Output, EventEmitter } from '@angular/core';
import {PanelSpinnerComponent} from "../../../../common/panel-spinner/panel-spinner.component";
import {AdditionCategory} from "../addition-category";
import {AdditionCategoriesTreeComponent} from "../addition-categories-tree/addition-categories-tree.component";
import {MyModalComponent} from "../../../../common/my-modal/my-modal.component";
import {I18nTabsComponent} from "../../../../common/i18n-tabs/i18n-tabs.component";
import {AdditionCategoryForm} from "./addition-category-form";
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
    selector: 'addition-category-details',
    templateUrl: './addition-category-details.html',
    directives: [
        <Type>AdditionCategoriesTreeComponent,
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
        AdditionCategoryForm,
    ]
})
export class AdditionCategoryDetailsComponent {

    @Output()
    public onSave: EventEmitter<any> = new EventEmitter<any>();

    @ViewChild(<Type>AdditionCategoriesTreeComponent, undefined)
    private tree: AdditionCategoriesTreeComponent;

    @ViewChild(<Type>MyModalComponent, undefined)
    private modal: MyModalComponent;

    @ViewChild(<Type>I18nTabsComponent, undefined)
    private i18ns: I18nTabsComponent;

    public constructor(public form: AdditionCategoryForm, private langsManager: LanguagesManager) { }

    public selectCategories(categories: AddittionCategory[]) {
        this.form.setRelatedCategories(categories);
    }

    public createCategory(parent: AdditionCategory = null, treeCategories: AdditionCategory[]) {
        this.modal.setTitle('Добавление подкатегории');
        this.openModal(null, treeCategories, parent);

    }

    public updateCategory(category: AdditionCategory, treeCategories: AdditionCategory[]) {
        this.modal.setTitle('Редактирование категории');
        this.openModal(category, treeCategories, null);
    }

    private openModal(category: AdditionCategory = null, treeCategories: AdditionCategory[], parent: AdditionCategory = null) {
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