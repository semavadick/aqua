import { Component, Type, OnInit } from '@angular/core';
import {Response} from '@angular/http';
import {RegistrationsComponent} from "./registrations/registrations.component";
import {HeaderComponent} from "../header/header.component";
import {BackendService} from "../../services/backend.service";
import {ArticlesComponent} from "./articles/articles.component";
import {WebUser} from "../../services/web-user";
import {NewsComponent} from "./news/news.component";
import {OrdersComponent} from "./orders/orders.component";
import {OrdersSumComponent} from "./orders-sum/orders-sum.component";

@Component({
    templateUrl: './dashboard.html',
    directives: [
        <Type>HeaderComponent,
        <Type>RegistrationsComponent,
        <Type>ArticlesComponent,
        <Type>NewsComponent,
        <Type>OrdersComponent,
        <Type>OrdersSumComponent,
    ]
})
export class DashboardComponent implements OnInit {

    public totalOrdersCount: number = 0;
    public preProcessingOrdersCount: number = 0;
    public processingOrdersCount: number = 0;
    public ordersWeeklySum: number = 0;
    public ordersMonthlySum: number = 0;
    public ordersTotalSum: number = 0;
    public users: Object[] = [];
    public articles: Object[] = [];
    public news: Object[] = [];

    public constructor(public wUser: WebUser, private backend: BackendService) { }

    public ngOnInit() {
        this.backend.get('dashboard')
            .then((resp: Response) => {
                Object.assign(this, resp.json());
            })
            .catch((resp: Response) => {
                alert(resp.text());
            });
    }

}
