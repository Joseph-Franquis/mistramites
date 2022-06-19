import { Component, OnInit, Directive, OnChanges } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})

export class HeaderComponent implements OnInit {

  //variable to save the current path
  public router: Router;

  public rol: any;
  public id: any;
  //
  rutas_nav = [
    {
    "name": "Inicio",
    "ruta": "/"
    },
    {
      "name": "Buscar",
      "ruta": "/publicacion"
    }
  ];

  rutas_user = [
    {
      name: "Inicio Sesion",
      ruta: "auth/iniciosesion",
      rol: [5, ]
    },
    {
      name: "Registrate",
      ruta: "auth/registro",
      rol: [5, ]
    },
    {
      name: "Gestion de Publicaciones",
      ruta: "publicacion/gestion",
      rol: [1, 3]
    },
    {
      name: "Gestion de Usuarios",
      ruta: "usuarios/gestion",
      rol: [1, 2]
    },
    {
      name: "Perfil",
      ruta: "usuario/perfil",
      rol: [1, 2, 3 , 4]
    }
  ];
  enlaces: Array<object>;

  constructor(router: Router ) {
    this.router = router;
    this.enlaces = [];
    let logged = localStorage.getItem("rol");
    if(logged != null){
      this.rol = Number(logged);
    }else{
      this.rol = 5;
    }
  }

  ngOnInit(): void {
    // this.MenuUser();
    let logged = localStorage.getItem("rol");
    if(logged != null){
      this.rol = Number(logged);
      this.id = localStorage.getItem("id_user");
      console.log(this.id, this.rutas_user[0]);
      this.rutas_user[4].ruta += "/"+ this.id;
    }
  }


  ngAfterContentChecked(): void{

  }

  toggleMenuUser(): void{
    document.querySelector('.menu-user-shadow')?.classList.toggle('desac');
    document.querySelector('.menu-user')?.classList.toggle('desac');
  }

  // MenuUser():void {
  //   let contendor = document.querySelector(".menu-user");
  //   this.rutas_user.forEach(element => {
  //     let li = document.createElement("li");
  //     li.classList.add("enlace-list");
  //     let a = document.createElement("a");
  //     a.classList.add("enlace");
  //     a.href = element.ruta
  //     a.innerText = element.name
  //     contendor?.appendChild(li);
  //     li.appendChild(a);
  //     console.log(element);
  //   });
  // }
}

