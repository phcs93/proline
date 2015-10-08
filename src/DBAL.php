<?php

//============================================================================
// Data Base Abstraction Layer (DBAL)
//============================================================================
class DBAL {

    // parametros de conexão com o banco de dados
    
// 	protected $hostport = 'localhost:3306';
// 	protected $username = 'root';
// 	protected $password = '';
// 	protected $database = 'proline';

//  protected $hostport = 'mysql.hostinger.com.br';
//  protected $username = 'u159967960_pedro';
//  protected $password = '91471232';
//  protected $database = 'u159967960_pro';

    protected $hostport;
    protected $username;
    protected $password;
    protected $database;

    /**
     * conexão com o banco de dados
     * @var PDO
     */
    protected $connection;

    public function __construct() {
        $this->hostport = getenv('IP');
        $this->username = getenv('C9_USER');
        $this->password = '';
        $this->database = 'c9';
    	$this->connection = new PDO("mysql:host=$this->hostport;dbname=$this->database;charset=utf8", $this->username, $this->password, array(
    		PDO::ATTR_EMULATE_PREPARES => false,
    		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    	));        
    }

    //-------------------------------------------------------------------------
    // select
    //-------------------------------------------------------------------------
    /**
     * executa um select no banco de dados
     * @param String $query select query
     * @return array registros retornados
     */
    function select($query) {

    	$result = $this->connection->query($query);

    	$rows = $result->fetchAll(PDO::FETCH_ASSOC);

    	return $rows;
    }

    //-------------------------------------------------------------------------
    // insert
    //-------------------------------------------------------------------------
    /**
     * executa um insert no banco de dados
     * @param String $table nome da tabela
     * @param array $data campos e valores
     * @return int id do novo registro criado
     */
    function insert($table, $data) {

    	$keys = array();
    	$vals = array();

    	foreach ($data as $key => $val) {
    		$keys[] = "$key";
    		$vals[] = (is_numeric($val)) ? "$val" : ((is_null($val)) ? "null"	: "'$val'");
    	}

    	$this->connection->exec("INSERT INTO $table (" . implode(",", $keys) . ") VALUES (" . implode(",", $vals) . ")");

    	$id = $this->connection->lastInsertId();

    	return $id;
    }

    //-------------------------------------------------------------------------
    // insertMultiple
    //-------------------------------------------------------------------------
    /**
     * executa um insert de varios registros no banco de dados
     * @param String $table nome da tabela
     * @param array $rows array de arrays com campos e valores
     * @return array ids dos novos registros criados
     */
    function insertMultiple($table, $rows) {

        $keys = array();

        foreach ($rows[0] as $key => $val) {
            $keys[] = "$key";
        }

        $values = array();

        foreach($rows as $row){
            $value = array();
            foreach ($row as $key => $val) {
                $value[] = (is_numeric($val)) ? "$val" : ((is_null($val)) ? "null" : "'$val'");
            }
            $values[] = "(" . implode(",", $value) . ")";
        }

        $affectedRows = $this->connection->exec("INSERT INTO $table (" . implode(",", $keys) . ") VALUES " . implode(",", $values));

        $id = $this->connection->lastInsertId();

        $ids = array();

        for($i = $id; $i < $id + $affectedRows; $i++){
            $ids[] = $i;
        }

        return $ids;
    }

    //-------------------------------------------------------------------------
    // update
    //-------------------------------------------------------------------------
    /**
     * executa um update no banco de dados
     * @param String $table nome da tabela
     * @param array $data campos e valores
     * @param int $id id do registro a ser alterado
     * @return int id do registro alterado
     */
    function update($table, $data, $id) {

    	$fields = array();

    	foreach ($data as $key => $val) {
    		$fields[] = (is_numeric($val)) ? "$key = $val" : ((is_null($val)) ? "$key = null" : "$key = '$val'");
    	}

    	$this->connection->exec("UPDATE $table SET " . implode(',', $fields) . " WHERE id$table = $id");

    	return $id;
    }

    //-------------------------------------------------------------------------
    // delete
    //-------------------------------------------------------------------------
    /**
     * executa um delete no banco de dados
     * @param String $table nome da tabela
     * @param String $field nome do campo de clausula
     * @param array $ids ids dos registros
     * @return array ids dos registros removidos
     */
    function delete($table, $field, $ids) {

    	$this->connection->exec("DELETE FROM $table WHERE $field IN ($ids)");

    	return $ids;
    }

}