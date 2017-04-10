import { Component, ElementRef, Output, EventEmitter } from '@angular/core';
import { WebUser } from '../../services/web-user';
import { Router, ROUTER_DIRECTIVES } from '@angular/router';

@Component({
    selector: 'app-navbar',
    templateUrl: './navbar.html',
    directives: [<any>ROUTER_DIRECTIVES],
    host: {
        '(document:click)': 'onClick($event)',
    },
})
export class NavbarComponent {

    @Output()
    public containerClassChanged: EventEmitter<string> = new EventEmitter<string>();

    public userDDOpened: boolean = false;

    constructor(public wUser: WebUser, private router: Router, private eref: ElementRef) { }

    public logout() {
        this.wUser.logout()
            .then(() => {
                this.router.navigate(['/auth/login']);
            })
            .catch((message: string) => {
                alert(message);
            });
    }

    public toggleUserDD() {
        this.userDDOpened = !this.userDDOpened;
    }

    public onClick(event: Event) {
        if(!this.eref.nativeElement.contains(event.target)) {
            this.userDDOpened = false;
        }
    }

    public mobileMenuOpened = false;

    public toggleMobileMenu() {
        this.mobileMenuOpened = !this.mobileMenuOpened;
    }

    private mobileSidebarOpened = false;

    public toggleMobileSidebar() {
        this.mobileSidebarOpened = !this.mobileSidebarOpened;
        var className = this.mobileSidebarOpened ? 'sidebar-mobile-main' : '';
        this.containerClassChanged.emit(className);
    }

    public closeMobileSidebar() {
        if(!this.mobileSidebarOpened) {
            return;
        }
        this.mobileSidebarOpened = false;
        var className = this.mobileSidebarOpened ? 'sidebar-mobile-main' : '';
        this.containerClassChanged.emit(className);
    }

    private sidebarReduced = true;

    public toggleSidebarMode() {
        this.sidebarReduced = !this.sidebarReduced;
        var className = this.sidebarReduced ? 'sidebar-xs' : '';
        this.containerClassChanged.emit(className);
    }

}
