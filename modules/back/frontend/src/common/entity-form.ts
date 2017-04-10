import {I18nForm} from "./i18n-form";
import {BackendService} from "../services/backend.service";
import {LanguagesManager} from "../services/languages-manager";
import {Response} from "@angular/http";
import {Form} from "./form";
import {Language} from "../services/language";
import {ReflectiveInjector} from '@angular/core';
import {HTTP_PROVIDERS} from '@angular/http';

/**
 * Базовый класс для форм для редактирования сущности
 */
export abstract class EntityForm extends Form {

    public isLoading: boolean = false;

    private i18ns: I18nForm[] = null;

    protected abstract getBackend(): BackendService;
    protected abstract getLanguagesManager(): LanguagesManager;

    protected abstract getI18nFormClass(): { new(language: Language): I18nForm };

    public getI18ns(): I18nForm[] {
        if(this.i18ns === null) {
            this.i18ns = [];
            var i18nClass = this.getI18nFormClass();
            if(!i18nClass) {
                return [];
            }
            for(let language of this.getLanguagesManager().getLanguages()) {
                var i18n = new i18nClass(language);
                this.i18ns.push(i18n);
            }
        }
        return this.i18ns;
    }

    protected initLocally(): Promise<string> {
        return new Promise<string>((resolve) => {
            this.reset();
            this.clearErrors();
            for(let i18n of this.getI18ns()) {
                i18n.reset();
                i18n.clearErrors();
                i18n.saveI18n = false;
            }
            resolve('ok');
        });
    }

    protected initFromUrl(url: string): Promise<string> {
        return new Promise<string>((resolve, reject) => {
            this.isLoading = true;
            this.reset();
            this.clearErrors();
            for(let i18n of this.getI18ns()) {
                i18n.reset();
                i18n.clearErrors();
                i18n.saveI18n = false;
            }
            this.getBackend().get(url)
                .then((resp: Response) => {
                    var data = resp.json();
                    this.populate(data);
                    for(let i18n of this.getI18ns()) {
                        for(var i18nData of data['i18ns']) {
                            if(i18nData['languageId'] == i18n.language.id) {
                                i18n.saveI18n = i18nData['saveI18n'];
                                i18n.populate(i18nData);
                            }
                        }
                    }
                    this.isLoading = false;
                    resolve('ok');
                })
                .catch((resp: Response) => {
                    this.isLoading = false;
                    reject(resp.text());
                });
        });
    }

    protected saveViaUrl(url: string, isNewEntity: boolean = true): Promise<string> {
        this.isLoading = true;
        return new Promise<any>((resolve, reject) => {
            var data = this.getData();
            var i18nsData: Object[] = [];
            var i18ns = this.getI18ns();
            for(let i18n of i18ns) {
                var i18nData = i18n.getData();
                i18nData['languageId'] = i18n.language.id;
                i18nData['saveI18n'] = i18n.saveI18n;
                i18nsData.push(i18nData);
            }
            data['i18ns'] = i18nsData;
            var reqThen = () => {
                this.isLoading = false;
                resolve('ok');
            };
            var reqCatch = (resp: Response) => {
                try {
                    var data = resp.json();
                } catch (e) {
                    this.isLoading = false;
                    reject('Произошла ошибка: ' + resp.statusText);
                    return;
                }
                this.setErrors(data);
                for(let i18nErrors of data['i18ns']) {
                    for(let i18n of i18ns) {
                        if(i18n.language.id == i18nErrors['languageId']) {
                            var errors = Object.assign({}, i18nErrors);
                            delete errors['languageId'];
                            i18n.setErrors(errors);
                        }
                    }
                }
                this.isLoading = false;
                reject(null);
            };

            this.clearErrors();
            for(let i18n of i18ns) {
                i18n.clearErrors();
            }

            if(isNewEntity) {
                this.getBackend().post(url, data)
                    .then(reqThen)
                    .catch(reqCatch)
            } else {
                this.getBackend().put(url, data)
                    .then(reqThen)
                    .catch(reqCatch)
            }
        });
    }

    public hasI18nGeneralError(): boolean {
        return this.errors.hasOwnProperty('i18nsGeneral');
    }

    public getI18nGeneralError(): string {
        if(!this.hasI18nGeneralError()) {
            return null;
        }
        return this.errors['i18nsGeneral'][0]
    }

}