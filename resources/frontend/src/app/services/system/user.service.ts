import { Injectable } from '@angular/core';
import {USER_SIMPLE_INFO} from "../../api/auth.api";
import {ACTION_LOG} from "../../api/system.api";
import {Paginate} from "../../models/response";
import {ActionLog, AdminInformation} from "../../models/user";
import {HttpReprint} from "../../utils/http-reprint";

@Injectable({
  providedIn: 'root'
})
export class UserService {

  constructor(private http: HttpReprint) { }

  public info(){
    return this.http.get<AdminInformation>(USER_SIMPLE_INFO)
  }

  public actionLog(page: number = 1) {
    return this.http.post<Paginate<ActionLog>>(`${ACTION_LOG}?page=${page}`)
  }
}
