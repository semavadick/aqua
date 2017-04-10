import { Component, OnInit, OnDestroy } from '@angular/core';
import { Router, ActivatedRoute, ROUTER_DIRECTIVES } from '@angular/router';
import { LoginForm } from "./login-form";

@Component({
    templateUrl: './login.html',
    providers: [LoginForm],
    directives: [<any[]>ROUTER_DIRECTIVES]
})
export class LoginComponent implements OnInit {

    private returnUrl: string = null;

    constructor(public form: LoginForm, private router: Router, private route: ActivatedRoute) { }

    public login() {
        this.form.login()
            .then((message: string) => {
                var url = this.returnUrl ? this.returnUrl : '/';
                this.router.navigateByUrl(url);
            })
            .catch((message: string) => {
                alert(message);
            });
    }

    public ngOnInit() {
        this.route
            .params
            .subscribe(params => {
                var returnUrl: string = params['returnUrl'];
                if(returnUrl !== undefined) {
                    this.returnUrl = returnUrl;
                }
            });
    }

}
