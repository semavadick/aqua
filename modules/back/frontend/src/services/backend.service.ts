import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { Http, Response, RequestOptionsArgs } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import {WebUser} from "./web-user";

/**
 * Класс для работы с API backend
 */
@Injectable()
export class BackendService {

    private http: Http;
    private backendBaseUrl: string = '/back/';

    constructor(http: Http, private router: Router) {
        this.http = http;
    }

    public get(url: string, options?: RequestOptionsArgs): Promise<Response> {
        url = this.backendBaseUrl + url;
        return this.obsToPromise(this.http.get(url, options));
    }

    public post(url: string, options?: RequestOptionsArgs): Promise<Response> {
        url = this.backendBaseUrl + url;
        return this.obsToPromise(this.http.post(url, options));
    }

    public put(url: string, options?: RequestOptionsArgs): Promise<Response> {
        url = this.backendBaseUrl + url;
        return this.obsToPromise(this.http.put(url, options));
    }

    public delete(url: string, options?: RequestOptionsArgs): Promise<Response> {
        url = this.backendBaseUrl + url;
        return this.obsToPromise(this.http.delete(url, options));
    }

    private obsToPromise(obs: Observable<Response>): Promise<Response> {
        return new Promise<Response>((resolve, reject) => {
            obs.subscribe(
                (response: Response) => {
                    resolve(response);
                },
                (response: Response) => {
                    if(response.status == 401) {
                        this.router.navigate(['/auth/login', {returnUrl: this.router.routerState.snapshot.url}]);
                        return;
                    }
                    reject(response);
                }
            );
        });
    }

}