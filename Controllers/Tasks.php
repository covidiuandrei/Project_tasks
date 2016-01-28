<?php
include_once 'Models/Task.php';
include_once 'Models/Logs.php';

class Tasks extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->model = new Task();
        session_start(); 
        $token = md5(rand(1000,9999)); //you can use any encryption
        $_SESSION['token'] = $token;
        $this->data['token'] = $token;
    }

    public function index() {
        $this->data['page'] = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $skip = $this->config['tasks_per_page'] *($this->data['page']-1);
        if (isset($_GET['field'])&&isset($_GET['order'])) {
            $order_by = array(
                'field'=>$_GET['field'],
                'order'=>$_GET['order']
            );
        } else {
            $order_by = null;
        }
        if (isset($_GET['search']) && $_GET['search']) {
            $search = array(
                'cols'=> array('name','description'),
                'text'=>$_GET['search']
            );
        } else {
            $search = null;
        }
        $this->data['tasks'] = $this->model->all($this->config['tasks_per_page'],$skip,$order_by,$search);
        $total= $this->model->total($search);
        $this->data['pages'] = ceil($total/$this->config['tasks_per_page']);
        $this->render('tasks');
    }
    
    public function add(){
        $this->render('add_task');
    }
    
    public function edit($id){
        if ($_POST) {
            $task_date = new DateTime($_POST['date']);
            $current_date = new DateTime();

            if ($task_date < $current_date || !$_POST['description'] || !$_POST['name'])
            {
              die('Invalid DATA!');
            } else {
                $item = array(
                    'name'=> $_POST['name'],
                    'description'=>$_POST['description'],
                    'status' =>$_POST['status'],
                    'date' => $task_date->format('Y-m-d')
                );
                $this->model->update($id,$item);
            }
        }
        $this->loadHelper('general');
        $this->data['task'] = $this->model->get($id);
        $this->render('edit_task');
    }
    
    public function delete($id){
        $this->data['task'] = $this->model->get($id);
        if ($this->data['task']) {
            $this->model->delete($id);
            $this->model = new Logs();
            $item = array(
                'text'=>'Deleted the task: '.$this->data['task']['name'],
                'type'=>'delete',
                'data'=>  json_encode($this->data['task'])
            );
            $this->model->add($item);
        }
        header('Location: '.$this->config['site_url'].'/tasks');
    }

}

