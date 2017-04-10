"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require('@angular/core');
var router_1 = require('@angular/router');
var web_user_1 = require("../../services/web-user");
var menu_item_1 = require("./menu-item");
var SidebarComponent = (function () {
    function SidebarComponent(wUser, router, eRef) {
        this.wUser = wUser;
        this.router = router;
        this.eRef = eRef;
        this.mobileSidebarClosed = new core_1.EventEmitter();
        this.items = [];
    }
    SidebarComponent.prototype.ngOnInit = function () {
        var _this = this;
        var wUser = this.wUser;
        this.items.push(new menu_item_1.MenuItem('Панель управления', ['/modules/dashboard'], 'home4'));
        if (wUser.canManageOrders) {
            this.items.push(new menu_item_1.MenuItem('Заказы', ['/modules/orders'], 'cart'));
        }
        if (wUser.canManageNews) {
            this.items.push(new menu_item_1.MenuItem('Новости', ['/modules/news'], 'newspaper'));
        }
        if (wUser.canManageArticles) {
            this.items.push(new menu_item_1.MenuItem('Статьи', ['/modules/articles'], 'book3'));
        }
        if (wUser.canManageCatalog) {
            var item = new menu_item_1.MenuItem('Каталог', null, 'store2');
            item.children.push(new menu_item_1.MenuItem('Товары и категории', ['/modules/catalog/store']));
            item.children.push(new menu_item_1.MenuItem('Принадлежности', ['/modules/catalog/attachments']));
            item.children.push(new menu_item_1.MenuItem('Общая информация', ['/modules/catalog/general']));
            this.items.push(item);
        }
        if (wUser.canManageUsers) {
            this.items.push(new menu_item_1.MenuItem('Пользователи', ['/modules/users'], 'users'));
        }
        if (wUser.canManageMainPage) {
            var item = new menu_item_1.MenuItem('Главная страница', null, 'magazine');
            item.children.push(new menu_item_1.MenuItem('Слайды', ['/modules/main-page/slides']));
            item.children.push(new menu_item_1.MenuItem('Баннеры', ['/modules/main-page/banners']));
            item.children.push(new menu_item_1.MenuItem('О компании', ['/modules/main-page/about']));
            item.children.push(new menu_item_1.MenuItem('Общая информация', ['/modules/main-page/general']));
            this.items.push(item);
        }
        if (wUser.canManageAboutPage) {
            var item = new menu_item_1.MenuItem('Страница О компании', null, 'magazine');
            item.children.push(new menu_item_1.MenuItem('История компании', ['/modules/about-page/history']));
            item.children.push(new menu_item_1.MenuItem('Компетенции', ['/modules/about-page/competence']));
            item.children.push(new menu_item_1.MenuItem('Производство', ['/modules/about-page/production']));
            item.children.push(new menu_item_1.MenuItem('Преимущества', ['/modules/about-page/advantages']));
            item.children.push(new menu_item_1.MenuItem('Сертификаты', ['/modules/about-page/certificates']));
            item.children.push(new menu_item_1.MenuItem('Контакты', ['/modules/about-page/contacts']));
            item.children.push(new menu_item_1.MenuItem('SEO', ['/modules/about-page/seo']));
            this.items.push(item);
        }
        if (wUser.canManagePoolsBuildingPage) {
            var item = new menu_item_1.MenuItem('Строительство бассейнов', null, 'design');
            item.children.push(new menu_item_1.MenuItem('Типы бассейнов', ['/modules/pools-building/types']));
            item.children.push(new menu_item_1.MenuItem('Преимущества технологии', ['/modules/pools-building/advantages']));
            item.children.push(new menu_item_1.MenuItem('Вопросы и ответы', ['/modules/pools-building/faq']));
            item.children.push(new menu_item_1.MenuItem('Проектирование', ['/modules/pools-building/project']));
            item.children.push(new menu_item_1.MenuItem('Дизайн', ['/modules/pools-building/design']));
            item.children.push(new menu_item_1.MenuItem('Строительство', ['/modules/pools-building/building']));
            item.children.push(new menu_item_1.MenuItem('SEO', ['/modules/pools-building/seo']));
            this.items.push(item);
        }
        if (wUser.canManageObjectGalleries) {
            this.items.push(new menu_item_1.MenuItem('Объекты', ['/modules/object-galleries'], 'images2'));
        }
        if (wUser.canManageServices) {
            var item = new menu_item_1.MenuItem('Услуги', null, 'hammer');
            item.children.push(new menu_item_1.MenuItem('Обслуживание бассейнов', ['/modules/services/maintenance']));
            item.children.push(new menu_item_1.MenuItem('Эксклюзивные решения', ['/modules/services/exclusive']));
            this.items.push(item);
        }
        if (wUser.canManageSettings) {
            this.items.push(new menu_item_1.MenuItem('Настройки', ['/modules/settings'], 'gear'));
        }
        this.setActiveItemByUrl(this.router.url);
        for (var _i = 0, _a = this.items; _i < _a.length; _i++) {
            var item_1 = _a[_i];
            if (item_1.children.length > 0 && item_1.isActive) {
                item_1.isOpened = true;
            }
        }
        this.routerSubscr = this.router.events.subscribe(function (event) {
            if (!(event instanceof router_1.NavigationStart)) {
                return;
            }
            _this.setActiveItemByUrl(event.url);
        });
    };
    SidebarComponent.prototype.setActiveItemByUrl = function (url, openActive) {
        if (openActive === void 0) { openActive = false; }
        for (var _i = 0, _a = this.items; _i < _a.length; _i++) {
            var item = _a[_i];
            item.isActive = item.route && url.indexOf(item.route[0]) == 0;
            for (var _b = 0, _c = item.children; _b < _c.length; _b++) {
                var child = _c[_b];
                child.isActive = false;
                if (child.route && url.indexOf(child.route[0]) == 0) {
                    item.isActive = true;
                    child.isActive = true;
                }
            }
        }
    };
    SidebarComponent.prototype.ngOnDestroy = function () {
        this.routerSubscr.unsubscribe();
    };
    SidebarComponent.prototype.toggleItem = function (item) {
        if (item.children.length > 0) {
            item.isOpened = !item.isOpened;
            return;
        }
        this.mobileSidebarClosed.emit(null);
        this.router.navigate(item.route);
        $(document.body).animate({ scrollTop: 0 });
    };
    __decorate([
        core_1.Output(), 
        __metadata('design:type', (typeof (_a = typeof core_1.EventEmitter !== 'undefined' && core_1.EventEmitter) === 'function' && _a) || Object)
    ], SidebarComponent.prototype, "mobileSidebarClosed", void 0);
    SidebarComponent = __decorate([
        core_1.Component({
            selector: '[app-sidebar]',
            templateUrl: './sidebar.html',
            encapsulation: core_1.ViewEncapsulation.None,
            directives: [router_1.ROUTER_DIRECTIVES],
        }), 
        __metadata('design:paramtypes', [web_user_1.WebUser, router_1.Router, (typeof (_b = typeof core_1.ElementRef !== 'undefined' && core_1.ElementRef) === 'function' && _b) || Object])
    ], SidebarComponent);
    return SidebarComponent;
    var _a, _b;
}());
exports.SidebarComponent = SidebarComponent;
//# sourceMappingURL=sidebar.component.js.map