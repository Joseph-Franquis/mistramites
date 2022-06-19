import { Component, OnInit } from '@angular/core';
import { Publicacion } from '../publicacion';
import { PublicacionService } from '../publicacion.service';

@Component({
  selector: 'app-pub-ges',
  templateUrl: './pub-ges.component.html',
  styleUrls: ['./pub-ges.component.css']
})
export class PubGesComponent implements OnInit {

  public publicaciones: Publicacion [];
  public ultima_pub: Publicacion | undefined;
  public div_pub: any;
  public id_user: number;

  constructor(private PublicacionService: PublicacionService) {
    this.publicaciones = [];
    this.id_user = Number(localStorage.getItem("id_user"));
  }

  ngOnInit(): void {
    this.getPublicacionBD();
  }

  getPublicacionBD(): void {
    let id_user = Number(localStorage.getItem("id_user"))
    let id_session = String(localStorage.getItem("id_session"));
    let token = String(localStorage.getItem("token"));

    this.PublicacionService.getPublicacionIndexGestor(id_user, token, id_session)
    .subscribe(
      (publicaciones) =>{
        this.publicaciones = publicaciones;
        this.ultima_pub = this.publicaciones[0];
      }
    );

  }

}
