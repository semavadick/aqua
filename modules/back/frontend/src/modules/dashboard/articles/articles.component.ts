import { Component, Input,  } from '@angular/core';
import { Router } from '@angular/router';

@Component({
    selector: 'dashboard-articles',
    templateUrl: './articles.html',
})
export class ArticlesComponent {

    @Input()
    public articles: Object[] = [];

    public constructor(private router: Router) { }

    public goToArticle(id: number) {
        this.router.navigate(['/modules/articles', {id: id}])
    }

}
