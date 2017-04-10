import {Injectable} from "@angular/core";
import {Response} from "@angular/http";
import {BackendService} from "../../../services/backend.service.ts";
import {LanguagesManager} from "../../../services/languages-manager";
import {Language} from "../../../services/language";
import {I18nForm} from "../../../common/i18n-form";
import {MyDatatableEntityForm} from "../../../common/my-datatable/my-datatable-entity-form";
import {MyDatatableEntity} from "../../../common/my-datatable/my-datatable-entity";
import {Order} from "../order";
import {OrderProduct} from "../order-product";
import {OrderAdditionProduct} from "../order-addition-product";

@Injectable()
export class OrderForm extends MyDatatableEntityForm {

    public clientFullName: string;
    public clientEmail: string;
    public clientPhone: string;
    public added: string;

    public status: number = OrderForm.STATUS_PRE_PROCESSING;
    public static STATUS_PRE_PROCESSING = 0;
    public static STATUS_PROCESSING = 1;
    public static STATUS_DELIVERED = 2;
    public static STATUS_CANCELED = 3;
    public static statuses: Object[] = [
        {
            id: OrderForm.STATUS_PRE_PROCESSING,
            label: 'Оформляется',
        },
        {
            id: OrderForm.STATUS_PROCESSING,
            label: 'В работе',
        },
        {
            id: OrderForm.STATUS_DELIVERED,
            label: 'Доставлен',
        },
        {
            id: OrderForm.STATUS_CANCELED,
            label: 'Отменен',
        },
    ];

    public discount: number;

    public orderProducts: OrderProduct[] = [];
    public orderAdditionProducts: OrderAdditionProduct[] = [];

    public typeHeaders = {
        5: 'длина',
        4: 'диаметр',
        3: 'ширина',
        2: 'глубина',
        1: 'Доп. оборудование'
    }

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) {
        super();
    }

    public getStatuses(): Object[] {
        return OrderForm.statuses;
    }

    protected getBackend():BackendService {
        return this.backend;
    }

    protected getLanguagesManager():LanguagesManager {
        return this.langsManager;
    }

    protected getBackendUrl():string {
        return 'orders';
    }

    reset():any {
        this.status = OrderForm.STATUS_PRE_PROCESSING;
        this.discount = null;
        this.orderProducts = [];
        this.orderAdditionProducts = [];
    }

    populate(data:any):any {
        Object.assign(this, data);
        this.orderProducts = [];
        for(let prodData of data['orderProducts']) {
            var orderProduct = new OrderProduct();
            Object.assign(orderProduct, prodData);
            this.orderProducts.push(orderProduct);
        }
        if(data['orderAdditionProducts'] != undefined) {
            this.orderAdditionProducts = [];
            for(let additionProdData of data['orderAdditionProducts']) {
                var orderAdditionProduct = new OrderAdditionProduct();
                Object.assign(orderAdditionProduct, additionProdData);
                var options = [];
                for(var optIndex in orderAdditionProduct.options) {
                    options.push(orderAdditionProduct.options[optIndex]);
                }
                orderAdditionProduct.options = options;
                this.orderAdditionProducts.push(orderAdditionProduct);
            }
        }
    }

    getData():any {
        return {
            status: this.status,
            discount: this.discount,
            orderProducts: this.orderProducts,
            orderAdditionProducts: this.orderAdditionProducts
        };
    }

    public getI18ns(): I18nForm[] {
        return [];
    }

    protected getI18nFormClass(): { new(language: Language): I18nForm} {
        return null;
    }

    public getTotalCost(): number {
        var cost = 0;
        for(let product of this.orderProducts) {
            cost += product.getTotalCost();
        }
        for(let additionProduct of this.orderAdditionProducts) {
            cost += additionProduct.getTotalCost();
        }
        if(this.discount) {
            var discount: string = this.discount.toString();
            cost *= Math.round(100 - parseInt(discount));
            cost /= 100;
        }
        return cost;
    }

}