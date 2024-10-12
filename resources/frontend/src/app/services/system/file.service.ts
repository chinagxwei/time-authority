import { Injectable } from '@angular/core';
import {HttpReprint} from "../../utils/http-reprint";
import {Paginate} from "../../models/response";
import {SystemFile} from "../../models/system";
import {IMAGE_DELETE, IMAGE_LISTS, IMAGE_SAVE} from "../../api/system.api";

@Injectable({
  providedIn: 'root'
})
export class FileService {
  constructor(private http: HttpReprint) {
  }

  public items(page: number = 1) {
    return this.http.post<Paginate<SystemFile>>(`${IMAGE_LISTS}?page=${page}`)
  }

  public save(postData: SystemFile) {
    return this.http.post(IMAGE_SAVE, postData)
  }

  public delete(id: number | undefined) {
    return this.http.post(IMAGE_DELETE, {id})
  }
}
