import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './auth/login/login.component';
import { RegisterComponent } from './auth/register/register.component';
import { HomeComponent } from './home/home.component';
import { PubGesComponent } from './publicacion/pub-ges/pub-ges.component';
import { PublicacionComponent } from './publicacion/pub-list/publicacion.component';
import { PubShowComponent } from './publicacion/pub-show/pub-show.component';
import { PubStoreComponent } from './publicacion/pub-store/pub-store.component';
import { PerfilComponent } from './usuario/perfil/perfil.component';
import { ReportesComponent } from './usuario/reportes/reportes.component';


//poner de ultimo lo que aceptan parametros
const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'publicacion', component: PublicacionComponent },
  { path: 'publicacion/gestion', component: PubGesComponent },
  { path: 'publicacion/crear', component: PubStoreComponent },
  { path: 'publicacion/:id', component: PubShowComponent },
  { path: 'reporte/gestion', component: ReportesComponent },
  { path: 'reporte/:id', component: ReportesComponent },
  { path: 'usuario/perfil/:id', component: PerfilComponent },
  // { path: 'publicacion/actualizae/:id', component: RegisterComponent },
  // { path: 'publicacion/crea', component: RegisterComponent },
  { path: 'auth/iniciosesion', component: LoginComponent },
  { path: 'auth/registro', component: RegisterComponent },


];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
