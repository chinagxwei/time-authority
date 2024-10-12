import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {NzModalModule, NzModalService} from "ng-zorro-antd/modal";
import {NzMessageService} from "ng-zorro-antd/message";
import { DashboardComponent } from './dashboard/dashboard.component';
import { RoleComponent } from './role/role.component';
import { RouterComponent } from './router/router.component';
import { LogComponent } from './log/log.component';
import { ConfigComponent } from './config/config.component';
import { AgreementComponent } from './agreement/agreement.component';
import { ComplaintComponent } from './complaint/complaint.component';
import { FileComponent } from './file/file.component';
import { NavigationComponent } from './navigation/navigation.component';
import { UnitComponent } from './unit/unit.component';
import { MessageComponent } from './message/message.component';
import { ManagerComponent } from './manager/manager.component';
import { TagsComponent } from './tags/tags.component';
import {NzTableModule} from "ng-zorro-antd/table";
import {NzDividerModule} from "ng-zorro-antd/divider";
import {NzFormModule} from "ng-zorro-antd/form";
import {ReactiveFormsModule} from "@angular/forms";
import {NzInputModule} from "ng-zorro-antd/input";
import {NzButtonModule} from "ng-zorro-antd/button";
import {NzTagModule} from "ng-zorro-antd/tag";
import {EditorForAngularModule} from "wangeditor-for-angular";
import {NzSwitchModule} from "ng-zorro-antd/switch";
import {NzSelectModule} from "ng-zorro-antd/select";
import { ConfigRouterComponent } from './role/config-router/config-router.component';
import { ConfigNavigationComponent } from './role/config-navigation/config-navigation.component';
import {SystemRoutingModule} from "./system-routing.module";



@NgModule({
  declarations: [
    DashboardComponent,
    RoleComponent,
    RouterComponent,
    LogComponent,
    ConfigComponent,
    AgreementComponent,
    ComplaintComponent,
    FileComponent,
    NavigationComponent,
    UnitComponent,
    MessageComponent,
    ManagerComponent,
    TagsComponent,
    ConfigRouterComponent,
    ConfigNavigationComponent
  ],
  imports: [
    CommonModule,
    SystemRoutingModule,
    NzTableModule,
    NzDividerModule,
    NzModalModule,
    NzFormModule,
    ReactiveFormsModule,
    NzInputModule,
    NzButtonModule,
    NzTagModule,
    EditorForAngularModule,
    NzSwitchModule,
    NzSelectModule
  ],
  providers: [NzModalService, NzMessageService]
})
export class SystemModule { }
