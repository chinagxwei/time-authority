import {Injectable} from "@angular/core";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {AuthService} from "../services/system/auth.service";
import {tap} from "rxjs";
import {ServerResponse} from "../models/response";

@Injectable({
  providedIn: 'root'
})
export class HttpReprint {

  httpOptions = {
    headers: new HttpHeaders({})
  };

  constructor(private http: HttpClient, private authService: AuthService) {
  }

  public setHeaders(name: string, value: string | string[]){
    this.httpOptions.headers = this.httpOptions.headers.set(name, value);
    return this;
  }

  public authorization(): HttpReprint {
    this.setHeaders('Authorization', `Bearer ${this.authService?.user?.access_token}`);
    return this;
  }

  public get<T>(url: string) {
    return this.authorization().http
      .get<ServerResponse<T>>(url, this.httpOptions)
      .pipe(tap(value => {

      }));
  }

  public post<T>(url: string, body?: any) {
    return this.authorization().http
      .post<ServerResponse<T>>(url, body, this.httpOptions)
      .pipe(tap(value => {

      }));
  }

}
