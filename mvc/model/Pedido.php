<?php 

if (!isset($_SESSION)) {
    session_start();
}

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 *
 * @ORM\Table(name="pedido")
 * @ORM\Entity
 */
class Pedido extends Model {

    /**
     * @var integer
     *
     * @ORM\Column(name="idPedido", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idPedido;

    /**
     * @var string
     *
     * @ORM\Column(name="tpPedido", type="string", nullable=false)
     */
    protected $tpPedido;

    /**
     * @var string
     *
     * @ORM\Column(name="dtPedido", type="string", nullable=false)
     */
    protected $dtPedido;

    /**
     * @var string
     *
     * @ORM\Column(name="dsPedido", type="string", nullable=true)
     */
    protected $dsPedido;

    /**
     * @var string
     *
     * @ORM\Column(name="dsEndereco", type="string", nullable=true)
     */
    protected $dsEndereco;

    /**
     * @var decimal
     *
     * @ORM\Column(name="vlDesconto", type="decimal", nullable=false)
     */
    protected $vlDesconto;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="pedidos")
     * @ORM\JoinColumn(name="idUsuario", referencedColumnName="idUsuario")
     */
    protected $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="Pessoa", inversedBy="pedidos")
     * @ORM\JoinColumn(name="idPessoa", referencedColumnName="idPessoa")
     */
    protected $pessoa;

    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="pedido")
     */
    protected $itens = array();

    /**
     * @ORM\OneToMany(targetEntity="Pagamento", mappedBy="pedido")
     */
    protected $pagamentos = array();

    public function __toString() {
        return $this->getDsPedido();
    }

    public function getIdPedido() {
        return $this->idPedido;
    }

    public function setIdPedido($idPedido) {
        $this->idPedido = $idPedido;
    }

    public function getTpPedido() {
        return $this->tpPedido;
    }

    public function setTpPedido($tpPedido) {
        $this->tpPedido = $tpPedido;
        return $this;
    }

    public function getDtPedido() {
        return $this->dtPedido;
    }

    public function setDtPedido($dtPedido) {
        $this->dtPedido = $dtPedido;
    }

    public function getDsPedido() {
        return $this->dsPedido;
    }

    public function setDsPedido($dsPedido) {
        $this->dsPedido = $dsPedido;
    }

    public function getDsEndereco() {
        return $this->dsEndereco;
    }

    public function setDsEndereco($dsEndereco) {
        $this->dsEndereco = $dsEndereco;
    }

    public function getVlDesconto() {
        return $this->vlDesconto;
    }

    public function setVlDesconto($vlDesconto) {
        $this->vlDesconto = $vlDesconto;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getPessoa() {
        return $this->pessoa;
    }

    public function setPessoa($pessoa) {
        $this->pessoa = $pessoa;
        return $this;
    }
    
    public function getItens() {
        return $this->itens;
    }

    public function addItem($item) {
        $this->itens[] = $item;
    }

    public function rmvItem($idItem) {
        //unset($this->itens[$idItem]);
    }

    public function clrItens() {
        $this->itens = array();
    }

    public function getPagamentos() {
        return $this->pagamentos;
    }    
    
    public function addPagamento($pagamento) {
        $this->pagamentos[] = $pagamento;
    }
    
    public function rmvPagamento($idPagamento) {
        //unset($this->pagamentos[$idPagamento]);
    }

    public function clrPagamentos() {
        $this->pagamentos = array();
    }

    // metodo auxiliar
    public function getVlPedido() {
        $valor = 0;
        foreach ($this->itens as $item) {
            $valor += $item->getVlItem();
        }
        $total = $valor - ($valor * $this->getVlDesconto());
        return sprintf("%01.2f", $total);
    }
    
    // metodo auxiliar
    public function getVlPago() {
        $valor = 0;
        foreach($this->pagamentos as $pagamento){
            $valor += $pagamento->getVlPagamento();
        }
        return $valor;
    }

    // metodo auxiliar
    public function getVlRestante() {
        return $this->getVlPedido() - $this->getVlPago();
    }

    // metodo auxiliar
    public function getStPagamento() {
        if ($this->getVlPago() < $this->getVlPedido()){
            return 'PN';
        }else{
            return 'PG';
        }
    }

    // metodo auxiliar
    public function getStEntrega() {
        foreach($this->getItens() as $item){
            if ($item->getStEntregaItem() == 'PN'){
                return 'PN';
            }
        }
        return 'EN';
    }
    
    // metodo auxiliar
    public function getStPedido() {
        if ($this->getStEntrega() == 'PN' || $this->getStPagamento() == 'PN'){
            return "Pendente";
        }else{
            return "Concluido";
        }
    }

    public static function persistPedido($request) {

        $db = new DBAL();

        $itens = array_remove($request, 'itens');

        $request['idPessoa'] = $request['idPessoa'] ?: null;
        $request['idUsuario'] = $_SESSION['usuario']['idUsuario'];
        $request['vlDesconto'] = $request['vlDesconto'] / 100;
        $id = $db->insert("pedido", $request);

        foreach($itens as $key => $val){
            $itens[$key]['idPedido'] = $id;
        }
        $ids = $db->insertMultiple("item", $itens);

        return self::find($id);
        
    }
    
    public static function refreshPedido($request, $id) {

        // $db = new DBAL();

        // $itens = array_remove($request, 'itens');

        // $request['idPessoa'] = $request['idPessoa'] ?: null;
        // $request['idUsuario'] = $_SESSION['usuario']['idUsuario'];
        // $request['vlDesconto'] = $request['vlDesconto'] / 100;
        // $id = $db->insert("pedido", $request);

        // foreach($itens as $key => $val){
        //     $itens[$key]['idPedido'] = $id;
        // }
        // $ids = $db->updateMultiple("item", $itens);

        // return self::find($id);
        
        throw new Exception("Função ainda não implementada");
        
    }

    public static function excludePedido($id) {

        $db = new DBAL();

        return $db->delete("pedido", "idPedido", $id);
        
    }

    public static function findPendentes(){
        $pedidos = $GLOBALS['orm']->getRepository("Pedido")->findAll();
        foreach($pedidos as $key => $pedido){
            if ($pedido->getStPagamento() != 'PN' && $pedido->getStEntrega() != 'PN'){
                unset($pedidos[$key]);
            }
        }
        return orderObjs($pedidos);
    }

}
