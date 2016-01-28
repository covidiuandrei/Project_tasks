<?php

include_once 'Models/Task.php';

class Ajax extends Controller {

    protected $actions = array(
        'get-tasks' => 'get_tasks',
        'add-task' => 'add_task'
    );

    public function __construct() {
        parent::__construct();
        $this->model = new Task();
    }

    public function dispatch() {
        session_start(); 
        if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') { 
            //Request identified as ajax request 
            
            if(@isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'],$this->config['site_url'])===0) {
                //HTTP_REFERER verification
                if($_POST['token'] == $_SESSION['token']) {
                    $action = $_REQUEST['action']; 

                    if (!array_key_exists($action, $this->actions)) {
                        return;
                    } else {
                        $method = $this->actions[$action];
                        call_user_func(array(&$this, $method));
                    } 
                }
                else { 
                    die('Not allowed '); 
                }
            } 
            else { 
                die('Not allowed'); 
            }
        } 
        else { 
            die('Not allowed'); 
        }
        
    }

    private function get_tasks() {
        $this->data['tasks'] = $this->model->all();
        echo json_encode($this->data['tasks']);
    }
    
    private function add_task(){
        $task_date = new DateTime($_POST['date']);
        $current_date = new DateTime();

        if ($task_date < $current_date || !$_POST['description'] || !$_POST['name'])
        {
          die('Invalid DATA!');
        } else {
            $item = array(
                'name'=> $_POST['name'],
                'description'=>$_POST['description'],
                'date' => $task_date->format('Y-m-d')
            );
            $id = $this->model->add($item);
            $response = array(
                'Result' => 'OK',
                'Message' => 'Task added succesfully with the id: '.$id
            );
            echo json_encode($response);
        }
        
    }

    

}
