import {Component, EventEmitter, Input, OnChanges, OnInit, Output, SimpleChanges} from '@angular/core';
import {Role, SystemRouter} from "../../../../models/system";
import {TransferItem} from "ng-zorro-antd/transfer";
import {RoleService} from "../../../../services/system/role.service";
import {ResponseCode} from "../../../../utils/response-code";
import {RouterService} from "../../../../services/system/router.service";

@Component({
  selector: 'app-config-router',
  templateUrl: './config-router.component.html',
  styleUrls: ['./config-router.component.css']
})
export class ConfigRouterComponent implements OnInit, OnChanges {

  @Input()
  currentRole!: Role;

  @Input()
  visible: boolean = false;

  @Output()
  visibleChange = new EventEmitter<boolean>();

  registerRouterList: SystemRouter[] | undefined = []

  list: TransferItem[] = [];

  roleRouters: SystemRouter[] | undefined = []

  constructor(private roleService: RoleService, private componentService: RouterService) {
  }

  ngOnInit(): void {
    this.getRegisteredRoute();
  }

  ngOnChanges(changes: SimpleChanges): void {
    this.getCurrentRouter();
  }

  handleCancel() {
    this.handleVisible(false);
  }

  handleVisible(type: boolean) {
    this.visible = type;
    this.visibleChange.emit(this.visible)
  }

  filterOption(inputValue: string, item: any): boolean {
    return item.description.indexOf(inputValue) > -1;
  }

  getCurrentRouter() {

    this.roleService.getRouter(this.currentRole?.id).subscribe(res => {
      // console.log(res)
      this.list = [];
      if (res.code === ResponseCode.RESPONSE_SUCCESS) {
        this.roleRouters = res.data
        this.registerRouterList?.forEach(value => {
          const direction = this.roleRouters?.find(v2 => value.id === v2.id) ? 'right' : undefined;
          this.list.push({
            id: value.id?.toString(),
            title: `${value.router_name} [ ${value.router} ]`,
            description: value.router_name,
            direction
          });
        })
      }
    })
  }

  private getRegisteredRoute() {
    this.componentService.registeredRoute().subscribe(res => {
      // console.log(res)
      if (res.code === ResponseCode.RESPONSE_SUCCESS) {
        this.registerRouterList = res.data;
      }
    })
  }

  search(ret: {}): void {
    console.log('nzSearchChange', ret);ret
  }

  change(ret: {}): void {
    // console.log('nzChange', ret);
    const filterData = this.list.filter(v => v.direction === 'right');
    // @ts-ignore
    this.roleService.configRouter({id: this.currentRole.id, router_ids: filterData.map(v => v.id)})
      .subscribe(res => {

      })

  }

}
