import { Component, OnInit } from '@angular/core';
import { Publicacion } from '../publicacion';
import { PublicacionService } from '../publicacion.service';

@Component({
  selector: 'app-pub-store',
  templateUrl: './pub-store.component.html',
  styleUrls: ['./pub-store.component.css']
})
export class PubStoreComponent implements OnInit {

  public publicaciones: Publicacion [];
  div_pub: any;


  constructor(private PublicacionService: PublicacionService) {
    this.publicaciones = [];
   }

  ngOnInit() {
    this.getPublicacionBD();
  }

  // funcion para cambiar abrir la publicacion al oprimir en ella
  ngAfterContentChecked(){
  }

  getPublicacionBD(): void {
    let id_user = Number(localStorage.getItem("id_user"))
    let id_session = String(localStorage.getItem("id_session"));
    let token = String(localStorage.getItem("token"));

    this.PublicacionService.getPublicacionIndexGestor(id_user, token, id_session)
    .subscribe(publicaciones => this.publicaciones = publicaciones);

  }

}
