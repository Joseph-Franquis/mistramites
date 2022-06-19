import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';

import { AppComponent } from './app.component';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { HomeComponent } from './home/home.component';
import { PublicacionComponent } from './publicacion/pub-list/publicacion.component';
import { HttpClientModule, HttpParams } from '@angular/common/http';
import { LoginComponent } from './auth/login/login.component';
import { RegisterComponent } from './auth/register/register.component';
import { PubShowComponent } from './publicacion/pub-show/pub-show.component';
import { ReactiveFormsModule } from '@angular/forms';
import { PubStoreComponent } from './publicacion/pub-store/pub-store.component';
import { PubGesComponent } from './publicacion/pub-ges/pub-ges.component';
import { PerfilComponent } from './usuario/perfil/perfil.component';
import { ReportesComponent } from './usuario/reportes/reportes.component';
import { ReportaComponent } from './usuario/reporta/reporta.component';


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    HomeComponent,
    PublicacionComponent,
    LoginComponent,
    RegisterComponent,
    PubShowComponent,
    PubStoreComponent,
    PubGesComponent,
    PerfilComponent,
    ReportesComponent,
    ReportaComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    ReactiveFormsModule,
  ],
  providers: [HttpParams],
  bootstrap: [AppComponent]
})
export class AppModule { }
