import { Component, Type, OnInit, ViewChild } from '@angular/core';
import { HeaderComponent } from "../header/header.component";
import {MyDatatableColumn} from "../../common/my-datatable/my-datatable-column";
import {MyDatatableComponent} from "../../common/my-datatable/my-datatable.component";
import {GalleriesManager} from "./galleries-manager";
import {MyWysiwygComponent} from "../../common/my-wysiwyg/my-wysiwyg.component";
import {MyCropperComponent} from "../../common/my-cropper/my-cropper.component";
import {GalleryForm} from "./gallery-form";
import {FormGroupComponent} from "../../common/form-group/form-group.component";
import {I18nTabsComponent} from "../../common/i18n-tabs/i18n-tabs.component";
import {I18nCheckbox} from "../../common/i18n-checkbox/i18n-checkbox.component";
import {PublicationGalleriesComponent} from "../publications/publication-galleries.component";
import {MyCheckbox} from "../../common/my-checkbox/my-checkbox.component";
import {GalleryImagesComponent} from "./gallery-images.component";
import {MultiSelect} from "../../common/multi-select/multi-select.component";

@Component({
    templateUrl: './object-galleries.html',
    directives: [
        <Type>HeaderComponent, <Type>MyDatatableComponent,
        <Type>MyWysiwygComponent, <Type>MyCropperComponent,
        <Type>FormGroupComponent, <Type>I18nTabsComponent,
        <Type>I18nCheckbox, <Type>MyCheckbox, <Type>GalleryImagesComponent,
        <Type>MultiSelect,
    ],
    providers: [GalleriesManager, GalleryForm],
})
export class ObjectGalleriesComponent {

    @ViewChild(<Type>I18nTabsComponent, undefined)
    public i18ns: I18nTabsComponent;

    public columns: MyDatatableColumn[] = [];

    public constructor(public form: GalleryForm, public manager: GalleriesManager) {
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
        nameColumn.header = 'Кол-во фотографий';
        nameColumn.attribute = 'imagesCount';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);
    }

}
