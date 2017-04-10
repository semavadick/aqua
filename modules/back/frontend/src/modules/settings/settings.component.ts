import { Component, Type, OnInit, ViewChild } from '@angular/core';
import { HeaderComponent } from "../header/header.component";
import {FormGroupComponent} from "../../common/form-group/form-group.component";
import {FormPanelComponent} from "../../common/form-panel/form-panel.component";
import {SettingsForm} from "./settings-form";

@Component({
    templateUrl: './settings.html',
    directives: [
        <Type>HeaderComponent,
        <Type>FormGroupComponent,
        <Type>FormPanelComponent,
    ],
    providers: [SettingsForm],
})
export class SettingsComponent {

    public constructor(public form: SettingsForm) { }

}
