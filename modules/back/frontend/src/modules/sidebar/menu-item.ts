export class MenuItem {

    public children: MenuItem[] = [];

    public isActive: boolean = false;
    public isOpened: boolean = false;

    constructor(public name: string, public route: any[] = null,  public icon: string = null) { }

}