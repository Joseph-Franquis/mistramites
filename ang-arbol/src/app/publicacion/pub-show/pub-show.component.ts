import { Component, OnInit } from '@angular/core';
import { Publicacion } from '../publicacion';
import { PublicacionService } from '../publicacion.service';
import { ActivatedRoute } from '@angular/router';
import { Location } from '@angular/common';

@Component({
  selector: 'app-pub-show',
  templateUrl: './pub-show.component.html',
  styleUrls: ['./pub-show.component.css']
})
export class PubShowComponent implements OnInit {

  publicacion!: Publicacion;

  constructor(
      private PublicacionService: PublicacionService,
      private route: ActivatedRoute,
      private location: Location
    )
    {
  }

  ngOnInit(): void {
    const id = parseInt(this.route.snapshot.paramMap.get('id')!, 10);
    this.getPublicacionBD(id);

  }

  getPublicacionBD(id: number): void {
    this.PublicacionService.getPublicacionShow(id)
    .subscribe(publicacion => this.publicacion = publicacion);
  }

}
