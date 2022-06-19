import { Injectable } from '@angular/core';

import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';

import { Observable, of } from 'rxjs';
// import { catchError, map, tap } from 'rxjs/operators';


import { Publicacion } from './publicacion';

@Injectable({ providedIn: 'root' })
export class PublicacionService {

  private heroesUrl = 'http://127.0.0.5/api/publicaciones';  // URL to web api

  httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };

  constructor(
    private http: HttpClient,
  ) {}

    /** GET heroes from the server */
    getPublicacionIndex(): Observable<Publicacion[]> {
      return this.http.get<Publicacion[]>(this.heroesUrl);
    }

    getPublicacionIndexGestor(id_user: number, token: string, id_session: string): Observable<Publicacion[]> {
      let params = new HttpParams().set("id_user",id_user).set("token", token).set("id_session", id_session); //Create new HttpParams
      return this.http.get<Publicacion[]>(this.heroesUrl + "/gestion", {
        params: params
      });
    }
    getPublicacionBuscador(texto: string, etiquetas: string): Observable<Publicacion[]> {
      let params = new HttpParams().set("texto",texto).set("etiquetas", etiquetas); //Create new HttpParams
      return this.http.get<Publicacion[]>(this.heroesUrl + "/buscar", {
        params: params
      });
    }

    getPublicacionShow(id: number): Observable<Publicacion> {
      return this.http.get<Publicacion>(this.heroesUrl+"/"+id);
    }

    getPublicacionStore(): Observable<Publicacion> {
      return this.http.get<Publicacion>(this.heroesUrl);
    }
    getPublicacionUpdate(): Observable<Publicacion> {
      return this.http.get<Publicacion>(this.heroesUrl);
    }
    getPublicacionDestroy(): Observable<Publicacion> {
      return this.http.get<Publicacion>(this.heroesUrl);
    }

    getEtiquetas(): Observable<Publicacion> {
      return this.http.get<Publicacion>("http://127.0.0.5/api/etiquetas");
    }


}
