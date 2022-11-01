<?php
require_once './models/Usuario.php';
require_once './interfaces/IApiUsable.php';

class UsuarioController extends Usuario implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();

        $usuario = $parametros['usuario'];
        $clave = $parametros['clave'];

        // Creamos el usuario
        $usr = new Usuario();
        $usr->usuario = $usuario;
        $usr->clave = $clave;
        $usr->crearUsuario();

        $payload = json_encode(array("mensaje" => "Usuario creado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        // Buscamos usuario por nombre
        $usr = $args['usuario'];
        $usuario = Usuario::obtenerUsuario($usr);
        $payload = json_encode($usuario);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Usuario::obtenerTodos();
        $payload = json_encode(array("listaUsuario" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        $usuarioId = $args['usuarioId'];
        $nombre = $parametros['usuario'];
        $clave = $parametros['clave'];
        // Creamos el usuario
        $usr = new Usuario();
        $usr->id = $usuarioId;
        $usr->usuario = $nombre;
        $usr->clave = $clave;
        
        Usuario::modificarUsuario($usr);
        $payload = json_encode(array("mensaje" => "Usuario modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args)
    {
        $usuarioId = $args['usuarioId'];
        Usuario::borrarUsuario($usuarioId);

        $payload = json_encode(array("mensaje" => "Usuario borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function Login($request, $response, $args)
    {

      $parametros = $request->getParsedBody();
      // Creamos el usuario
      $usr = new Usuario();
      $usr->usuario = $parametros['usuario'];
      $usr->clave = $parametros['clave'];
      $usuario = Usuario::obtenerUsuario($usr->usuario);
      
      if($usuario->usuario==$usr->usuario &&$usuario->clave == $usr->clave){
        $response->getBody()->write("logeado exitosamente");
      }else{
        $response->getBody()->write("Error en clave y/o usuario");
      }

        return $response
          ->withHeader('Content-Type', 'application/json');
    }
}



