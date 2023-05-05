import { Injectable } from '@angular/core';
import { AngularFireAuth } from '@angular/fire/compat/auth';
import { Router } from '@angular/router';
import { GoogleAuthProvider } from '@firebase/auth';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private auth: AngularFireAuth, private router: Router) { }

  googleAuth(){
    return this.authLogin(new GoogleAuthProvider())
  }

  authLogin(provider: any){
    return this.auth.signInWithPopup(provider).then(result => {
      console.log('success login', result);
    }).catch((error) => {
      console.log(error);
    });
  }

  async logout(){
    this.auth.signOut();
  }

  isLoggedIn(): boolean {
    return !!this.auth.currentUser;
  }
  getStateUser(){
    return this.auth.authState;
  }
}
