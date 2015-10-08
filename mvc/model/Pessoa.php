<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Pessoa
 *
 * @ORM\Table(name="pessoa")
 * @ORM\Entity
 */
class Pessoa extends Model {

    /**
     * @var integer
     *
     * @ORM\Column(name="idPessoa", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idPessoa;

    /**
     * @var string
     *
     * @ORM\Column(name="nmPessoa", type="string", nullable=false)
     */
    protected $nmPessoa;
    
    /**
     * @ORM\OneToMany(targetEntity="Pedido", mappedBy="pessoa")
     */
    protected $pedidos = array();
    
    /**
     * @var string
     *
     * @ORM\Column(name="tpPessoa", type="string", nullable=false)
     */
    protected $tpPessoa;
    
    /**
     * @var string
     *
     * @ORM\Column(name="dsPessoa", type="string", nullable=false)
     */
    protected $dsPessoa;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cdRGIE", type="string", nullable=false)
     */
    protected $cdRGIE;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cdCPFCNPJ", type="string", nullable=false)
     */
    protected $cdCPFCNPJ;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cdTelefone", type="string", nullable=false)
     */
    protected $cdTelefone;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cdCelular", type="string", nullable=false)
     */
    protected $cdCelular;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cdEmail", type="string", nullable=false)
     */
    protected $cdEmail;

    public function __toString() {
        return $this->getNmPessoa();
    }

    public function getIdPessoa() {
        return $this->idPessoa;
    }

    public function setIdPessoa($idPessoa) {
        $this->idPessoa = $idPessoa;
        return $this;
    }

    public function getNmPessoa() {
        return $this->nmPessoa;
    }
    
    public function setNmPessoa($nmPessoa) {
        $this->nmPessoa = $nmPessoa;
        return $this;
    }
    
    public function getTpPessoa() {
        return $this->tpPessoa;
    }
    
    public function setTpPessoa($tpPessoa) {
        $this->tpPessoa = $tpPessoa;
        return $this;
    }
    
    public function getDsPessoa() {
        return $this->dsPessoa;
    }
    
    public function setDsPessoa($dsPessoa) {
        $this->dsPessoa = $dsPessoa;
        return $this;
    }
    
    public function getCdRGIE() {
        return $this->cdRGIE;
    }
    
    public function setCdRGIE($cdRGIE) {
        $this->cdRGIE = $cdRGIE;
        return $this;
    }
    
    public function getCdCPFCNPJ() {
        return $this->cdCPFCNPJ;
    }
    
    public function setCdCPFCNPJ($cdCPFCNPJ) {
        $this->cdCPFCNPJ = $cdCPFCNPJ;
        return $this;
    }
    
    public function getCdEmail() {
        return $this->cdEmail;
    }
    
    public function setCdEmail($cdEmail) {
        $this->cdEmail = $cdEmail;
        return $this;
    }
    
    public function getCdTelefone() {
        return $this->cdTelefone;
    }
    
    public function setCdTelefone($cdTelefone) {
        $this->cdTelefone = $cdTelefone;
        return $this;
    }
    
    public function getCdCelular() {
        return $this->cdCelular;
    }
    
    public function setCdCelular($cdCelular) {
        $this->cdCelular = $cdCelular;
        return $this;
    }
    
    public function getPedidos(){
        return $this->pedidos;
    }
    
    public function addPedido($item) {
        $this->pedidos[] = $pedido;
    }

    public function rmvPedido($idPedido) {
        //unset($this->itens[$idItem]);
    }

    public function clrPedidos() {
        $this->pedidos = array();
    }
    
    // metodo auxiliar
    public function getVlDividaCompra(){
        $valor = 0;
        $pedidos = $this->getPedidos();
        foreach($pedidos as $pedido){
            if ($pedido->getTpPedido() == 'C'){
                if ($pedido->getStPagamento() == 'PN'){
                    $valor += $pedido->getVlRestante();
                }
            }
        }
        return $valor;
    }
    
    // metodo auxiliar
    public function getVlDividaVenda(){
        $valor = 0;
        $pedidos = $this->getPedidos();
        foreach($pedidos as $pedido){
            if ($pedido->getTpPedido() == 'V'){
                if ($pedido->getStPagamento() == 'PN'){
                    $valor += $pedido->getVlRestante();
                }
            }
        }
        return $valor;
    }
    
    // metodo auxiliar
    public function isDevendo(){
        return $this->getVlDividaVenda() != 0 || $this->getVlDividaCompra() != 0;
    }
    
    // metodo auxiliar
    public function isDevendoEntregarCompras(){
        $pedidos = $this->getPedidos();
        foreach($pedidos as $pedido){
            if ($pedido->getTpPedido() == 'C'){
                $itens = $pedido->getItens();
                foreach($itens as $item){
                    if ($item->getStEntregaItem() == 'PN'){
                        return true;
                    }
                }
            }
        }
        return false;
    }
    
    // metodo auxiliar
    public function isDevendoEntregarVendas(){
        $pedidos = $this->getPedidos();
        foreach($pedidos as $pedido){
            if ($pedido->getTpPedido() == 'V'){
                $itens = $pedido->getItens();
                foreach($itens as $item){
                    if ($item->getStEntregaItem() == 'PN'){
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public static function persistPessoa($request) {

        $db = new DBAL();

        $id = $db->insert("pessoa", $request);

        return self::find($id);
    }

    public static function refreshPessoa($request, $id) {

        $db = new DBAL();

        $$id = $db->update("pessoa", $request, $id);

        return self::find($id);
    }

    public static function excludePessoa($id) {

        $db = new DBAL();

        return $db->delete("pessoa", "idPessoa", $id);
    }

}
