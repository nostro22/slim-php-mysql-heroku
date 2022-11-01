<¿<?php
  use Slim\Handlers\Strategies\RequestHandler;
  use Slim\Psr7\Request;
  use Slim\Psr7\Response;
class checkDataMiddleware{



    private $typos=[
        "administador", "Camarera", "Cocinero", "Barman"
    ];
    

    public function __invoke(Request $request, RequestHandler $handler): Response{
        $response = new Response();
        $parametros = $request->getParsedBody();
        $usuario = $parametros['usuario'];
        $clave = $parametros['clave'];
        $perfil = $parametros['perfil'];
        try{
            if(!empty($usuario) && !empty($clave) && !empty($perfil)){
                if(in_array($perfil, $this->typos)){
                if($perfil == "administrador")
                {
                    
                }
                }
            }
        }




    }


}