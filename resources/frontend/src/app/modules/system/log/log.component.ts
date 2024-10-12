import {Component, OnInit} from '@angular/core';
import {ActionLog} from "../../../models/user";
import {Paginate} from "../../../models/response";
import {UserService} from "../../../services/system/user.service";
import {NzTableQueryParams} from "ng-zorro-antd/table";
import {tap} from "rxjs";

@Component({
  selector: 'app-log',
  templateUrl: './log.component.html',
  styleUrls: ['./log.component.css']
})
export class LogComponent implements OnInit {


  currentData: Paginate<ActionLog> = new Paginate<ActionLog>();

  loading = true;

  listOfData: ActionLog[] = [];

  constructor(
    private componentService: UserService,
  ) { }

  ngOnInit(): void {
    this.getItems();
  }

  onQueryParamsChange($event: NzTableQueryParams) {
    this.getItems($event.pageIndex);
  }

  private getItems(page: number = 1) {
    this.loading = true;
    this.componentService.actionLog(page)
      .pipe(tap(_ => this.loading = false))
      .subscribe(res => {
        const {data} = res;
        if (data) {
          this.currentData = data;
          this.listOfData = data.data;
        }
      })
  }
}
