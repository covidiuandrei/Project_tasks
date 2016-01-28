<?php

class Model {

    protected $table;
    protected $_db;
    protected $has_created_at = false;
    protected $has_updated_at = false;

    public function __construct() {
        global $config;
        $this->_db =  new mysqli($config['hostname'], $config['user'], $config['password'], $config['database']);
    }

    public function run_query($query) {
        $result = $this->_db->multi_query ( $query);
        if (!$result) {
            die('Invalid query: ' . $this->_db->error);
        }
        return $result;
    }
    
    public function get($id) {
        $query = "SELECT * FROM ".$this->table;
        if ($id) {
            $query .= " WHERE id = ".$this->_db->real_escape_string ($id);
        }
        $result = $this->_db->query( $query);
        if (!$result) {
            die('Invalid query: ' . $this->_db->error);
        }
        return $result->fetch_assoc();
        
    }

    public function add($item) {
        if ($this->has_created_at) {
            $item['created_at'] = date('Y-m-d h:i:s', time());
        }
        if ($this->has_updated_at) {
            $item['updated_at'] = date('Y-m-d h:i:s', time());
        }
        $into = ''; $values = '';
        foreach ($item as $key=>$value){
            $into .= $this->_db->real_escape_string ($key).',';
            $values .= '"'.$this->_db->real_escape_string ($value).'",';
        }
        $query = 'INSERT INTO '.$this->table .' ('.trim($into,',').') VALUES ('.trim($values,',').');';
        $result = $this->_db->query( $query);
        if (!$result) {
            die('Invalid query: ' . $this->_db->error);
        }
        return $this->_db->insert_id;
    }
    
    public function update($id,$item) {
        if ($this->has_updated_at) {
            $item['updated_at'] = date('Y-m-d h:i:s', time());
        }
        $update = ' '; 
        foreach ($item as $key=>$value){
            $update .= $this->_db->real_escape_string ($key).'='.'"'.$this->_db->real_escape_string ($value).'", ';
        }
        $update = trim($update,', ');
        $query = 'UPDATE '.$this->table .' SET '.$update.' WHERE id = '.$id.';';
        $result = $this->_db->query( $query);
        
        return $result;
    }

    public function delete($id) {
        $query = "DELETE FROM ".$this->table;
        if ($id) {
            $query .= " WHERE id = ".$this->_db->real_escape_string ($id);
        }
        $result = $this->_db->query( $query);
        if (!$result) {
            die('Invalid query: ' . $this->_db->error);
        }
        return true;
    }
    
    public function all($limit = null,$skip = null, $order_by = null, $search = null) {
        $query = "SELECT * FROM ".$this->table;
        if ($search) {
             $query .= " WHERE ";
             foreach ($search['cols'] as $col) {
                $query .= $col. " LIKE '%".$this->_db->real_escape_string($search['text'])."%' OR ";
             }
             $query = trim($query, 'OR ');
        }
        if ($order_by){
            $query .= ' ORDER BY '.$this->_db->real_escape_string ($order_by['field']).' '.$this->_db->real_escape_string ($order_by['order']);
        }
        if ($limit && $skip!==null) {
            $query .=' LIMIT '.$this->_db->real_escape_string ($skip).', '.$this->_db->real_escape_string ($limit);
        }
        $result = $this->_db->query( $query);
        if (!$result) {
            return null;
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function total($search = null) {
        $query = "SELECT * FROM ".$this->table;
        if ($search) {
             $query .= " WHERE ";
             foreach ($search['cols'] as $col) {
                $query .= $col. " LIKE '%".$this->_db->real_escape_string($search['text'])."%' OR ";
             }
             $query = trim($query, 'OR ');
        }
        
        $result = $this->_db->query( $query);
        if (!$result) {
            return 0;
        }
        return $result->num_rows;
    }

}

?>