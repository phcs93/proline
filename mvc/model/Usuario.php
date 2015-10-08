<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario extends Model {

    /**
     * @var integer
     *
     * @ORM\Column(name="idUsuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="nmUsuario", type="string", length=255, nullable=false)
     */
    protected $nmUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="cdLogin", type="string", length=255, nullable=false)
     */
    protected $cdLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="cdSenha", type="string", length=255, nullable=false)
     */
    protected $cdSenha;

    public function __toString() {
        return $this->getNmUsuario();
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
        return $this;
    }

    public function getNmUsuario() {
        return $this->nmUsuario;
    }

    public function setNmUsuario($nmUsuario) {
        $this->nmUsuario = $nmUsuario;
        return $this;
    }

    public function getCdLogin() {
        return $this->cdLogin;
    }

    public function setCdLogin($cdLogin) {
        $this->cdLogin = $cdLogin;
        return $this;
    }

    public function getCdSenha() {
        return $this->cdSenha;
    }

    public function setCdSenha($cdSenha) {
        $this->cdSenha = $cdSenha;
        return $this;
    }

    // metodo auxiliar
    public function toArray() {
        return array(
            'idUsuario' => $this->getIdUsuario(),
            'nmUsuario' => $this->getNmUsuario()
        );
    }
    
    // metodo auxiliar
    function findByLoginSenha($login, $senha) {

        $usuario = $GLOBALS['orm']->getRepository('Usuario')->findOneBy(array(
            'cdLogin' => $login, 
            'cdSenha' => $senha
        ));
    
        if ($usuario === null) {
            return false;
        } else {
            return $usuario;
        }
        
    }

    public static function persistUsuario($request) {
        $db = new DBAL();
        $id = $db->insert("usuario", $request);
        return self::find($id);
    }

    public static function refreshUsuario($request, $id) {
        $db = new DBAL();
        $id = $db->update("usuario", $request, $id);
        return self::find($id);
    }

    public static function excludeUsuario($id) {
        $db = new DBAL();
        return $db->delete("usuario", "idUsuario", $id);
    }

}
