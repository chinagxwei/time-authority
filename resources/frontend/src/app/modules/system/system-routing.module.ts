import {RouterModule, Routes} from "@angular/router";
import {NgModule} from "@angular/core";

import {DashboardComponent} from "./dashboard/dashboard.component";
import {RouterComponent} from "./router/router.component";
import {RoleComponent} from "./role/role.component";
import {NavigationComponent} from "./navigation/navigation.component";
import {ConfigComponent} from "./config/config.component";
import {LogComponent} from "./log/log.component";
import {AgreementComponent} from "./agreement/agreement.component";
import {ComplaintComponent} from "./complaint/complaint.component";
import {UnitComponent} from "./unit/unit.component";
import {TagsComponent} from "./tags/tags.component";
import {ManagerComponent} from "./manager/manager.component";
import {MessageComponent} from "./message/message.component";
import {FileComponent} from "./file/file.component";
import {LayoutComponent} from "../../components/layout/layout.component";

const platformRoutes: Routes = [
  {
    path: '', component: LayoutComponent,
    children: [
      {path: '', component: DashboardComponent},
      {path: 'dashboard', component: DashboardComponent},
      {path: 'router', component: RouterComponent},
      {path: 'role', component: RoleComponent},
      {path: 'navigation', component: NavigationComponent},
      {path: 'message', component: MessageComponent},
      {path: 'manager', component: ManagerComponent},
      {path: 'file', component: FileComponent},
      {path: 'config', component: ConfigComponent},
      {path: 'action-log', component: LogComponent},
      {path: 'agreement', component: AgreementComponent},
      {path: 'complaint', component: ComplaintComponent},
      {path: 'tags', component: TagsComponent},
      {path: 'unit', component: UnitComponent},
    ]
  },
];

@NgModule({
  imports: [
    RouterModule.forChild(platformRoutes)
  ],
  exports: [
    RouterModule
  ]
})
export class SystemRoutingModule {
}
