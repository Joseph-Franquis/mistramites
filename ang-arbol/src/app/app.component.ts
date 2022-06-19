import { Component } from '@angular/core';
import { AppService } from './app.service'

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'ang-arbol';

  constructor(
    private AppService: AppService
  ){

  }

  ngOnInit(): void {
    //this code is for save token in localStorage
    let id_session = localStorage.getItem("id_session");
    if(id_session != null){
      let params: any = { id_session: id_session };
      this.AppService.getToken(params).subscribe(respuesta =>{ localStorage.setItem("token",respuesta) });
    }else{
      this.AppService.getIdSesion().subscribe(respuesta =>{ localStorage.setItem("id_session",respuesta);
        let id_session = String(localStorage.getItem("id_session"));
        let params: any = { id_session: id_session };
        this.AppService.getToken(params).subscribe(respuesta =>{ localStorage.setItem("token",respuesta) });
      });
    }


  }
}
