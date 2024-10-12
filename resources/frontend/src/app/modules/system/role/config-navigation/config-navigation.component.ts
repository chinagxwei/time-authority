import {Component, EventEmitter, Input, OnChanges, OnInit, Output, SimpleChanges} from '@angular/core';
import {Role} from "../../../../models/system";
import {RoleService} from "../../../../services/system/role.service";
import {NavigationService} from "../../../../services/system/navigation.service";
import {ResponseCode} from "../../../../utils/response-code";
import {NzFormatEmitEvent} from "ng-zorro-antd/tree";

@Component({
  selector: 'app-config-navigation',
  templateUrl: './config-navigation.component.html',
  styleUrls: ['./config-navigation.component.css']
})
export class ConfigNavigationComponent implements OnInit, OnChanges {

  @Input()
  visible: boolean = false;

  @Output()
  visibleChange = new EventEmitter<boolean>();

  @Input()
  currentRole!: Role;

  defaultCheckedKeys: string[] = [];
  // defaultSelectedKeys = ['1'];

  nodes: any = undefined;

  constructor(private roleService: RoleService, private navigationService: NavigationService) {
  }

  ngOnInit(): void {
    this.getRegisterNavigation()
  }

  handleCancel() {
    this.handleVisible(false);
  }

  handleVisible(type: boolean) {
    this.visible = type;
    this.visibleChange.emit(this.visible)
  }

  ngOnChanges(changes: SimpleChanges): void {
    this.getCurrentNavigation()
  }

  getCurrentNavigation() {
    this.defaultCheckedKeys = [];
    this.roleService.getNavigation(this.currentRole.id).subscribe(res => {
      // console.log(res)
      if (res.code === ResponseCode.RESPONSE_SUCCESS) {
        if (res.data && res.data.length > 0) {
          // const ids = res.data?.map(v => v.id?.toString())
          // console.log(ids)
          // @ts-ignore
          this.defaultCheckedKeys = res.data.map(v => v.id?.toString());
        }
      }
    })
  }

  getRegisterNavigation() {
    this.navigationService.registered()
      .subscribe(res => {
        // console.log(res)
        if (res.code === ResponseCode.RESPONSE_SUCCESS) {
          // @ts-ignore
          this.nodes = res.data?.map(value => {
            let children: any = [];

            children = value.children?.map(value1 => {
              return {
                title: value1.navigation_name,
                key: value1.id?.toString(),
                isLeaf: true
              }
            })

            if (children.length > 0) {
              return {
                title: value.navigation_name,
                key: value.id?.toString(),
                expanded: true,
                children
              }
            } else {
              return {
                title: value.navigation_name,
                key: value.id?.toString(),
                isLeaf: true
              }
            }
          })
        }
      })
  }

  nzEvent(event: NzFormatEmitEvent): void {
    // console.log(event);
    const keys = event.keys;
    // console.log(keys);
    if (keys) {
      this.roleService.configMenu({id: this.currentRole.id, navigation_ids: keys})
        .subscribe(res => {

        })
    }
  }

}
