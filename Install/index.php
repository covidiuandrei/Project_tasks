<?php
include_once '../System/Config.php';
include_once '../System/Model.php';

class Install extends Model {
    public function _construct() {
        parent::_construct();
    }
    public function index(){
        $result = $this->run_query("
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `tasks`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
  
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(10) NOT NULL,
  `text` text NOT NULL,
  `type` varchar(20) NOT NULL,
  `created_at` int(11) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `logs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;");
    }
}
$install = new Install();
$install->index();
