<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipo
 *
 * @ORM\Table(name="tipo")
 * @ORM\Entity
 */
class Tipo extends Model {

    /**
     * @var integer
     *
     * @ORM\Column(name="idTipo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idTipo;

    /**
     * @var string
     *
     * @ORM\Column(name="nmTipo", type="string", nullable=false)
     */
    protected $nmTipo;

    public function __toString() {
        return $this->getNmTipo();
    }

    public function getIdTipo() {
        return $this->idTipo;
    }

    public function setIdTipo($idTipo) {
        $this->idTipo = $idTipo;
    }

    public function getNmTipo() {
        return $this->nmTipo;
    }    

    public function setNmTipo($nmTipo) {
        $this->nmTipo = $nmTipo;
    }

    public static function persistTipo($request) {

        $db = new DBAL();

        $id = $db->insert("tipo", $request);

        return self::find($id);
    }

    public static function refreshTipo($request, $id) {

        $db = new DBAL();

        $$id = $db->update("tipo", $request, $id);

        return self::find($id);
    }

    public static function excludeTipo($id) {

        $db = new DBAL();

        return $db->delete("tipo", "idTipo", $id);
    }

}
