
export class OrderProduct {

    public id: number;
    public name: string;
    public sku: string;
    public price: number;
    public quantity: number;
    public discount: number;

    public getTotalPrice(): number {
        var price = this.price - ((this.price/100)*this.discount);
        return Math.round(price);
    }

    public getTotalCost(): number {
        return this.quantity * this.getTotalPrice();
    }

    public getDiscount(){
        return this.discount;
    }

    public setDiscount(discount:number){
        this.discount = discount;
    }

}