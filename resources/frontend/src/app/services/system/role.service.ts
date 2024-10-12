import {Injectable} from '@angular/core';
import {HttpReprint} from "../../utils/http-reprint";
import {BehaviorSubject, debounceTime, switchMap} from "rxjs";
import {Paginate} from "../../models/response";
import {Navigation, RegisterRouter, Role, SystemRouter} from "../../models/system";
import {
  ROLE_CONFIG_NAVIGATION,
  ROLE_CONFIG_ROUTER,
  ROLE_DELETE, ROLE_GET_NAVIGATION, ROLE_GET_ROUTER,
  ROLE_ITEMS,
  ROLE_SAVE,
  ROLE_SEARCH,
  ROLE_VIEW
} from "../../api/system.api";

@Injectable({
  providedIn: 'root'
})
export class RoleService {

  searchChange$ = new BehaviorSubject('');

  constructor(private http: HttpReprint) {
  }

  public items(page: number = 1, query: any = null) {
    return this.http.post<Paginate<Role>>(`${ROLE_ITEMS}?page=${page}`, query)
  }

  public view(id: number = 1) {
    return this.http.post<Role>(`${ROLE_VIEW}?id=${id}`)
  }

  public save(role: Role) {
    return this.http.post(ROLE_SAVE, role)
  }

  public delete(id: number | undefined) {
    return this.http.post(ROLE_DELETE, {id})
  }

  public configMenu(config: { id: number | undefined, navigation_ids: number[] | string[] }) {
    return this.http.post(ROLE_CONFIG_NAVIGATION, config)
  }

  public configRouter(config: { id: number | undefined; router_ids: number[] | string[] }) {
    return this.http.post(ROLE_CONFIG_ROUTER, config)
  }

  public getRouter(id: number | undefined) {
    return this.http.post<SystemRouter[]>(ROLE_GET_ROUTER, {id})
  }

  public getNavigation(id: number | undefined) {
    return this.http.post<Navigation[]>(ROLE_GET_NAVIGATION, {id})
  }

  public search(keyword: string) {
    return this.searchChange$
      .asObservable()
      .pipe(debounceTime(500))
      .pipe(switchMap(() => this.http.post<Paginate<Role>>(ROLE_SEARCH, {keyword})));
  }
}
