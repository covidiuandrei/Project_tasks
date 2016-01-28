<?php

class Task extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'tasks';
        $this->has_created_at = true;
        $this->has_updated_at = true;
    }
    
    public function add($item){
        $item['status'] ='to do';
        return parent::add($item);
    }

}
