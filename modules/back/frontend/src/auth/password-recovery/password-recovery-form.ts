import { WebUser } from "../../services/web-user";
import { Injectable } from '@angular/core';
import { Response } from '@angular/http';
import { BackendService } from "../../services/backend.service";

/**
 * Класс для работы с формой логина
 */
@Injectable()
export class PasswordRecoveryForm {

    public email: string;

    constructor(private wUser: WebUser, private backend: BackendService) { }

    public recover(): Promise<string> {
        return new Promise<string>((resolve, reject) => {
            var params = {
                email: this.email
            };
            this.backend.post('auth/password-recovery', params)
                .then((resp: Response) => {
                    resolve(resp.text());
                })
                .catch((resp: Response) => {
                    reject(resp.text());
                });
        });
    }

}