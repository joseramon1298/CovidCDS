import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { ContactoComponent } from './contacto/contacto.component';
import { ResumenComponent } from './resumen/resumen.component';
import { GraficoComponent } from './grafico/grafico.component';
import { ConsultarComponent } from './consultar/consultar.component';
import { InicioComponent } from './inicio/inicio.component';
import { LoginComponent } from './login/login.component';

import { AngularFireModule } from '@angular/fire/compat';
import { AngularFireAuthModule } from '@angular/fire/compat/auth';
import { environment } from 'environments/environment';



@NgModule({
  declarations: [
    AppComponent,
    ContactoComponent,
    ResumenComponent,
    GraficoComponent,
    ConsultarComponent,
    InicioComponent,
    LoginComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    AngularFireModule.initializeApp(environment.firebaseConfig),
    AngularFireAuthModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
