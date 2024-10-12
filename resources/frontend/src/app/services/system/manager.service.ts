import {Injectable} from '@angular/core';
import {HttpReprint} from "../../utils/http-reprint";
import {MANAGER_DELETE, MANAGER_INFO, MANAGER_ITEMS, MANAGER_SAVE, MANAGER_VIEW} from "../../api/system.api";
import {USER_RESET_PASSWORD} from "../../api/auth.api";
import {
  AdminInformation,
  AuthenticationRequest,
  ResetPasswordRequest,
  ServerManager,
  UpdateUserInfoRequest
} from "../../models/user";

@Injectable({
  providedIn: 'root'
})
export class ManagerService {

  constructor(private http: HttpReprint) {
  }

  public items<T>(page: number = 1) {
    return this.http.post<T>(`${MANAGER_ITEMS}?page=${page}`)
  }

  public save(user: AuthenticationRequest | UpdateUserInfoRequest) {
    return this.http.post(MANAGER_SAVE, user)
  }

  public view(id: number) {
    return this.http.post<ServerManager>(MANAGER_VIEW, {id})
  }

  public delete(id: number) {
    return this.http.post(MANAGER_DELETE, {id})
  }

  public resetPassword(reset: ResetPasswordRequest) {
    return this.http.post(`${USER_RESET_PASSWORD}`, reset)
  }

  public info() {
    return this.http.get<AdminInformation>(MANAGER_INFO)
  }
}
