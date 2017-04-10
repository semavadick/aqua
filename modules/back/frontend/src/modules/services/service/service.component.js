"use strict";
var advantage_form_1 = require("./advantage-form");
var ServiceComponent = (function () {
    function ServiceComponent() {
    }
    ServiceComponent.prototype.addAdvantage = function () {
        this.getForm().advantages.push(new advantage_form_1.AdvantageForm(this.getLangsManager()));
    };
    ServiceComponent.prototype.deleteAdvantage = function (advantage) {
        var index = this.getForm().advantages.indexOf(advantage);
        this.getForm().advantages.splice(index, 1);
    };
    return ServiceComponent;
}());
exports.ServiceComponent = ServiceComponent;
//# sourceMappingURL=service.component.js.map