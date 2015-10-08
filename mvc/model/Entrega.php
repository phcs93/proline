<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Entrega
 *
 * @ORM\Table(name="entrega")
 * @ORM\Entity
 */
class Entrega extends Model {

    /**
     * @var integer
     *
     * @ORM\Column(name="idEntrega", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idEntrega;

    /**
     * @var integer
     *
     * @ORM\Column(name="nrEntrega", type="integer", nullable=false)
     */
    protected $nrEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="dtEntrega", type="string", nullable=false)
     */
    protected $dtEntrega;

    /**
     * @var decimal
     *
     * @ORM\Column(name="qtEntrega", type="decimal", nullable=false)
     */
    protected $qtEntrega;

    /**
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="entregas")
     * @ORM\JoinColumn(name="idItem", referencedColumnName="idItem")
     */
    protected $item;

    public function __toString() {
        return "" . $this->getNrEntrega();
    }

    public function getIdEntrega() {
        return $this->idEntrega;
    }
    
    protected function setIdEntrega($idEntrega){
        $this->idEntrega = $idEntrega;
        return $this;
    }

    public function getNrEntrega() {
        return $this->nrEntrega;
    }
    
    protected function setNrEntrega($nrEntrega) {
        $this->nrEntrega = $nrEntrega;
        return $this;
    }

    public function getDtEntrega() {
        return $this->dtEntrega;
    }
    
    protected function setDtEntrega($dtEntrega) {
        $this->dtEntrega = $dtEntrega;
        return $this;
    }

    public function getQtEntrega() {
        return $this->qtEntrega;
    }
    
    protected function setQtEntrega($qtEntrega) {
        $this->qtEntrega = $qtEntrega;
        return $this;
    }

    public function getItem() {
        return $this->item;
    }
    
    protected function setitem($item) {
        $this->item = $item;
        return $this;
    }

    public static function persistEntrega($request) {

        $db = new DBAL();

        $request['qtEntrega'] = str_replace(',', '.', $request['qtEntrega']);

        $id = $db->insert("entrega", $request);

        return Entrega::find($id);
    }

    // query auxiliar
    public static function getDistinctDates(){

        $db = new DBAL();

        return $db->select("SELECT DISTINCT dtEntrega FROM entrega");

    }
    
}