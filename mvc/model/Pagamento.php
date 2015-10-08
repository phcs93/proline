<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * Pagamento
 *
 * @ORM\Table(name="pagamento")
 * @ORM\Entity
 */
class Pagamento extends Model {

    /**
     * @var integer
     *
     * @ORM\Column(name="idPagamento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $idPagamento;

    /**
     * @var integer
     *
     * @ORM\Column(name="nrPagamento", type="integer", nullable=false)
     */
    protected $nrPagamento;

    /**
     * @var string
     *
     * @ORM\Column(name="dtPagamento", type="string", nullable=false)
     */
    protected $dtPagamento;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tpPagamento", type="string", nullable=false)
     */
    protected $tpPagamento;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="qtPeriodo", type="integer", nullable=false)
     */
    protected $qtPeriodo;

    /**
     * @var decimal
     *
     * @ORM\Column(name="vlPagamento", type="decimal", nullable=false)
     */
    protected $vlPagamento;

    /**
     * @ORM\ManyToOne(targetEntity="Pedido", inversedBy="pagamentos")
     * @ORM\JoinColumn(name="idPedido", referencedColumnName="idPedido")
     */
    protected $pedido;

    public function __toString() {
        return "" . $this->getNrPagamento();
    }

    public function getIdPagamento() {
        return $this->idPagamento;
    }
    
    protected function setIdPagamento($idPagamento){
        $this->idPagamento = $idPagamento;
        return $this;
    }

    public function getNrPagamento() {
        return $this->nrPagamento;
    }
    
    protected function setNrPagamento($nrPagamento) {
        $this->nrPagamento = $nrPagamento;
        return $this;
    }

    public function getDtPagamento() {
        return $this->dtPagamento;
    }
    
    protected function setDtPagamento($dtPagamento) {
        $this->dtPagamento = $dtPagamento;
        return $this;
    }
    
    public function getTpPagamento() {
        return $this->tpPagamento;
    }
    
    protected function setTpPagamento($tpPagamento) {
        $this->tpPagamento = $tpPagamento;
        return $this;
    }
    
    public function getQtPeriodo() {
        return $this->qtPeriodo;
    }
    
    protected function setQtPeriodo($qtPeriodo) {
        $this->qtPeriodo = $qtPeriodo;
        return $this;
    }

    public function getVlPagamento() {
        return $this->vlPagamento;
    }
    
    protected function setVlPagamento($vlPagamento) {
        $this->vlPagamento = $vlPagamento;
        return $this;
    }

    public function getPedido() {
        return $this->pedido;
    }
    
    protected function setPedido($pedido) {
        $this->pedido = $pedido;
        return $this;
    }

    public static function persistPagamento($request) {

        $db = new DBAL();
        
        $days = $request['qtPeriodo'];
        
        $request['dtPagamento'] = date('Y-m-d', strtotime($val . " + $days days"));

        $request['vlPagamento'] = str_replace(',', '.', $request['vlPagamento']);

        $id = $db->insert("pagamento", $request);

        return Pedido::find($request['idPedido']);
    }

    // query auxiliar
    public static function getDistinctDates(){

        $db = new DBAL();

        return $db->select("SELECT DISTINCT dtPagamento FROM pagamento");

    }
    
    // query auxiliar
    public static function entradaDia($data){

        $db = new DBAL();
        
        $valor = 0;
        
        if ($data != ""){
            
            if (sizeof($data) < "10"){
                $plusMonth = explode("-", $data)[0] . "-" . sprintf("%02d", explode("-", $data)[1] + 1);
                $qb = $GLOBALS['orm']->createQueryBuilder();
                $pagamentos = $qb->select('p')->from('Pagamento', 'p')->where("p.dtPagamento > '$data'")->andWhere("p.dtPagamento < '$plusMonth'")->getQuery()->getResult();
            }else{
                $pagamentos = Pagamento::findBy(array("dtPagamento" => $data));
            }
            
            foreach($pagamentos as $pagamento){
                if ($pagamento->getPedido()->getTpPedido() == 'V'){
                    $valor += $pagamento->getVlPagamento();
                }
            }
        }else{
            $pagamentos = Pagamento::findAll();
            foreach($pagamentos as $pagamento){
                if ($pagamento->getPedido()->getTpPedido() == 'V'){
                    $valor += $pagamento->getVlPagamento();
                }
            }
        }

        return $valor;

    }
    
    // query auxiliar
    public static function saidaDia($data){

        $db = new DBAL();
        
        $valor = 0;
        
        if ($data != ""){
            
            if (sizeof($data) < "10"){
                $plusMonth = explode("-", $data)[0] . "-" . sprintf("%02d", explode("-", $data)[1] + 1);
                $qb = $GLOBALS['orm']->createQueryBuilder();
                $pagamentos = $qb->select('p')->from('Pagamento', 'p')->where("p.dtPagamento > '$data'")->andWhere("p.dtPagamento < '$plusMonth'")->getQuery()->getResult();
            }else{
                $pagamentos = Pagamento::findBy(array("dtPagamento" => $data));
            }
            
            foreach($pagamentos as $pagamento){
                if ($pagamento->getPedido()->getTpPedido() == 'C'){
                    $valor += $pagamento->getVlPagamento();
                }
            }
        }else{
            $pagamentos = Pagamento::findAll();
            foreach($pagamentos as $pagamento){
                if ($pagamento->getPedido()->getTpPedido() == 'C'){
                    $valor += $pagamento->getVlPagamento();
                }
            }
        }

        return $valor;

    }
    
    // query auxiliar
    public static function entradaAcumulada($data){

        $db = new DBAL();
        
        $valor = 0;
        
        if ($data != ""){
            
            if (sizeof($data) < "10"){
                $plusMonth = explode("-", $data)[0] . "-" . sprintf("%02d", explode("-", $data)[1] + 1);
                $qb = $GLOBALS['orm']->createQueryBuilder();
                $pagamentos = $qb->select('p')->from('Pagamento', 'p')->where("p.dtPagamento <= '$plusMonth'")->getQuery()->getResult();
            }else{
                $qb = $GLOBALS['orm']->createQueryBuilder();
                $pagamentos = $qb->select('p')->from('Pagamento', 'p')->where("p.dtPagamento <= '$data'")->getQuery()->getResult();
            }
            
            foreach($pagamentos as $pagamento){
                if ($pagamento->getPedido()->getTpPedido() == 'V'){
                    $valor += $pagamento->getVlPagamento();
                }
            }
            
        }else{
            $pagamentos = Pagamento::findAll();
            foreach($pagamentos as $pagamento){
                if ($pagamento->getPedido()->getTpPedido() == 'V'){
                    $valor += $pagamento->getVlPagamento();
                }
            }
        }

        return $valor;

    }
    
    // query auxiliar
    public static function saidaAcumulada($data){

        $db = new DBAL();
        
        $valor = 0;
        
        if ($data != ""){
            if (sizeof($data) < "10"){
                $plusMonth = explode("-", $data)[0] . "-" . sprintf("%02d", explode("-", $data)[1] + 1);
                $qb = $GLOBALS['orm']->createQueryBuilder();
                $pagamentos = $qb->select('p')->from('Pagamento', 'p')->where("p.dtPagamento <= '$plusMonth'")->getQuery()->getResult();
            }else{
                $qb = $GLOBALS['orm']->createQueryBuilder();
                $pagamentos = $qb->select('p')->from('Pagamento', 'p')->where("p.dtPagamento <= '$data'")->getQuery()->getResult();
            }
            foreach($pagamentos as $pagamento){
                if ($pagamento->getPedido()->getTpPedido() == 'C'){
                    $valor += $pagamento->getVlPagamento();
                }
            }
        }else{
            $pagamentos = Pagamento::findAll();
            foreach($pagamentos as $pagamento){
                if ($pagamento->getPedido()->getTpPedido() == 'C'){
                    $valor += $pagamento->getVlPagamento();
                }
            }
        }

        return $valor;

    }
    
    // função auxiliar
    public static function totalDia($data){
        $entrada = self::entradaAcumulada($data);
        $saida = self::saidaAcumulada($data);
        return $entrada - $saida;
    }
    
}