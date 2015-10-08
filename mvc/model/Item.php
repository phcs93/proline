<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity
 */
class Item extends Model {

    /**
     * @var integer
     *
     * @ORM\Column(name="idItem", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idItem;

    /**
     * @var integer
     *
     * @ORM\Column(name="nrItem", type="integer", nullable=false)
     */
    protected $nrItem;

    /**
     * @var decimal
     *
     * @ORM\Column(name="qtItem", type="decimal", nullable=false)
     */
    protected $qtItem;

    /**
     * @var string
     *
     * @ORM\Column(name="cdUnidadeItem", type="string", nullable=false)
     */
    protected $cdUnidadeItem;

    /**
     * @var decimal
     *
     * @ORM\Column(name="vlUnitario", type="decimal", nullable=false)
     */
    protected $vlUnitario;

    /**
     * @var decimal
     *
     * @ORM\Column(name="vlDescontoItem", type="decimal", nullable=false)
     */
    protected $vlDescontoItem;

    /**
     * @ORM\ManyToOne(targetEntity="Pedido", inversedBy="itens")
     * @ORM\JoinColumn(name="idPedido", referencedColumnName="idPedido")
     */
    protected $pedido;

    /**
     * @ORM\ManyToOne(targetEntity="Produto", inversedBy="itens")
     * @ORM\JoinColumn(name="idProduto", referencedColumnName="idProduto")
     */
    protected $produto;

    /**
     * @ORM\OneToMany(targetEntity="Entrega", mappedBy="item")
     */
    protected $entregas;

    public function __toString() {
        return $this->produto->getNmProduto();
    }

    public function getIdItem() {
        return $this->idItem;
    }

    public function setIdItem($idItem) {
        $this->idItem = $idItem;
        return $this;
    }

    public function getNrItem() {
        return $this->nrItem;
    }

    public function setNrItem($nrItem) {
        $this->nrItem = $nrItem;
        return $this;
    }

    public function getQtItem() {
        return $this->qtItem;
    }

    public function setQtItem($qtItem) {
        $this->qtItem = $qtItem;
        return $this;
    }

    public function getCdUnidadeItem() {
        return $this->cdUnidadeItem;
    }

    public function setCdUnidadeItem($cdUnidadeItem) {
        $this->cdUnidadeItem = $cdUnidadeItem;
        return $this;
    }

    public function getVlUnitario() {
        return $this->vlUnitario;
    }

    public function setVlUnitario($vlUnitario) {
        $this->vlUnitario = $vlUnitario;
        return $this;
    }

    public function getVlDescontoItem() {
        return $this->vlDescontoItem;
    }

    public function setVlDescontoitem($vlDescontoItem) {
        $this->vlDescontoItem = $vlDescontoItem;
        return $this;
    }

    public function getPedido() {
        return $this->pedido;
    }

    public function setPedido($pedido) {
        $this->pedido = $pedido;
        return $this;
    }

    public function getProduto() {
        return $this->produto;
    }

    public function setProduto($produto) {
        $this->produto = $produto;
        return $this;
    }

    public function getEntregas(){
        return $this->entregas;
    }

    public function addEntrega($entrega) {
        $this->entregas[] = $entrega;
    }

    public function rmvEntrega($idEntrega) {
        unset($this->entregas[$idEntrega]);
    }

    public function clrEntregas() {
        $this->entregas = array();
    }

    // metodo de auxiliar
    public function getVlItem() {
        $valor = $this->getVlUnitario() * $this->getQtItem();
        return $valor - ($valor * $this->getVlDescontoItem());
    }

    // metodo de auxiliar
    public function getQtEntregue() {
        $qtde = 0;
        foreach($this->entregas as $entrega){
            $qtde += $entrega->getQtEntrega();
        }
        return $qtde;
    }

    // metodo de auxiliar
    public function getQtRestante() {
        return $this->getQtItem() - $this->getQtEntregue();
    }

    // metodo auxiliar
    public function getStEntregaItem(){
        if ($this->getQtEntregue() < $this->getQtItem()){
            return 'PN';
        }else{
            return 'EN';
        }
    }

    // metodo auxiliar
    public function getQtEquivalente($unidade){

        $valor = $this->getQtEntregue();

        // se a unidade ja é a desejada, retorne o valor cadastrado
        if ($this->getCdUnidadeItem() == $unidade) {
            return $valor;
        } else {
            // tratar unidade desejada caso seja diferente da cadastrada
            switch ($unidade) {
                case 'KG':
                    switch ($this->getCdUnidadeItem()) {
                        case 'MT': return $valor * $this->getProduto()->getVlKGMT();
                        case 'PÇ': return $valor * $this->getProduto()->getVlKGPC();
                    }
                    break;
                case 'MT':
                    switch ($this->getCdUnidadeItem()) {
                        case 'KG': return $this->getProduto()->getVlKGMT() != 0 ? $valor / $this->getProduto()->getVlKGMT() : 0;
                        case 'PÇ': return $valor * $this->getProduto()->getVlMTPC();
                    }
                    break;
                case 'PC':
                    switch ($this->getCdUnidadeItem()) {
                        case 'KG': return $this->getProduto()->getVlKGPC() != 0 ? $valor / $this->getProduto()->getVlKGPC() : 0;
                        case 'MT': return $this->getProduto()->getVlMTPC() != 0 ? $valor / $this->getProduto()->getVlMTPC() : 0;
                    }
                    break;
            }
        }

    }

}
