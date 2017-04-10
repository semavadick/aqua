import { Component, OnInit, OnDestroy } from '@angular/core';
import { Router, Params, ROUTER_DIRECTIVES } from '@angular/router';
import { PasswordResetForm } from "./password-reset-form";

@Component({
    templateUrl: './password-reset.html',
    providers: [PasswordResetForm],
    directives: [<any[]>ROUTER_DIRECTIVES]
})
export class PasswordResetComponent  {

    public isReset: boolean = false;

    constructor(public form: PasswordResetForm, private router: Router) {
        router.routerState.queryParams.subscribe((params) => {
            this.form.userId = params['i'];
            this.form.resetToken = params['t'];
        })
    }

    public reset() {
        this.form.reset()
            .then((message: string) => {
                this.isReset = true;
            })
            .catch((message: string) => {
                alert(message);
            });
    }

}
