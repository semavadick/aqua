import { Component, Output, EventEmitter, OnInit, OnDestroy, Type, ElementRef, ViewEncapsulation } from '@angular/core';
import { Location } from '@angular/common';
import { Router, Event, NavigationStart, ROUTER_DIRECTIVES } from '@angular/router';
import { Subscription } from 'rxjs';
import {WebUser} from "../../services/web-user";
import {MenuItem} from "./menu-item";
declare var $:any;

@Component({
    selector: '[app-sidebar]',
    templateUrl: './sidebar.html',
    encapsulation: ViewEncapsulation.None,
    directives: [<any>ROUTER_DIRECTIVES],
})
export class SidebarComponent implements OnInit, OnDestroy {

    @Output()
    public mobileSidebarClosed: EventEmitter<any> = new EventEmitter<any>();

    public items: MenuItem[] = [];

    private routerSubscr: Subscription;

    constructor(public wUser: WebUser, private router: Router, private eRef: ElementRef) { }

    ngOnInit() {
        var wUser = this.wUser;

        this.items.push(new MenuItem('Панель управления', ['/modules/dashboard'], 'home4'));

        if(wUser.canManageOrders) {
            this.items.push(new MenuItem('Заказы', ['/modules/orders'], 'cart'));
        }

        if(wUser.canManageNews) {
            this.items.push(new MenuItem('Новости', ['/modules/news'], 'newspaper'));
        }

        if(wUser.canManageArticles) {
            this.items.push(new MenuItem('Статьи', ['/modules/articles'], 'book3'));
        }

        if(wUser.canManageCatalog) {
            var item = new MenuItem('Каталог', null, 'store2');
            item.children.push(new MenuItem('Товары и категории', ['/modules/catalog/store']));
            item.children.push(new MenuItem('Принадлежности', ['/modules/catalog/attachments']));
            item.children.push(new MenuItem('Общая информация', ['/modules/catalog/general']));
            this.items.push(item);
        }

        if(wUser.canManageUsers) {
            this.items.push(new MenuItem('Пользователи', ['/modules/users'], 'users'));
        }

        if(wUser.canManageMainPage) {
            var item = new MenuItem('Главная страница', null, 'magazine');
            item.children.push(new MenuItem('Слайды', ['/modules/main-page/slides']));
            item.children.push(new MenuItem('Баннеры', ['/modules/main-page/banners']));
            item.children.push(new MenuItem('О компании', ['/modules/main-page/about']));
            item.children.push(new MenuItem('Общая информация', ['/modules/main-page/general']));
            this.items.push(item);
        }

        if(wUser.canManageAboutPage) {
            var item = new MenuItem('Страница О компании', null, 'magazine');
            item.children.push(new MenuItem('История компании', ['/modules/about-page/history']));
            item.children.push(new MenuItem('Компетенции', ['/modules/about-page/competence']));
            item.children.push(new MenuItem('Производство', ['/modules/about-page/production']));
            item.children.push(new MenuItem('Преимущества', ['/modules/about-page/advantages']));
            item.children.push(new MenuItem('Сертификаты', ['/modules/about-page/certificates']));
            item.children.push(new MenuItem('Контакты', ['/modules/about-page/contacts']));
            item.children.push(new MenuItem('SEO', ['/modules/about-page/seo']));
            this.items.push(item);
        }

        if(wUser.canManagePoolsBuildingPage) {
            var item = new MenuItem('Строительство бассейнов', null, 'design');
            item.children.push(new MenuItem('Типы бассейнов', ['/modules/pools-building/types']));
            item.children.push(new MenuItem('Преимущества технологии', ['/modules/pools-building/advantages']));
            item.children.push(new MenuItem('Вопросы и ответы', ['/modules/pools-building/faq']));
            item.children.push(new MenuItem('Проектирование', ['/modules/pools-building/project']));
            item.children.push(new MenuItem('Дизайн', ['/modules/pools-building/design']));
            item.children.push(new MenuItem('Строительство', ['/modules/pools-building/building']));
            item.children.push(new MenuItem('Реконструкция', ['/modules/pools-building/rebuilding']));
            item.children.push(new MenuItem('SEO', ['/modules/pools-building/seo']));
            this.items.push(item);
        }

        if(wUser.canManageObjectGalleries) {
            this.items.push(new MenuItem('Объекты', ['/modules/object-galleries'], 'images2'));
        }

        if(wUser.canManageServices) {
            var item = new MenuItem('Услуги', null, 'hammer');
            item.children.push(new MenuItem('Обслуживание бассейнов', ['/modules/services/maintenance']));
            item.children.push(new MenuItem('Эксклюзивные решения', ['/modules/services/exclusive']));
            this.items.push(item);
        }

        if(wUser.canManageSettings) {
            this.items.push(new MenuItem('Настройки', ['/modules/settings'], 'gear'));
        }


        this.setActiveItemByUrl(this.router.url);
        for(let item of this.items) {
            if(item.children.length > 0 && item.isActive) {
                item.isOpened = true;
            }
        }
        this.routerSubscr = this.router.events.subscribe((event: Event) => {
            if(!(event instanceof NavigationStart)) {
                return;
            }
            this.setActiveItemByUrl(event.url);
        });
    }

    private setActiveItemByUrl(url: string, openActive: boolean = false) {
        for(let item of this.items) {
            item.isActive = item.route && url.indexOf(item.route[0]) == 0;
            for(let child of item.children) {
                child.isActive = false;
                if(child.route && url.indexOf(child.route[0]) == 0) {
                    item.isActive = true;
                    child.isActive = true;
                }
            }
        }
    }

    ngOnDestroy() {
        this.routerSubscr.unsubscribe();
    }

    public toggleItem(item: MenuItem) {
        if(item.children.length > 0) {
            item.isOpened = !item.isOpened;
            return;
        }
        this.mobileSidebarClosed.emit(null);
        this.router.navigate(item.route);
        $(document.body).animate({scrollTop: 0})
    }

}
