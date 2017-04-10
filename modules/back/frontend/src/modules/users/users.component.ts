import { Component, Type, OnInit, ViewChild } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { HeaderComponent } from "../header/header.component";
import {MyDatatableColumn} from "../../common/my-datatable/my-datatable-column";
import {MyDatatableComponent} from "../../common/my-datatable/my-datatable.component";
import {User} from "./user";
import {UsersManager} from "./users-manager";
import {UserForm} from "./user-form/user-form";
import {SearchForm} from "./search-form/search-form";
import {FormGroupComponent} from "../../common/form-group/form-group.component";
import {UserFormComponent} from "./user-form/user-form.component";
import {SearchFormComponent} from "./search-form/search-form.component";

@Component({
    templateUrl: './users.html',
    directives: [
        <Type>HeaderComponent,
        <Type>MyDatatableComponent,
        <Type>FormGroupComponent,
        <Type>SearchFormComponent,
        <Type>UserFormComponent,
    ],
    providers: [UsersManager, UserForm, SearchForm],
})
export class UsersComponent implements OnInit {

    public columns: MyDatatableColumn[] = [];

    @ViewChild(<Type>UserFormComponent, undefined)
    public userFormComponent: UserFormComponent;

    public constructor(public userForm: UserForm, public searchForm: SearchForm, public manager: UsersManager, private route: ActivatedRoute) {
        var idColumn = new MyDatatableColumn();
        idColumn.header = 'ID';
        idColumn.attribute = 'id';
        this.columns.push(idColumn);

        var nameColumn = new MyDatatableColumn();
        nameColumn.header = 'Телефон';
        nameColumn.attribute = 'phone';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);

        var nameColumn = new MyDatatableColumn();
        nameColumn.header = 'E-mail';
        nameColumn.attribute = 'email';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);

        var nameColumn = new MyDatatableColumn();
        nameColumn.header = 'Имя и фамилия';
        nameColumn.attribute = 'fullName';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);

        var nameColumn = new MyDatatableColumn();
        nameColumn.header = 'Тип';
        nameColumn.attribute = 'type';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);

        var nameColumn = new MyDatatableColumn();
        nameColumn.header = 'Кол-во заказов';
        nameColumn.attribute = 'ordersCount';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);

        var nameColumn = new MyDatatableColumn();
        nameColumn.header = 'Реквизиты компании';
        nameColumn.attribute = 'companyInfoFileUrl';
        nameColumn.enableSorting = false;
        nameColumn.rawContent = true;
        this.columns.push(nameColumn);
    }

    ngOnInit() {
        this.route
            .params
            .subscribe(params => {
                var userId: number = params['id'] - 0;
                if(userId) {
                    this.searchForm.id = userId;
                }
            });
    }


}
