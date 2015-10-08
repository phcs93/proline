<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Quimica
 *
 * @ORM\Table(name="quimica")
 * @ORM\Entity
 */
class Quimica extends Model {

    /**
     * @var integer
     *
     * @ORM\Column(name="idQuimica", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idQuimica;

    /**
     * @var string
     *
     * @ORM\Column(name="nmQuimica", type="string", nullable=false)
     */
    protected $nmQuimica;

    public function __toString() {
        return $this->getNmQuimica();
    }

    public function getIdQuimica() {
        return $this->idQuimica;
    }

    public function setIdQuimica($idQuimica) {
        $this->idQuimica = $idQuimica;
    }

    public function getNmQuimica() {
        return $this->nmQuimica;
    }    

    public function setNmQuimica($nmQuimica) {
        $this->nmQuimica = $nmQuimica;
    }

    public static function persistQuimica($request) {

        $db = new DBAL();

        $id = $db->insert("quimica", $request);

        return self::find($id);
    }

    public static function refreshQuimica($request, $id) {

        $db = new DBAL();

        $$id = $db->update("quimica", $request, $id);

        return self::find($id);
    }

    public static function excludeQuimica($id) {

        $db = new DBAL();

        return $db->delete("quimica", "idQuimica", $id);
    }

}
