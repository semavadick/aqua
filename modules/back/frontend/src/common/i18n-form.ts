import {Form} from "./form";
import {Language} from "../services/language";

/**
 * Базовый класс для форм
 */
export abstract class I18nForm extends Form {

    public saveI18n: boolean = false;

    public constructor(public language: Language) {
        super();
    }

}