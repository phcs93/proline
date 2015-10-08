<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Produto
 *
 * @ORM\Table(name="produto")
 * @ORM\Entity
 */
class Produto extends Model {

    /**
     * @var integer
     *
     * @ORM\Column(name="idProduto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idProduto;

    /**
     * @var decimal
     *
     * @ORM\Column(name="vlCompra", type="decimal", nullable=false)
     */
    protected $vlCompra;

    /**
     * @var decimal
     *
     * @ORM\Column(name="vlVenda", type="decimal", nullable=false)
     */
    protected $vlVenda;

    /**
     * @var string
     *
     * @ORM\Column(name="cdNCM", type="string", nullable=false)
     */
    protected $cdNCM;

    /**
     * @var decimal
     *
     * @ORM\Column(name="vlKGMT", type="decimal", nullable=false)
     */
    protected $vlKGMT;

    /**
     * @var decimal
     *
     * @ORM\Column(name="vlKGPC", type="decimal", nullable=false)
     */
    protected $vlKGPC;

    /**
     * @var decimal
     *
     * @ORM\Column(name="vlMTPC", type="decimal", nullable=false)
     */
    protected $vlMTPC;

    /**
     * @var string
     *
     * @ORM\Column(name="cdUnidade", type="string", nullable=false)
     */
    protected $cdUnidade;

    /**
     * @var decimal
     *
     * @ORM\Column(name="qtMinimo", type="decimal", nullable=false)
     */
    protected $qtMinimo;

    /**
     * @var integer
     *
     * @ORM\Column(name="mmParado", type="integer", nullable=false)
     */
    protected $mmParado;

    /**
     * @ORM\ManyToOne(targetEntity="Tipo", inversedBy="produtos")
     * @ORM\JoinColumn(name="idTipo", referencedColumnName="idTipo")
     */
    protected $tipo;

    /**
     * @ORM\ManyToOne(targetEntity="Material", inversedBy="produtos")
     * @ORM\JoinColumn(name="idMaterial", referencedColumnName="idMaterial")
     */
    protected $material;

    /**
     * @ORM\ManyToOne(targetEntity="Quimica", inversedBy="produtos")
     * @ORM\JoinColumn(name="idQuimica", referencedColumnName="idQuimica")
     */
    protected $quimica;

    /**
     * @ORM\ManyToOne(targetEntity="Medida", inversedBy="produtos")
     * @ORM\JoinColumn(name="idMedida", referencedColumnName="idMedida")
     */
    protected $medida;

    /**
     * @var string
     *
     * @ORM\Column(name="vlPolegadas", type="string", nullable=false)
     */
    protected $vlPolegadas;

    /**
     * @ORM\ManyToOne(targetEntity="Pessoa", inversedBy="produtos")
     * @ORM\JoinColumn(name="idPessoa", referencedColumnName="idPessoa")
     */
    protected $pessoa;

    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="produto")
     */
    protected $itens;

    public function __toString() {
        return $this->getNmProduto();
    }

    public function getIdProduto() {
        return $this->idProduto;
    }

    public function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
        return $this;
    }

    public function getVlCompra() {
        return $this->vlCompra;
    }

    public function setVlCompra($vlCompra) {
        $this->vlCompra = $vlCompra;
        return $this;
    }

    public function getVlVenda() {
        return $this->vlVenda;
    }

    public function setVlVenda($vlVenda) {
        $this->vlVenda = $vlVenda;
        return $this;
    }

    public function getCdNCM() {
        return $this->cdNCM;
    }

    public function setCdNCM($cdNCM) {
        $this->cdNCM = $cdNCM;
        return $this;
    }

    public function getVlKGMT() {
        return $this->vlKGMT;
    }

    public function setVlKGMT($vlKGMT) {
        $this->vlKGMT = $vlKGMT;
        return $this;
    }

    public function getVlKGPC() {
        return $this->vlKGPC;
    }

    public function setVlKGPC($vlKGPC) {
        $this->vlKGPC = $vlKGPC;
        return $this;
    }

    public function getVlMTPC() {
        return $this->vlMTPC;
    }

    public function setVlMTPC($vlMTPC) {
        $this->vlMTPC = $vlMTPC;
        return $this;
    }

    public function getCdUnidade() {
        return $this->cdUnidade;
    }

    public function setCdUnidade($cdUnidade) {
        $this->cdUnidade = $cdUnidade;
        return $this;
    }

    public function getQtMinimo() {
        return $this->qtMinimo;
    }

    public function setQtMinimo($qtMinimo) {
        $this->qtMinimo = $qtMinimo;
        return $this;
    }

    public function getMmParado() {
        return $this->mmParado;
    }

    public function setMmParado($mmParado) {
        $this->mmParado = $mmParado;
        return $this;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }

    public function getMaterial() {
        return $this->material;
    }

    public function setMaterial($material) {
        $this->material = $material;
        return $this;
    }

    public function getQuimica() {
        return $this->quimica;
    }

    public function setQuimica($quimica) {
        $this->quimica = $quimica;
        return $this;
    }

    public function getMedida() {
        return $this->medida;
    }

    public function setMedida($medida) {
        $this->medida = $medida;
        return $this;
    }

    public function getVlPolegadas() {
        return $this->vlPolegadas;
    }

    public function setVlPolegadas($vlPolegadas) {
        $this->vlPolegadas = $vlPolegadas;
        return $this;
    }

    public function getPessoa() {
        return $this->pessoa;
    }

    public function setPessoa($pessoa) {
        $this->pessoa = $pessoa;
        return $this;
    }    

    // metodo auxiliar
    public function getNmProduto() {
        return $this->tipo->getNmTipo() . ' ' . $this->material->getNmMaterial() . ' ' . $this->quimica->getNmQuimica() . ' ' . $this->medida->getNmMedida() . ' ' . toPOL($this->getVlPolegadas());
    }

    // metodo auxiliar
    public function getVlUnitario($operacao, $unidade) {

        if ($operacao == 'compra') {
            $valor = $this->getVlCompra();
        } else {
            $valor = $this->getVlVenda();
        }

        // se a unidade ja é a desejada, retorne o valor cadastrado
        if ($this->getCdUnidade() == $unidade) {
            return $valor;
        } else {
            // tratar unidade desejada caso seja diferente da cadastrada
            switch ($unidade) {
                case 'KG':
                switch ($this->getCdUnidade()) {
                    case 'MT': return ( 1 / $this->getVlKGMT() ) * $valor;
                    case 'PÇ': return ( 1 / $this->getVlKGPC() ) * $valor;
                }
                break;
                case 'MT':
                switch ($this->getCdUnidade()) {
                    case 'KG': return $this->getVlKGMT() * $valor;
                    case 'PÇ': return ( 1 / $this->getVlMTPC() ) * $valor;
                }
                break;
                case 'PC':
                switch ($this->getCdUnidade()) {
                    case 'KG': return $this->getVlKGPC() * $valor;
                    case 'MT': return $this->getVlMTPC() * $valor;
                }
                break;
            }
        }
    }

    // metodo auxiliar
    public function getQtEstoque($unidade){
        $qtde = 0;
        foreach($this->itens as $item){
            $qtde += $item->getPedido()->getTpPedido() == 'C' ? $item->getQtEquivalente($unidade) : -$item->getQtEquivalente($unidade);
        }
        return $qtde;
    }

    // metodo auxiliar
    public function getQtEquivalente($valor, $unidade){

        // se a unidade ja é a desejada, retorne o valor cadastrado
        if ($this->getCdUnidade() == $unidade) {
            return $valor;
        } else {
            // tratar unidade desejada caso seja diferente da cadastrada
            switch ($unidade) {
                case 'KG':
                switch ($this->getCdUnidade()) {
                    case 'MT': return @($valor * $this->getVlKGMT());
                    case 'PÇ': return @($valor * $this->getVlKGPC());
                }
                break;
                case 'MT':
                switch ($this->getCdUnidade()) {
                    case 'KG': return @($valor / $this->getVlKGMT());
                    case 'PÇ': return @($valor * $this->getVlMTPC());
                }
                break;
                case 'PC':
                switch ($this->getCdUnidade()) {
                    case 'KG': return @($valor / $this->getVlKGPC());
                    case 'MT': return @($valor / $this->getVlMTPC());
                }
                break;
            }
        }

    }
    
    // metodo auxiliar
    public function getQtFaltante(){
        if ($this->getStEstoque() == "FT"){
            return $this->getQtMinimo() - $this->getQtEstoque($this->getCdUnidade());
        }else{
            return 0;
        }
    }

    // metodo auxiliar
    public function getDtUltimaMovimentacao(){
        $data = "";
        foreach($this->itens as $item){
            foreach($item->getEntregas() as $entrega){
                if ($data == "" || new DateTime($entrega->getDtEntrega()) > new DateTime($data)) {
                    $data = $entrega->getDtEntrega();
                }
            }
        }
        return $data;
    }

    // metodo auxiliar
    public function getDdParado(){
        if ($this->getDtUltimaMovimentacao() != ""){
            $last = new DateTime($this->getDtUltimaMovimentacao());
            $today = new DateTime(date('Y-m-d', time()));
            $interval = $last->diff($today);
            return $interval->d;
        }else{
            return "";
        }
    }

    // metodo auxiliar
    public function getStEstoque(){
        $estoque = $this->getQtEstoque($this->getCdUnidade());
        $minimo = $this->getQtMinimo();
        if ($estoque > $minimo){
            return 'OK';
        }else{
            return 'FT';
        }
    }

    // metodo auxiliar
    public function getStParado(){
        $limite = $this->getMmParado();
        $last = new DateTime($this->getDtUltimaMovimentacao());
        $today = new DateTime(date('Y-m-d', time()));
        $interval = $last->diff($today);
        if ($interval->m < $limite){
            return 'OK';
        }else{
            return 'PR';
        }
    }

    public static function persistProduto($request) {

        $db = new DBAL();

        $request['vlCompra'] = str_replace(',', '.', $request['vlCompra']);
        $request['vlVenda'] = str_replace(',', '.', $request['vlVenda']);
        $request['vlKGMT'] = str_replace(',', '.', $request['vlKGMT']);
        $request['vlKGPC'] = str_replace(',', '.', $request['vlKGPC']);
        $request['vlMTPC'] = str_replace(',', '.', $request['vlMTPC']);
        $request['qtMinimo'] = str_replace(',', '.', $request['qtMinimo']);

        $request['idPessoa'] = $request['idPessoa'] == "" ? null : $request['idPessoa'];

        $id = $db->insert("produto", $request);

        return self::find($id);
    }

    public static function refreshProduto($request, $id) {

        $db = new DBAL();

        $request['vlCompra'] = str_replace(',', '.', $request['vlCompra']);
        $request['vlVenda'] = str_replace(',', '.', $request['vlVenda']);
        $request['vlKGMT'] = str_replace(',', '.', $request['vlKGMT']);
        $request['vlKGPC'] = str_replace(',', '.', $request['vlKGPC']);
        $request['vlMTPC'] = str_replace(',', '.', $request['vlMTPC']);
        $request['qtMinimo'] = str_replace(',', '.', $request['qtMinimo']);

        $request['idPessoa'] = $request['idPessoa'] == "" ? null : $request['idPessoa'];

        $id = $db->update("produto", $request, $id);

        return self::find($id);
    }

    public static function excludeProduto($id) {

        $db = new DBAL();

        return $db->delete("produto", "idProduto", $id);
    }

}
