import { WebUser } from "../../services/web-user";
import { Injectable } from '@angular/core';
import { Response } from '@angular/http';
import { BackendService } from "../../services/backend.service";

/**
 * Класс для работы с формой логина
 */
@Injectable()
export class PasswordResetForm {

    public password: string;
    public password2: string;
    public userId: string;
    public resetToken: string;

    constructor(private backend: BackendService) { }

    public reset(): Promise<string> {
        return new Promise<string>((resolve, reject) => {
            var params = {
                userId: this.userId,
                resetToken: this.resetToken,
                password: this.password,
                password2: this.password2,
            };
            this.backend.post('auth/password-reset', params)
                .then((resp: Response) => {
                    resolve(resp.text());
                })
                .catch((resp: Response) => {
                    reject(resp.text());
                });
        });
    }

}