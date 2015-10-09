# Proline
Sistema WEB para gestão de negócios com controle de:
* Estoque
* Produtos
* Caixa
* Compras
* Vendas
* Usuários
* Fornecedores
* Clientes

## Feito com
* PHP
* MySQL

## Sistema de múltiplas unidades de medida
A versão atual do projeto possui um sistema de múltiplas unidades de medida para um unico produto:
* Quilogramas (Kg)
* Métros (m)
* Peças (Pç)

Para que isso seja possivel, cada produto tem três campos de conversão:
* KGMT (quilogramas por métro)
* KGPC (quilogramas por peça)
* MTPC (métros por peça)

No cadastramento do produto são necessárias no minimo duas unidades de conversão, o sistema encontra a terceira unidade automaticamente.
Além das três unidades de conversão, também é necessário cadastrar a unidade "real" do produto, pois **apenas um unico valor é salvo na base de dados** (este valor corresponde à undiade real).
A unidade real é simplesmente uma forma de manter um valor único para o produto, esta unidade é convertida em todas as operações do sistema, utilizando as unidades de conversão.

Na hora de consultar o estoque, é possivel saber a quantidade do produto em todas as três unidades de medida (convertendo o valor real da base utilizando as unidades de conversão cadastradas).
Isso torna possivel também saber o preço do produto em todas as unidades de medida (todo produto possui um preço de venda e de compra cadastrado, que é o preço unitario da unidade real).,

Com isso é possivel comprar e vender os produtos em qualquer unidade!
Na hora de sensibilizar o estoque é extremamente simples, basta converter a unidade comercializada para a unidade real do produto, e então utilizar esse valor para gerar uma movimentação de estoque.
Isto já basta para manter toda a integridade das diferentes medidas, já que apesar do sistema trabalhar com três unidades, apenas a unidade "real" é salva na base.
