import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { InicioComponent } from './inicio/inicio.component';
import { ConsultarComponent } from './consultar/consultar.component';
import { ContactoComponent } from './contacto/contacto.component';
import { ResumenComponent } from './resumen/resumen.component';
import { GraficoComponent } from './grafico/grafico.component';
import { LoginComponent } from './login/login.component';
import { AuthGuard } from './services/auth.guard';

const routes: Routes = [
  { path: '', redirectTo: '/inicio', pathMatch: 'full' },
  { path: 'inicio', component: InicioComponent },
  {
    path: 'consultar',
    component: ConsultarComponent,
    canActivate: [AuthGuard]
  },
  { path: 'contacto', component: ContactoComponent },
  {
    path: 'resumen',
    component: ResumenComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'grafico',
    component: GraficoComponent,
    canActivate: [AuthGuard]
  },
  { path: 'login', component: LoginComponent },

];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
