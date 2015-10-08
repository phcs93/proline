<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Medida
 *
 * @ORM\Table(name="medida")
 * @ORM\Entity
 */
class Medida extends Model {

    /**
     * @var integer
     *
     * @ORM\Column(name="idMedida", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idMedida;

    /**
     * @var string
     *
     * @ORM\Column(name="nmMedida", type="string", nullable=false)
     */
    protected $nmMedida;

    public function __toString() {
        return $this->getNmMedida();
    }

    public function getIdMedida() {
        return $this->idMedida;
    }

    public function setIdMedida($idMedida) {
        $this->idMedida = $idMedida;
    }

    public function getNmMedida() {
        return $this->nmMedida;
    }

    public function setNmMedida($nmMedida) {
        $this->nmMedida = $nmMedida;
    }

    public static function persistMedida($request) {

        $db = new DBAL();

        $id = $db->insert("medida", $request);

        return self::find($id);
    }

    public static function refreshMedida($request, $id) {

        $db = new DBAL();

        $$id = $db->update("medida", $request, $id);

        return self::find($id);
    }

    public static function excludeMedida($id) {

        $db = new DBAL();

        return $db->delete("medida", "idMedida", $id);
    }

}
