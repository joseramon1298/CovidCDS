import { Component } from '@angular/core';
import { AuthService } from '../services/auth.service';
import { UserService } from '../services/user.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  userData: any;

  constructor(private authService: AuthService, private userService: UserService) { }

  loginWithGoogle() {
    this.authService.googleAuth().then(() => {
      // Una vez que se haya iniciado sesión correctamente, se asignan los datos del usuario al servicio
      this.authService.getStateUser().subscribe(user => {
        this.userService.setUserData(user);
        this.userData = user;
      });
    });
  }

  logout() {
    this.authService.logout();
    this.userData = null;
  }
}
