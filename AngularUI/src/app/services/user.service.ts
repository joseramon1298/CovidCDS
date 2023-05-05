import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  private userDataSubject = new BehaviorSubject(null);
  public userData$ = this.userDataSubject.asObservable();

  setUserData(userData: any) {
    this.userDataSubject.next(userData);
  }
}
