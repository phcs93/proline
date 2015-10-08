<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Material
 *
 * @ORM\Table(name="material")
 * @ORM\Entity
 */
class Material extends Model {

    /**
     * @var integer
     *
     * @ORM\Column(name="idMaterial", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idMaterial;

    /**
     * @var string
     *
     * @ORM\Column(name="nmMaterial", type="string", nullable=false)
     */
    protected $nmMaterial;

    public function __toString() {
        return $this->getNmMaterial();
    }

    public function getIdMaterial() {
        return $this->idMaterial;
    }

    public function setIdMaterial($idMaterial) {
        $this->idMaterial = $idMaterial;
    }

    public function getNmMaterial() {
        return $this->nmMaterial;
    }

    public function setNmMaterial($nmMaterial) {
        $this->nmMaterial = $nmMaterial;
    }

    public static function persistMaterial($request) {

        $db = new DBAL();

        $id = $db->insert("material", $request);

        return self::find($id);
    }

    public static function refreshMaterial($request, $id) {

        $db = new DBAL();

        $$id = $db->update("material", $request, $id);

        return self::find($id);
    }

    public static function excludeMaterial($id) {

        $db = new DBAL();

        return $db->delete("material", "idMaterial", $id);
    }

}
