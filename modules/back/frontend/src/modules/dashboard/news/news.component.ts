import { Component, Input,  } from '@angular/core';
import { Router } from '@angular/router';

@Component({
    selector: 'dashboard-news',
    templateUrl: './news.html',
})
export class NewsComponent {

    @Input()
    public news: Object[] = [];

    public constructor(private router: Router) { }

    public goToNewsItem(id: number) {
        this.router.navigate(['/modules/news', {id: id}])
    }

}
