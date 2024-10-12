import { Injectable } from '@angular/core';
import {HttpReprint} from "../../utils/http-reprint";
import {SystemComplaint} from "../../models/system";
import {Paginate} from "../../models/response";
import {COMPLAINT_DELETE, COMPLAINT_ITEMS, COMPLAINT_SAVE, COMPLAINT_VIEW} from "../../api/system.api";

@Injectable({
  providedIn: 'root'
})
export class ComplaintService {
  constructor(private http: HttpReprint) {
  }

  public items(page: number = 1, query?: SystemComplaint) {
    return this.http.post<Paginate<SystemComplaint>>(`${COMPLAINT_ITEMS}?page=${page}`, query)
  }

  public save(postData: SystemComplaint) {
    return this.http.post(COMPLAINT_SAVE, postData)
  }

  public view(id: number) {
    return this.http.post<SystemComplaint>(COMPLAINT_VIEW, {id})
  }

  public delete(id: number | undefined) {
    return this.http.post(COMPLAINT_DELETE, {id})
  }
}
