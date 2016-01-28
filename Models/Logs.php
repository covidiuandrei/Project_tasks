<?php

class Logs extends Model {

    public function __construct() {
        parent::__construct();
        $this->table = 'logs';
        $this->has_created_at = true;
    }
}
