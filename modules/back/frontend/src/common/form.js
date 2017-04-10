"use strict";
/**
 * Базовый класс для форм
 */
var Form = (function () {
    function Form() {
        this.errors = {};
    }
    Form.prototype.hasErrors = function () {
        return Object.keys(this.errors).length > 0;
    };
    Form.prototype.hasError = function (attribute) {
        if (!this.errors.hasOwnProperty(attribute)) {
            return false;
        }
        return this.errors[attribute].length > 0;
    };
    Form.prototype.getError = function (attribute) {
        if (!this.hasError(attribute)) {
            return '';
        }
        return this.errors[attribute][0];
    };
    Form.prototype.clearErrors = function () {
        this.errors = {};
    };
    Form.prototype.setErrors = function (errors) {
        this.errors = errors;
    };
    return Form;
}());
exports.Form = Form;
//# sourceMappingURL=form.js.map