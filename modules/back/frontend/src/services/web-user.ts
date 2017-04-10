import { Injectable, EventEmitter } from '@angular/core';
import { BackendService } from "./backend.service";
import { Response } from "@angular/http";
import {Language} from "./language";
import {LanguagesManager} from "./languages-manager";

/**
 * Класс для работы с веб-юзером
 */
@Injectable()
export class WebUser {

    private isInitialized: boolean = false;

    public returnUrl: string;

    /** Залогинен ли юзер */
    public isLoggedIn: boolean = false;

    /** Имя */
    public name: string;

    /** Может ли юзер управлять главной страницей */
    public canManageMainPage = false;

    /** Может ли юзер управлять страницей О компании */
    public canManageAboutPage = false;

    /** Может ли юзер управлять страницей Строительство бассейнов */
    public canManagePoolsBuildingPage = false;

    /** Может ли юзер управлять Объектами */
    public canManageObjectGalleries = false;

    /** Может ли юзер управлять новостями */
    public canManageNews = false;

    /** Может ли юзер управлять статьями */
    public canManageArticles = false;

    /** Может ли юзер управлять услугами */
    public canManageServices = false;

    /** Может ли юзер управлять каталогом */
    public canManageCatalog = false;

    /** Может ли юзер управлять пользователями */
    public canManageUsers = false;

    /** Может ли юзер управлять заказами */
    public canManageOrders = false;

    /** Может ли юзер управлять настройками */
    public canManageSettings = false;

    public constructor(private backend: BackendService, private langsManager: LanguagesManager) { }

    public logout(): Promise<string> {
        return new Promise<string>((resolve, reject) => {
            this.backend.post('auth/logout')
                .then((resp: Response) => {
                    this.isLoggedIn = false;
                    resolve('ok');
                })
                .catch((resp: Response) => {
                    reject(resp.text());
                });
        });
    }

    public init(): Promise<any> {
        return new Promise<any>((resolve, reject) => {
            if(this.isInitialized) {
                resolve();
                return;
            }
            this.updateInformation()
                .then(resolve)
                .catch(reject);
        });
    }

    public updateInformation(): Promise<any> {
        return new Promise<any>((resolve, reject) => {
            this.backend.get('auth/user-init')
                .then((resp: Response) => {
                    Object.assign(this, resp.json());
                    resolve();
                })
                .catch((resp: Response) => {
                    console.error(resp.text());
                    reject();
                });
        });
    }

}