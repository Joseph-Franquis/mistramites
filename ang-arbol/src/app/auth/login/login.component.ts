import { Component, OnInit } from '@angular/core';
import { Location } from '@angular/common';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from '../auth.service';
import * as CryptoJS from 'crypto-js';
import { UsuarioLogin } from '../usuario';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  public formRegister!: FormGroup;
  public usuario!: UsuarioLogin;
  public router!: Router;

  constructor(
    private FormBuilder: FormBuilder,
    private AuthService: AuthService,
    private location: Location,
  ) {
  }

  ngOnInit(): void {
    this.formRegister = this.FormBuilder.group(
      {
        correo: ["", [Validators.required, Validators.email]],
        password: ["", [Validators.required]],
      }
    )
  }

  send(): void{
    //guardamos el formualrio en el modelo usuario
    this.usuario = this.formRegister.value;
    //el token lo pasamos a un objeto para poder usarlo
    let token  =  ""+localStorage.getItem("token");
    //guardamos el token en el modelo para enviarlo
    this.usuario.token = token;

    let id_session  =  ""+localStorage.getItem("id_session");
    //guardamos el token en el modelo para enviarlo
    this.usuario.id_session = id_session;
    //encripatamos el password
    // this.usuario.password = this.cryptoar(this.usuario.password, token.token);
    //hacemos la peticion contra backend

    this.AuthService.LoginUsuario(this.usuario).subscribe(function (request) {
      console.log(request);
      localStorage.setItem("rol", request.rol);
      localStorage.setItem("id_user", request.rol);
      localStorage.setItem("token", request.token);
    }
    );
    this.location.go("home");
  }

}
