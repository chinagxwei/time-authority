import { Injectable } from '@angular/core';
import {HttpReprint} from "../../utils/http-reprint";
import {Paginate} from "../../models/response";
import {RegisterRouter, SystemRouter} from "../../models/system";
import {ROUTER_DELETE, ROUTER_ITEMS, ROUTER_REGISTERED, ROUTER_SAVE, ROUTER_SYSTEM_ITEM} from "../../api/system.api";


@Injectable({
  providedIn: 'root'
})
export class RouterService {

  constructor(private http: HttpReprint) {
  }

  public items(page: number = 1, query?: SystemRouter | { title: string }) {
    return this.http.post<Paginate<SystemRouter>>(`${ROUTER_ITEMS}?page=${page}`, query)
  }

  public systemRoute() {
    return this.http.post<RegisterRouter[]>(`${ROUTER_SYSTEM_ITEM}`)
  }

  public registeredRoute() {
    return this.http.post<SystemRouter[]>(`${ROUTER_REGISTERED}`)
  }

  public save(postData: SystemRouter) {
    return this.http.post(ROUTER_SAVE, postData)
  }

  public delete(id: number | undefined) {
    return this.http.post(ROUTER_DELETE, {id})
  }
}
