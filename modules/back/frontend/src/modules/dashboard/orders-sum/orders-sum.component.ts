import { Component, Input } from '@angular/core';

@Component({
    selector: 'dashboard-orders-sum',
    templateUrl: './orders-sum.html',
})
export class OrdersSumComponent {

    @Input()
    public ordersWeeklySum: number = 0;

    @Input()
    public ordersMonthlySum: number = 0;

    @Input()
    public ordersTotalSum: number = 0;

}
