import { Component, OnInit, OnDestroy } from '@angular/core';
import { ROUTER_DIRECTIVES } from '@angular/router';
import { PasswordRecoveryForm } from "./password-recovery-form";

@Component({
    templateUrl: './password-recovery.html',
    providers: [PasswordRecoveryForm],
    directives: [<any[]>ROUTER_DIRECTIVES]
})
export class PasswordRecoveryComponent  {

    public recovered: boolean = false;

    constructor(public form: PasswordRecoveryForm) { }

    public recover() {
        this.form.recover()
            .then((message: string) => {
                this.recovered = true;
            })
            .catch((message: string) => {
                alert(message);
            });
    }

}
