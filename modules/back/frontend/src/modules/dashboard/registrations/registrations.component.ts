import { Component, Input,  } from '@angular/core';
import { Router } from '@angular/router';

@Component({
    selector: 'dashboard-registrations',
    templateUrl: './registrations.html',
})
export class RegistrationsComponent {

    @Input()
    public users: Object[] = [];

    public constructor(private router: Router) { }

    public goToUser(id: number) {
        this.router.navigate(['/modules/users', {id: id}])
    }

}
