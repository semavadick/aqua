import {Language} from "./language";
import {Response} from "@angular/http";
import {BackendService} from "./backend.service";
import { Injectable } from '@angular/core';

/**
 * Класс для работы с менеджером языков
 */
@Injectable()
export class LanguagesManager {

    private languages: Language[] = [];

    private isInitialized: boolean = false;

    constructor(private backend: BackendService) { }

    public init(): Promise<any> {
        return new Promise<any>((resolve, reject) => {
            if(this.isInitialized) {
                resolve();
                return;
            }

            this.backend.get('auth/languages-init')
                .then((resp: Response) => {
                    this.languages  = [];
                    for(let langData of resp.json()) {
                        var language = new Language();
                        Object.assign(language, langData);
                        this.languages.push(language);
                    }
                    if(!this.languages.length) {
                        reject();
                    }
                    this.isInitialized = true;
                    resolve();
                })
                .catch((resp: Response) => {
                    console.error(resp.text());
                    reject();
                });
        });
    }

    public getLanguages(): Language[] {
        return this.languages;
    }

    public getDefaultLanguage(): Language {
        return this.languages[0];
    }

    public getLanguageById(id: number): Language {
        for(let language of this.languages) {
            if(language.id == id) {
                return language;
            }
        }
        return null;
    }

}