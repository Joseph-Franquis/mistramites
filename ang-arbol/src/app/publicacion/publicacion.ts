export interface Publicacion {
  id: number;
  titulo: string;
  contenido: string;
  usuario: string;
  estado: string;
  creado: Date;
  actualizado: Date;
}

export interface PublicacionStore {
  titulo: string;
  contenido: string;
  usuario: string;
}


