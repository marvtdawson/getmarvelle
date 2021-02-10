<?php
/**
 * Created by PhpStorm.
 * User: mdawson
 * Date: 9/8/16
 * Time: 12:39 AM
 */

namespace library\Models;
use PDO;
use PDOException;
use Library\Iscriptz\IConnect2Db;

class Model implements IConnect2Db
{

    private static $_instance = null;
    private $_pdo,
        $_query,
        $_error = false,
        $_results,
        $_count = 0;
    public static $tableName;


    private function __construct(){
        // try to connect using a interface connection
        try{
<<<<<<< HEAD
            $this->_pdo = new PDO('mysqli:host=' . IConnect2Db::CLIENTHOST . ';dbname=' . IConnect2Db::CLIENTDB,
                                                  IConnect2Db::CLIENTUSER,
                                                  IConnect2Db::CLIENTPW);
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
=======
//            $this->_pdo = new PDO('mysql:host=' . IConnect2Db::CLIENTHOST . ';dbname=' . IConnect2Db::CLIENTDB,
//                                                  IConnect2Db::CLIENTUSER,
//                                                  IConnect2Db::CLIENTPW);
//            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
>>>>>>> 793796f210c68196d44f7c33fcaea79da934cfb3
        }
        catch(PDOException $e){
            die($e->getMessage());
        }

    }

    /**
     * @return Model|null
     * make sure that we only connect to db ONCE
     * and instantiate object using $_instance
     * goal to save on db connection queries
     */
    public static function getInstance(){
        if(!isset(self::$_instance)){ // if $_instance not set
            self::$_instance = new Model(); // then set $_instance
        }
        return self::$_instance;
    }

    /**
     * @param $sql string
     * @param array $params
     * @return $this
     * this query function is for using the INSERT INTO of new data into a table
     */
    public function query($sql, $params = array())
    {
        $this->_error= false;  // reset error back to false

        // check if the query is prepare properly
        if($this->_query = $this->_pdo->prepare($sql)){
            $x = 1;
            if(count($params)){
                foreach($params as $param){
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if($this->_query->execute()) {

                // store result set
                $this->_count = $this->_query->rowCount();
            }

        }else{
                $this->_error = true;
            }
        return $this;
    }

    /**
     * @param $sql
     * @param array $params
     * this updateQuery function is for select or update new data into the register table
     */
    public function updateQuery($sql, $params = array())
    {
        $this->_error= false;  // reset error back to false

        // check if the query is prepare properly
        if($this->_query = $this->_pdo->prepare($sql)){
            $x = 1;
            if(count($params)){
                foreach($params as $param){
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if($this->_query->execute()) {

                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);

                // store result set
                $this->_count = $this->_query->rowCount();
            }

        }else{
            $this->_error = true;
        }
    }

    public function action($action, $table, $where = array()){
        if(count($where) === 3){
            $operators = array('=', '>', '<', '<=', '>=');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if(in_array($operator, $operators)){

                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ? " ;

                if($action === 'SELECT *'){
                    if(!$this->updateQuery($sql, array($value))) {
                        return $this;
                    }
                }
                elseif($action !== 'SELECT *'){ // user is registering
                    if(!$this->query($sql, array($value))->error()) {
                        return $this;
                    }
                }
            }
        }
        return false;
    }

    public function get($table, $where){

        return $this->action('SELECT *', $table, $where);
    }

    public function delete($table, $where){
        return $this->action('DELETE', $table, $where);
    }

    // insert user data
    public function insert($table, $fields = array())
    {
        if(count($fields)) {
            $keys = array_keys($fields);
            $values = '';
            $x = 1;

            foreach ($fields as $field) { // loop through each field input element

                $values .= '?';

                // check if $x value is less than the number or count of field elements
                // to see if we are at the end of the number of field elements in form
                // if not add a comma to the end of each field element value as a separator
                if ($x < count($fields)) {
                    $values .= ', ';
                }
                // increment $x value
                $x++;
            }

            // prepare sql statement
            $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

            if (!$this->query($sql, $fields)->error()) {
                return true;
            }

        }
            return false;
    }


    /**
     * @param $table
     * @param $id
     * @param $fields
     * @return bool
     * Universal Update function for entire application
     */
    public function update($table, $id, $fields)
    {
        $set = '';
        $x = 1;

        foreach($fields as $name => $value){
            $set .= "{$name} = ?";
            if($x < count($fields)){
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

        if(!$this->query($sql, $fields)->error()){
            return true;
        }
        return false;
    }

    public function first()
    {
        return $this->results()[0];
    }

    public function last()
    {
        $getLastIdInserted = $this->_pdo->lastInsertId();
        return $getLastIdInserted;
    }


    public function error()
    {
        return $this->_error;
    }

    public function count()
    {
        return $this->_count;
    }

    /**
     * @return mixed
     * return results of query
     */
    public function results(){
        return $this->_results;
    }

    public static function checkTableName($table)
    {
        self::$tableName = $table;
        return self::$tableName;
    }

}