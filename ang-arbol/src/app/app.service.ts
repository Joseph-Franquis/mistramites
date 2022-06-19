import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, of } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AppService {

  private url = 'http://127.0.0.5/api/';  // URL to web api

  httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };

  constructor(
    private http: HttpClient
  ) {}

  // public getToken(): Observable<string> {
  //   let url_token = this.url + "token";
  //   return this.http.get<string>(url_token);
  // }

  public getIdSesion(): Observable<string> {
    let url_session = this.url + "user/session";
    return this.http.get<string>(url_session);
  }

  public getToken(id_sesion: any[]): Observable<string> {
    let url_token = this.url + "app/token";
    return this.http.post<string>(url_token, id_sesion, this.httpOptions).pipe();
  }

  public restoreSesion(id_sesion: any[]): Observable<string> {
    let url_token = this.url + "user/restoreSession";
    return this.http.post<string>(url_token, id_sesion, this.httpOptions).pipe();
  }

}
