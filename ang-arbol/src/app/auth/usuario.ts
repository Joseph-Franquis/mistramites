export interface UsuarioRegis {
  usuario: string;
  nombre: string;
  correo: string;
  password: string;
  token: string;
  id_session: string;
}

export interface UsuarioLogin {
  correo: string;
  password: string;
  token: string;
  id_session: string;
}

export interface UsuarioLoged {
  correo: string;
  password: string;
  token: string;
}
