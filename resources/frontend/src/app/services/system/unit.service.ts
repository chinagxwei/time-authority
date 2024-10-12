import { Injectable } from '@angular/core';
import {HttpReprint} from "../../utils/http-reprint";
import {Paginate} from "../../models/response";
import {UNIT_DELETE, UNIT_LIST, UNIT_SAVE, UNIT_VIEW} from "../../api/system.api";
import {Unit} from "../../models/system";

@Injectable({
  providedIn: 'root'
})
export class UnitService {
  constructor(private http: HttpReprint) {
  }

  public items(page: number = 1, query?: Unit | { title: string }) {
    return this.http.post<Paginate<Unit>>(`${UNIT_LIST}?page=${page}`, query)
  }

  public save(postData: Unit) {
    return this.http.post(UNIT_SAVE, postData)
  }

  public view(id: number) {
    return this.http.post<Unit>(UNIT_VIEW, {id})
  }

  public delete(id: number | undefined) {
    return this.http.post(UNIT_DELETE, {id})
  }
}
