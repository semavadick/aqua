import { Component, Type, OnInit, ViewChild } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { HeaderComponent } from "../header/header.component";
import {NewsItem} from "./news-item";
import {MyDatatableColumn} from "../../common/my-datatable/my-datatable-column";
import {MyDatatableComponent} from "../../common/my-datatable/my-datatable.component";
import {NewsManager} from "./news-manager";
import {MyWysiwygComponent} from "../../common/my-wysiwyg/my-wysiwyg.component";
import {MyCropperComponent} from "../../common/my-cropper/my-cropper.component";
import {NewsForm} from "./news-form";
import {FormGroupComponent} from "../../common/form-group/form-group.component";
import {I18nTabsComponent} from "../../common/i18n-tabs/i18n-tabs.component";
import {I18nCheckbox} from "../../common/i18n-checkbox/i18n-checkbox.component";
import {MyDatePicker} from "../../common/my-datepicker/my-datepicker.component";
import {MyCheckbox} from "../../common/my-checkbox/my-checkbox.component";
import {PublicationGalleriesComponent} from "../publications/publication-galleries.component";
import {PublicationsSearchForm} from "../publications/publications-search-form";

@Component({
    templateUrl: './news.html',
    directives: [
        <Type>HeaderComponent, <Type>MyDatatableComponent,
        <Type>MyWysiwygComponent, <Type>MyCropperComponent,
        <Type>FormGroupComponent, <Type>I18nTabsComponent,
        <Type>I18nCheckbox, <Type>PublicationGalleriesComponent,
        <Type>MyDatePicker, <Type>MyCheckbox
    ],
    providers: [NewsManager, NewsForm, PublicationsSearchForm],
})
export class NewsComponent implements OnInit {

    public columns: MyDatatableColumn[] = [];

    @ViewChild(<Type>I18nTabsComponent, undefined)
    private i18ns: I18nTabsComponent;

    public constructor(public form: NewsForm, public searchForm: PublicationsSearchForm, public manager: NewsManager, private route: ActivatedRoute) {
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
    }

    ngOnInit() {
        this.route
            .params
            .subscribe(params => {
                var newsId: number = params['id'] - 0;
                if(newsId) {
                    this.searchForm.id = newsId;
                }
            });
    }

    public changeAddedDate(event) {
        this.form.addedDate = event.value;
    }

}
