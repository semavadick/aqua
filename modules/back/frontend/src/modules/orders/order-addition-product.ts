
export class OrderAdditionProduct {

    public id: number;
    public name: string;
    public sku: string;
    public price: number;
    public quantity: number;
    public options = [];
    public discount: number;

    public getTotalPrice(): number {
        var price = this.price;
        if(this.options != undefined) {
            for(var optIndex in this.options) {
                if(this.options[optIndex].main != 1) {
                    price += parseInt(this.options[optIndex].value);
                }
            }
        }
        var price = price - ((price/100)*this.discount);
        return Math.round(price);
    }

    public getTotalCost(): number {
        return this.quantity * this.getTotalPrice();
    }

    public getOptions(){
        return this.options;
    }

    public setOptions(options){
        this.options = options;
    }

    public getDiscount(){
        return this.discount;
    }

    public setDiscount(discount:number){
        this.discount = discount;
    }

}