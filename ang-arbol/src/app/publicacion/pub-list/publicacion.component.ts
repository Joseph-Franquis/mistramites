import { Component, Input, OnInit } from '@angular/core';
import {Router} from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Publicacion } from '../publicacion';
import { PublicacionService } from '../publicacion.service';


@Component({
  selector: 'app-publicacion',
  templateUrl: './publicacion.component.html',
  styleUrls: ['./publicacion.component.css']
})
export class PublicacionComponent implements OnInit {

  public publicaciones: Publicacion [];
  public formSearch!: FormGroup;
  public etiquetas: any;
  public buscador: any;


  constructor(
    private PublicacionService: PublicacionService,
    private FormBuilder: FormBuilder,
    private router: Router
    ) {
    this.publicaciones = [];
    this.formSearch = this.FormBuilder.group(
      {
        texto: ["", [Validators.required]],
        etiqueta: ["", [Validators.required]],
      }
    )
   }

  ngOnInit() {
    this.getEtiquetas();
    this.getPublicacionBD();
  }

  // funcion para cambiar abrir la publicacion al oprimir en ella
  ngAfterContentChecked(){

  }

  getPublicacionBD(): void {
    this.PublicacionService.getPublicacionIndex()
    .subscribe(publicaciones => this.publicaciones = publicaciones);
  }

  getPublicacionBuscador(texto: string, etiquetas: string): void {
    this.PublicacionService.getPublicacionBuscador(texto,etiquetas)
    .subscribe(publicaciones => this.publicaciones = publicaciones);
  }

  getEtiquetas(): void {
    this.PublicacionService.getEtiquetas()
    .subscribe(etiquetas => this.etiquetas = etiquetas);
    console.log(this.etiquetas);
  }

  buscarPublicacion(){
    this.publicaciones = [];
    let etiquetas_act = document.querySelectorAll(".eti-act *");
    let etiquetas ="";
    etiquetas_act.forEach(element => {
      if(element.tagName == "INPUT"){
        let input = <HTMLInputElement> element;
        etiquetas += input.value + ",";
      }
    })
    this.getPublicacionBuscador(this.formSearch.value.texto, etiquetas);
  }

  verPublicacion(id: Number){
    this.router.navigate(['publicacion/'+id])
  }

  agregarEtiquetas(){
    let etiquetas = document.querySelector(".eti-act");
    let etiquetas_sel = document.querySelectorAll(".etiquetas-sel *");
    let etiquetas_act = document.querySelectorAll(".eti-act *");
    let id = this.formSearch.value.etiqueta;
    if(etiquetas_act.length == 0){

      let div = document.createElement("div");
      // div.classList.add("etiqueta");
      div.addEventListener("click", function name() {
        this.remove();

      });
      let etiqueta = document.createElement("input");
      let span = document.createElement("span");

      etiquetas_sel.forEach(element => {
        let input = <HTMLInputElement> element;
        if(input.value == this.formSearch.value.etiqueta){
          span.innerText = input.innerText;
        }
      });

      etiqueta.value = this.formSearch.value.etiqueta;
      etiqueta.type = "hidden";

      etiquetas?.appendChild(div);
      span.classList.add("badge");
      span.classList.add("bg-info");

      div.appendChild(span);
      div.appendChild(etiqueta);

    }else{
      let bool = true;
      etiquetas_act.forEach(element => {
        if(element.tagName == "INPUT"){
          let input = <HTMLInputElement> element;
          if(input.value == this.formSearch.value.etiqueta){
            bool = false;
          }else{
             if(input.value && bool){
              let div = document.createElement("div");
              div.addEventListener("click", function name() {
                this.remove();
              });
              let etiqueta = document.createElement("input");
              let span = document.createElement("span");

              etiquetas_sel.forEach(element => {
                let input = <HTMLInputElement> element;
                if(input.value == this.formSearch.value.etiqueta){
                  span.innerText = input.innerText;
                }
              });

              etiqueta.value = this.formSearch.value.etiqueta;
              etiqueta.type = "hidden";

              span.classList.add("badge");
              span.classList.add("bg-info");

              etiquetas?.appendChild(div);

              div.appendChild(span);
              div.appendChild(etiqueta);
              bool = false;
            }
          }
        }
      });
    }
    this.buscarPublicacion();

  }

}
