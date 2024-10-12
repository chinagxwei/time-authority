import {Component, OnInit} from '@angular/core';
import {Navigation, Role} from "../../../models/system";
import {Paginate} from "../../../models/response";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {TransferItem} from "ng-zorro-antd/transfer";
import {NzMessageService} from "ng-zorro-antd/message";
import {NzModalService} from "ng-zorro-antd/modal";
import {RoleService} from "../../../services/system/role.service";
import {NavigationService} from "../../../services/system/navigation.service";
import {NzTableQueryParams} from "ng-zorro-antd/table";
import {tap} from "rxjs";
import {ResponseCode} from "../../../utils/response-code";

@Component({
  selector: 'app-role',
  templateUrl: './role.component.html',
  styleUrls: ['./role.component.css']
})
export class RoleComponent implements OnInit {

  currentData: Paginate<Role> = new Paginate<Role>();

  loading = true;

  listOfData: Role[] = [];

  isAddVisible = false;

  isConfigVisible = false;

  isConfigRouterVisible = false;

  validateForm: FormGroup;

  list: TransferItem[] = [];

  allMenu: Navigation[] = [];

  currentRole: Role = new Role();

  constructor(
    private formBuilder: FormBuilder,
    private message: NzMessageService,
    private modalService: NzModalService,
    private roleService: RoleService,
    private navigationService: NavigationService
  ) {
    this.validateForm = this.formBuilder.group({});
  }

  ngOnInit(): void {
    this.getItems();
    this.getAllMenu()
  }

  private getAllMenu() {
    this.navigationService.all()
      .subscribe(({code, data}) => {
        if (code === 0) {
          this.allMenu = data ?? [];
        }
      })
  }

  add() {
    // this.validateForm.reset();
    this.initForm();
    this.showModal();
  }

  showModal(): void {
    this.isAddVisible = true;
  }

  handleCancel() {
    this.isAddVisible = false;
  }

  showModal2(data: Role): void {
    this.currentRole = data;
    this.isConfigVisible = true;
    // this.roleService.view(data.id).subscribe(({code, data}) => {
    //   if (code === 0) {
    //     this.currentConfig = data;
    //     this.list = [];
    //     this.allMenu.forEach(v => {
    //       const direction = this.currentConfig?.navigations?.find(v2 => v.id === v2.id) ? 'right' : undefined;
    //       this.list.push({
    //         key: v.id,
    //         title: v.navigation_name,
    //         description: v.navigation_name,
    //         direction: direction
    //       });
    //     })
    //     this.isConfigVisible = true;
    //   }
    // })
  }

  showConfigRouter(data: Role){
    this.currentRole = data;
    this.isConfigRouterVisible = true;
  }

  handleCancel2() {
    this.isConfigVisible = false;
  }

  handleOk() {
    this.submitForm();
  }

  update(data: Role) {
    this.validateForm = this.formBuilder.group({
      id: [data.id],
      role_name: [data.role_name, [Validators.required]],
    });
    this.showModal()
  }

  onDelete(data: Role) {
    this.modalService.confirm({
      nzTitle: '删除提示',
      nzContent: '<b style="color: red;">是否删除该项数据!</b>',
      nzOkText: '确定',
      nzCancelText: '取消',
      nzOnOk: () => {
        this.roleService.delete(data.id).subscribe(res => {
          this.getItems(this.currentData.current_page);
        });
      },
      nzOnCancel: () => {
        console.log('Cancel')
      }
    });
  }

  onQueryParamsChange(params: NzTableQueryParams) {
    this.getItems(params.pageIndex)
  }

  private initForm() {
    this.validateForm = this.formBuilder.group({
      id: [null],
      role_name: [null, [Validators.required]],
    });
  }

  private getItems(page: number = 1) {
    this.loading = true;
    this.roleService.items(page)
      .pipe(tap(_ => this.loading = false))
      .subscribe(res => {
        const {data} = res;
        if (data) {
          this.currentData = data;
          this.listOfData = data.data;
        }
      })
  }

  private submitForm() {
    if (this.validateForm.valid) {
      this.roleService.save(this.validateForm.value).subscribe(res => {
        console.log(res);
        if (res.code === ResponseCode.RESPONSE_SUCCESS) {
          this.message.success(res.message);
          this.handleCancel();
          this.validateForm.reset();
          this.getItems(this.currentData.current_page);
        }
      });
    } else {
      Object.values(this.validateForm.controls).forEach((control) => {
        // @ts-ignore
        if (control.invalid) {
          // @ts-ignore
          control.markAsDirty();
          // @ts-ignore
          control.updateValueAndValidity({onlySelf: true});
        }
      });
    }
  }

  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  filterOption(inputValue: string, item: any): boolean {
    return item.description.indexOf(inputValue) > -1;
  }

  search(ret: {}): void {
    console.log('nzSearchChange', ret);
  }

  change(ret: { from: string, list: TransferItem[], to: string }): void {
    // // @ts-ignore
    // const m = ret.list.map(v => v.key);
    // const type = (ret.from === 'left' && ret.to === 'right') ? 1 : 0;
    // // @ts-ignore
    // this.roleService.configMenu({role: this.currentConfig?.id, menus: m, type})
    //   .subscribe(res => {
    //     console.log(res);
    //   });
  }
}
