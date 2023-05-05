import { Component, OnInit } from '@angular/core';
import { AuthService } from './services/auth.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  userData: any;

  constructor(private authService: AuthService) {}

  ngOnInit() {
    this.authService.getStateUser().subscribe(user => {
      this.userData = user;
    });
  }

  logout() {
    this.authService.logout();
    this.userData = null;
  }
}
