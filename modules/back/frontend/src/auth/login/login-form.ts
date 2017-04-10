import { WebUser } from "../../services/web-user";
import { Injectable } from '@angular/core';
import { Response } from '@angular/http';
import { BackendService } from "../../services/backend.service";

/**
 * Класс для работы с формой логина
 */
@Injectable()
export class LoginForm {

    public email: string;
    public password: string;

    constructor(private wUser: WebUser, private backend: BackendService) { }

    public login(): Promise<string> {
        return new Promise<string>((resolve, reject) => {
            var params = {
                email: this.email,
                password: this.password
            };
            this.backend.post('auth/login', params)
                .then((resp: Response) => {
                    this.wUser.updateInformation()
                        .then(() => {
                            resolve(resp.text());
                        })
                        .catch(() => {
                            reject('Произошла ошибка. Повторите запрос еще раз.');
                        });
                })
                .catch((resp: Response) => {
                    reject(resp.text());
                });
        });
    }

}