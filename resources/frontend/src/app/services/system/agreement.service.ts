import { Injectable } from '@angular/core';
import {HttpReprint} from "../../utils/http-reprint";
import {SystemAgreement} from "../../models/system";
import {Paginate} from "../../models/response";
import {AGREEMENT_DELETE, AGREEMENT_ITEMS, AGREEMENT_SAVE, AGREEMENT_VIEW} from "../../api/system.api";

@Injectable({
  providedIn: 'root'
})
export class AgreementService {
  constructor(private http: HttpReprint) {
  }

  public items(page: number = 1, query?: SystemAgreement) {
    return this.http.post<Paginate<SystemAgreement>>(`${AGREEMENT_ITEMS}?page=${page}`, query)
  }

  public save(postData: SystemAgreement) {
    return this.http.post(AGREEMENT_SAVE, postData)
  }

  public view(id: number) {
    return this.http.post<SystemAgreement>(AGREEMENT_VIEW, {id})
  }

  public delete(id: number | undefined) {
    return this.http.post(AGREEMENT_DELETE, {id})
  }
}
