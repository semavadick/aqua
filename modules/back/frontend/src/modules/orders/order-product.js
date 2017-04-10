"use strict";
var OrderProduct = (function () {
    function OrderProduct() {
    }
    OrderProduct.prototype.getTotalCost = function () {
        return this.quantity * this.price;
    };
    return OrderProduct;
}());
exports.OrderProduct = OrderProduct;
//# sourceMappingURL=order-product.js.map