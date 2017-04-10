import { Component, Type, OnInit, ViewChild } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { HeaderComponent } from "../header/header.component";
import {MyDatatableColumn} from "../../common/my-datatable/my-datatable-column";
import {MyDatatableComponent} from "../../common/my-datatable/my-datatable.component";
import {Order} from "./order";
import {OrdersManager} from "./orders-manager";
import {OrderForm} from "./order-form/order-form";
import {SearchForm} from "./search-form/search-form";
import {FormGroupComponent} from "../../common/form-group/form-group.component";
import {OrderFormComponent} from "./order-form/order-form.component";
import {SearchFormComponent} from "./search-form/search-form.component";

@Component({
    templateUrl: './orders.html',
    directives: [
        <Type>HeaderComponent,
        <Type>MyDatatableComponent,
        <Type>FormGroupComponent,
        <Type>SearchFormComponent,
        <Type>OrderFormComponent,
    ],
    providers: [OrdersManager, OrderForm, SearchForm],
})
export class OrdersComponent implements OnInit {

    public columns: MyDatatableColumn[] = [];

    @ViewChild(<Type>OrderFormComponent, undefined)
    public orderFormComponent: OrderFormComponent;

    public constructor(public orderForm: OrderForm, public searchForm: SearchForm, public manager: OrdersManager, private route: ActivatedRoute) {
        var idColumn = new MyDatatableColumn();
        idColumn.header = 'ID';
        idColumn.attribute = 'id';
        this.columns.push(idColumn);

        var nameColumn = new MyDatatableColumn();
        nameColumn.header = 'Клеиент';
        nameColumn.attribute = 'client';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);

        var nameColumn = new MyDatatableColumn();
        nameColumn.header = 'Сумма';
        nameColumn.attribute = 'totalCost';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);

        var nameColumn = new MyDatatableColumn();
        nameColumn.header = 'Статус';
        nameColumn.attribute = 'statusLabel';
        nameColumn.enableSorting = false;
        this.columns.push(nameColumn);

        var nameColumn = new MyDatatableColumn();
        nameColumn.header = 'Дата';
        nameColumn.attribute = 'added';
        this.columns.push(nameColumn);
    }

    ngOnInit() {
        this.route
            .params
            .subscribe(params => {
                var status: number = params['status'];
                if(status !== undefined) {
                    this.searchForm.status = status;
                }
            });
    }

}
