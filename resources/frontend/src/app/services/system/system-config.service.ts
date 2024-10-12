import { Injectable } from '@angular/core';
import {HttpReprint} from "../../utils/http-reprint";
import {Paginate} from "../../models/response";
import {SystemConfig} from "../../models/system";
import {CONFIG_DELETE, CONFIG_ITEMS, CONFIG_SAVE} from "../../api/system.api";

@Injectable({
  providedIn: 'root'
})
export class SystemConfigService {

  constructor(private http: HttpReprint) {
  }

  public items(page: number = 1) {
    return this.http.post<Paginate<SystemConfig>>(`${CONFIG_ITEMS}?page=${page}`)
  }

  public save(postData: SystemConfig | { key: string, value: string }) {
    return this.http.post(CONFIG_SAVE, postData)
  }

  public delete(id: number | undefined) {
    return this.http.post(CONFIG_DELETE, {id})
  }
}
