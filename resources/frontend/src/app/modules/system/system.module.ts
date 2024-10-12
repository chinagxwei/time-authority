import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {NzModalService} from "ng-zorro-antd/modal";
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
    TagsComponent
  ],
  imports: [
    CommonModule
  ],
  providers: [NzModalService, NzMessageService]
})
export class SystemModule { }
