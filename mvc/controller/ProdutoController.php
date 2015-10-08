<?php
    
    $root = realpath(__DIR__."/../../");

    header('Content-Type: application/json'); // o retorno do controller é sempre em json
    
    require_once("$root/src/$.php"); // funções globais
    require_once("$root/src/DB.php"); // banco de dados
 
    try {
    
        parse_str(file_get_contents("php://input"), $request); // pega os parametros enviados (seja qual for o método)
        $method = $_SERVER['REQUEST_METHOD']; // pega o método que enviou os parametros
        $function = $_REQUEST['function']; // pega a função requisitada
        $id = $_REQUEST['id']; // id da pessoa
        
        parseRequest($request); // converter arrays JSON para arrays PHP
     
        switch ($function) {
            
            case 'ReporProduto':{
                
                $produto = Produto::find($id);
                
                $pedido = array(
                	"tpPedido" => "C",
                	"dtPedido" => date('Y-m-d', time()),
                	"dsPedido" => "Reposição de produto",
                	"dsEndereco" => "",
                	"vlDesconto" => 0,
                	"idPessoa" => $produto->getPessoa() != null ? $produto->getPessoa()->getIdPessoa() : null,
                	"itens" => array(
                	    array(
                            "nrItem" => 1,
                            "qtItem" => $produto->getQtMinimo() * 2,
                            "cdUnidadeItem" => $produto->getCdUnidade(),
                            "vlUnitario" => $produto->getVlUnitario('compra', $produto->getCdUnidade()),
                            "vlDescontoItem" => 0,
                            "idProduto" => $produto->getIdProduto()
                        )
                	)
                );
                
                $pedido = Pedido::persistPedido($pedido);
                
                echo json_encode(true);
                break;
            }
            
            case 'ReporEstoque':{
                
                $produtos = Produto::findAll();
                
                // agrupar produtos em falta por fornecedor
                foreach($produtos as $produto){
                    if ($produto->getStEstoque() == 'FT'){
                        $agrupamentos[$produto->getPessoa() == null ? 0 : $produto->getPessoa()->getIdPessoa()][] = array(
                            "nrItem" => 1,
                            "qtItem" => $produto->getQtMinimo() * 2,
                            "cdUnidadeItem" => $produto->getCdUnidade(),
                            "vlUnitario" => $produto->getVlUnitario('compra', $produto->getCdUnidade()),
                            "vlDescontoItem" => 0,
                            "idProduto" => $produto->getIdProduto()
                        );
                    }
                }
                
                // gerar um pedido para cada agrupamento
                foreach($agrupamentos as $idFornecedor => $agrupamento){
                    Pedido::persistPedido(array(
                    	"tpPedido" => "C",
                    	"dtPedido" => date('Y-m-d', time()),
                    	"dsPedido" => "Reposição de estoque",
                    	"dsEndereco" => "",
                    	"vlDesconto" => 0,
                    	"idPessoa" => $idFornecedor == 0 ? null : $idFornecedor,
                    	"itens" => $agrupamento
                    ));
                }
                
                echo json_encode(true);
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