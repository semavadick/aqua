import {I18nForm} from "./i18n-form";
import {BackendService} from "../services/backend.service";
import {LanguagesManager} from "../services/languages-manager";
/**
 * Базовый класс для форм
 */
export abstract class Form {

    protected errors: Object = {};

    public hasErrors(): boolean {
        return Object.keys(this.errors).length > 0;
    }

    public hasError(attribute: string): boolean {
        if(!this.errors.hasOwnProperty(attribute)) {
            return false;
        }
        return this.errors[attribute].length > 0;
    }

    public getError(attribute: string): string {
        if(!this.hasError(attribute)) {
            return '';
        }
        return this.errors[attribute][0];
    }

    public clearErrors() {
        this.errors = {};
    }

    public setErrors(errors: Object) {
        this.errors = errors;
    }

    public abstract reset(): any;

    public abstract populate(data: any): any;

    public abstract getData(): any;

}