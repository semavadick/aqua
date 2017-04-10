import { Component, Input,  } from '@angular/core';
import { Router } from '@angular/router';

@Component({
    selector: 'dashboard-orders',
    templateUrl: './orders.html',
})
export class OrdersComponent {

    @Input()
    public totalOrdersCount: number = 0;

    @Input()
    public preProcessingOrdersCount: number = 0;

    @Input()
    public processingOrdersCount: number = 0;

    public constructor(private router: Router) { }

    public goToOrders() {
        this.router.navigate(['/modules/orders'])
    }

    public goToPreProcessingOrders() {
        this.router.navigate(['/modules/orders', {status: 0}])
    }

    public goToProcessingOrders() {
        this.router.navigate(['/modules/orders', {status: 1}])
    }

}
