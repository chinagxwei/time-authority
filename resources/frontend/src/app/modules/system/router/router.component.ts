import {Component, OnInit} from '@angular/core';
import {Paginate} from "../../../models/response";
import {RegisterRouter, SystemRouter} from "../../../models/system";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {NzMessageService} from "ng-zorro-antd/message";
import {NzModalService} from "ng-zorro-antd/modal";
import {RouterService} from "../../../services/system/router.service";
import {NzTableQueryParams} from "ng-zorro-antd/table";
import {tap} from "rxjs";
import {ResponseCode} from "../../../utils/response-code";

@Component({
  selector: 'app-router',
  templateUrl: './router.component.html',
  styleUrls: ['./router.component.css']
})
export class RouterComponent implements OnInit {

  currentData: Paginate<SystemRouter> = new Paginate<SystemRouter>();

  loading = true;

  listOfData: SystemRouter[] = [];

  registerList: RegisterRouter[] | undefined = []

  validateForm: FormGroup;

  isVisible: boolean = false;

  constructor(
    private formBuilder: FormBuilder,
    private message: NzMessageService,
    private modalService: NzModalService,
    private componentService: RouterService
  ) {
    this.validateForm = this.formBuilder.group({});
  }

  ngOnInit(): void {
    this.initForm();
    this.getItems();
    this.getRegisteredRoute();
  }


  onQueryParamsChange($event: NzTableQueryParams) {
    this.getItems($event.pageIndex);
  }

  private getItems(page: number = 1) {
    this.loading = true;
    this.componentService.items(page)
      .pipe(tap(_ => this.loading = false))
      .subscribe(res => {
        const {data} = res;
        if (data) {
          this.currentData = data;
          this.listOfData = data.data;
        }
      })
  }

  private getRegisteredRoute() {
    this.componentService.systemRoute().subscribe(res => {
      console.log(res)
      if (res.code === ResponseCode.RESPONSE_SUCCESS){
        this.registerList = res.data;
      }
    })
  }

  initForm() {
    this.validateForm = this.formBuilder.group({
      router_name: [null, [Validators.required]],
      router: [null, [Validators.required]],
    });
  }

  update(data: SystemRouter) {
    this.validateForm = this.formBuilder.group({
      id: [data.id],
      router_name: [data.router_name, [Validators.required]],
      router: [data.router, [Validators.required]],
    });
    this.showModal()
  }

  onDelete($event: SystemRouter) {

    this.modalService.confirm({
      nzTitle: '删除提示',
      nzContent: '<b style="color: red;">是否删除该项数据!</b>',
      nzOkText: '确定',
      nzCancelText: '取消',
      nzOnOk: () => {

        this.componentService.delete($event.id).subscribe(res => {
          this.getItems(this.currentData.current_page);
        });
      },
      nzOnCancel: () => {
        console.log('Cancel')
      }
    });
  }

  add() {
    this.validateForm.reset();
    this.showModal();
  }

  showModal(): void {
    this.isVisible = true;
  }

  handleCancel() {
    this.isVisible = false;
  }

  handleOk() {
    this.submitForm();
  }

  submitForm() {
    if (this.validateForm.valid) {
      this.componentService.save(this.validateForm.value).subscribe(res => {
        console.log(res);
        if (res.code === ResponseCode.RESPONSE_SUCCESS) {
          this.message.success(res.message);
          this.handleCancel();
          this.getItems(this.currentData.current_page);
        }
      });
    } else {
      Object.values(this.validateForm.controls).forEach(control => {
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

}
