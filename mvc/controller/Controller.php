<?php
    
    $root = realpath(__DIR__."/../../");

    header('Content-Type: application/json'); // o retorno do controller é sempre em json
    
    require_once("$root/src/$.php"); // funções globais
    require_once("$root/src/DB.php"); // banco de dados
 
    try {
    
        parse_str(file_get_contents("php://input"), $request); // pega os parametros enviados (seja qual for o método)
        $method = $_SERVER['REQUEST_METHOD']; // pega o método que enviou os parametros
        $class = $_REQUEST['class']; // pega a classe de quem esta chamando o controller
        
        parseRequest($request); // converter arrays JSON para arrays PHP
     
        // REST CRUD controller
        switch ($method) {
            
            case 'GET': { // retrieve
                echo json_encode($class::findAll());
                break;
            }
     
            case 'POST': { // create
     
                $function = "persist" . $class; // gerar nome da função
                $obj = $class::$function($request); // criar variavel do objeto
                echo json_encode(array('id' => $obj->getPK(), 'string' => $obj->__toString())); // retorna o objeto em json
                break;
            }
            
            case 'PUT': { // update
     
                $function = "refresh" . $class; // gerar nome da função
                $obj = $class::$function($request, $request["id$class"]); // criar variavel do objeto
                echo json_encode(array('id' => $obj->getPK())); // retorna id e html para a view
                break;
            }
     
            case 'DELETE': { // delete
     
                $function = "exclude" . $class; // gerar nome da função
                $id = $class::$function($request["id$class"]); // executa o delete e pega o id
                echo json_encode(array('id' => $id)); // retorna o id para a view
                break;
            }
     
            default: break; // default
        }
     
    } catch (Exception $e) {
        echo json_encode(array(
            'exception' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        )); 
    }