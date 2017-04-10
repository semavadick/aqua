import { Component, Type, OnInit, ViewChild, ElementRef  } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { HeaderComponent } from "../header/header.component";
import {Article} from "./article";
import {MyDatatableColumn} from "../../common/my-datatable/my-datatable-column";
import {MyDatatableComponent} from "../../common/my-datatable/my-datatable.component";
import {ArticlesManager} from "./articles-manager";
import {MyWysiwygComponent} from "../../common/my-wysiwyg/my-wysiwyg.component";
import {MyCropperComponent} from "../../common/my-cropper/my-cropper.component";
import {ArticleForm} from "./article-form";
import {FormGroupComponent} from "../../common/form-group/form-group.component";
import {I18nTabsComponent} from "../../common/i18n-tabs/i18n-tabs.component";
import {I18nCheckbox} from "../../common/i18n-checkbox/i18n-checkbox.component";
import {MyDatePicker} from "../../common/my-datepicker/my-datepicker.component";
import {MyCheckbox} from "../../common/my-checkbox/my-checkbox.component";
import {PublicationGalleriesComponent} from "../publications/publication-galleries.component";
import {PublicationsSearchForm} from "../publications/publications-search-form";
import {Category} from "../catalog/categories/category";
import {CategoriesTreeComponent} from "../catalog/categories/categories-tree/categories-tree.component";
import {CategoriesManager} from "../catalog/categories/categories-manager";

@Component({
    templateUrl: './articles.html',
    directives: [
        <Type>HeaderComponent, <Type>MyDatatableComponent,
        <Type>MyWysiwygComponent, <Type>MyCropperComponent,
        <Type>FormGroupComponent, <Type>I18nTabsComponent,
        <Type>I18nCheckbox, <Type>PublicationGalleriesComponent,
        <Type>CategoriesTreeComponent,<Type>MyDatePicker, <Type>MyCheckbox
    ],
    providers: [ArticlesManager, ArticleForm, PublicationsSearchForm ,CategoriesManager],
})
export class ArticlesComponent implements OnInit {

    public columns: MyDatatableColumn[] = [];

    @ViewChild(<Type>I18nTabsComponent, undefined)
    private i18ns: I18nTabsComponent;

    @ViewChild(<Type>CategoriesTreeComponent, undefined)
    private categoriesTree: CategoriesTreeComponent;

    public constructor(public form: ArticleForm, public searchForm: PublicationsSearchForm, public manager: ArticlesManager, private route: ActivatedRoute, private categoriesManger: CategoriesManager, private eRef: ElementRef) {
        var idColumn = new MyDatatableColumn();
        idColumn.header = 'ID';
        idColumn.attribute = 'id';
        this.columns.push(idColumn);

        var nameColumn = new MyDatatableColumn();
        nameColumn.header = 'Название';
        nameColumn.attribute = 'name';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);

        var nameColumn = new MyDatatableColumn();
        nameColumn.header = 'Добавлена';
        nameColumn.attribute = 'added';
        this.columns.push(nameColumn);
    }

    public formInitialized(data: any) {
        this.i18ns.init(this.form);
        this.categoriesManger.loadCategories().then(() => {
            this.categoriesTree.load(this.categoriesManger.categories, this.form.getCategories());
        });
    }

    ngOnInit() {
        this.route
            .params
            .subscribe(params => {
                var articleId: number = params['id'] - 0;
                if(articleId) {
                    this.searchForm.id = articleId;
                }
            });
    }

    public selectCategories(categories: Category[]) {
        this.form.setCategories(categories);
    }

    public changeAddedDate(event) {
        this.form.addedDate = event.value;
    }
}
