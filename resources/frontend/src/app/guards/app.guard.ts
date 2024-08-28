import {CanActivateFn, NavigationExtras, Router} from '@angular/router';
import {inject} from "@angular/core";
import {Observable} from "rxjs";

export const appGuard: CanActivateFn = (route, state) => {
  // const authService = inject(AuthService);
  const router = inject(Router);

  // if (authService.isLogin && authService.isExpiresIn){
  //   return new Observable<boolean>(subscriber => {
  //     subscriber.next(true);
  //     subscriber.complete();
  //   });
  // }

  const navigationExtras: NavigationExtras = {
    queryParams: {type: 'login'},
  };

  router.navigate(['/login'], navigationExtras);

  return new Observable<boolean>(subscriber => {
    subscriber.next(false);
    subscriber.complete();
  });
};
