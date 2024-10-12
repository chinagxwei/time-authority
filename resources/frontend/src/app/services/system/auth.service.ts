import { Injectable } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {NavigationExtras, Router} from "@angular/router";
import {ServerResponse} from "../../models/response";
import {User} from "../../models/user";
import * as moment from "moment";
import {ResponseCode} from "../../utils/response-code";
import {USER_LOGIN} from "../../api/auth.api";
import {map} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class AuthService {


  public user?: User;
  public redirectUrl: string = "";
  public defaultUrl = '/system'

  constructor(private http: HttpClient, private router: Router) {
    const dataStr = window.localStorage.getItem('backend_authorized');
    if (dataStr && dataStr?.length > 0) {
      this.user = JSON.parse(dataStr) as User;
    }
  }

  get isExpiresIn(): boolean {
    return this.user ? this.user.expires_in > moment().unix() : false;
  }

  get isLogin(): boolean {
    return !!this.user;
  }

  public login(postData: any) {
    return this.http.post<ServerResponse<User>>(USER_LOGIN, postData)
      .pipe(map(res => {
        if (res.code === ResponseCode.RESPONSE_SUCCESS) {
          this.user = res.data
          this.initLogin()
          return {type: true, msg: res.message};
        }
        return {type: false, msg: res.message};
      }))
  }

  public logout() {
    const navigationExtras: NavigationExtras = {
      queryParams: {type: 'logout'},
    };
    this.user = undefined;
    window.localStorage.removeItem('backend_authorized');
    this.router.navigate(['/login'], navigationExtras);
  }

  private initLogin() {
    if (this.user) {
      if (this.isExpiresIn) {
        window.localStorage.setItem('backend_authorized', JSON.stringify(this.user));
        this.toHome();
      } else {
        this.logout();
      }
    }
  }

  public toHome() {
    const redirect = this.redirectUrl ? this.router.parseUrl(this.redirectUrl) : this.defaultUrl;
    const navigationExtras: NavigationExtras = {
      queryParamsHandling: 'preserve',
      preserveFragment: true
    };
    this.router.navigateByUrl(redirect, navigationExtras);
  }
}
