import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {NzModalService} from "ng-zorro-antd/modal";
import {NzMessageService} from "ng-zorro-antd/message";
import { DashboardComponent } from './dashboard/dashboard.component';
import { PersonnelComponent } from './personnel/personnel.component';
import { SchedulesComponent } from './schedules/schedules.component';
import { OrdersComponent } from './orders/orders.component';
import { TopicsComponent } from './topics/topics.component';



@NgModule({
  declarations: [
    DashboardComponent,
    PersonnelComponent,
    SchedulesComponent,
    OrdersComponent,
    TopicsComponent
  ],
  imports: [
    CommonModule
  ],
  providers: [NzModalService, NzMessageService]
})
export class OrganizationModule { }
