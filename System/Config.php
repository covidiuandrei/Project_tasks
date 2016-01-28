<?php

global $config;
$config = array();

/**** GENERAL ****/
$config['site_url'] = "http://localhost:8080/project";
$config['default_controller'] = 'tasks';
$config['tasks_per_page'] = 5;

/**** DATABASE ****/
$config['hostname'] = 'localhost';
$config['user'] = 'root';
$config['password'] = '';
$config['database'] = 'tasks';