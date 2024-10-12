import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {NzModalService} from "ng-zorro-antd/modal";
import {NzMessageService} from "ng-zorro-antd/message";
import { OrdersComponent } from './orders/orders.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { SchedulesComponent } from './schedules/schedules.component';
import { QuestsComponent } from './quests/quests.component';



@NgModule({
  declarations: [
    OrdersComponent,
    DashboardComponent,
    SchedulesComponent,
    QuestsComponent
  ],
  imports: [
    CommonModule
  ],
  providers: [NzModalService, NzMessageService]
})
export class MemberModule { }
