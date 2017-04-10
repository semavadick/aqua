import { Component, Type, ViewChild, OnInit } from '@angular/core';
import { ROUTER_DIRECTIVES } from '@angular/router';
import { NavbarComponent } from './navbar/navbar.component';
import { SidebarComponent } from './sidebar/sidebar.component';
declare var $: any;

@Component({
    templateUrl: './modules.html',
    directives: [<Type>NavbarComponent, <Type>SidebarComponent, <any[]>ROUTER_DIRECTIVES],
})
export class ModulesComponent implements OnInit {

    public containerClass: string = "sidebar-xs";

    @ViewChild(<Type>NavbarComponent, undefined)
    public navbar: NavbarComponent;

    public closeMobileSidebar() {
        this.navbar.closeMobileSidebar();
    }

    public ngOnInit() {
        $('.page-container').css({
            minHeight: $(window).height() - $('.navbar').outerHeight()
        });
    }
}
