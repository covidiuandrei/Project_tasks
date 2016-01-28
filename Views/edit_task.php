<div class="container">
    <h3 class="text-center">Add new Task</h3>
    <hr/>
    <form class="form-horizontal" id="edit-task-form" role="form" method="post">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Task name ... " value="<?php echo post_value('name',$this->data['task']['name']); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="message" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="4" name="description" placeholder="Task description ..."><?php echo post_value('description',$this->data['task']['description']); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Status</label>
            <div class="col-sm-10">
                <select name="status" value="">
                    <option value="done" <?php if($this->data['task']['status']=='done'){echo 'selected="selected"';} ?> >Done</option>
                    <option value="to do"<?php if($this->data['task']['status']=='to do'){echo 'selected="selected"';} ?> >To Do</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Date</label>
            <div class="col-sm-10">
                <input type="text" class="datepicker" name="date" value="<?php echo post_value('date',$this->data['task']['date']); ?>">
            </div>
        </div>
        <hr/>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <a href="<?php echo $this->config['site_url'] . '/tasks'; ?>"  class="btn btn-danger pull-left">View tasks</a>
                <input id="submit" name="Save" type="submit" value="Save" class="btn btn-success pull-right"/>
            </div>
        </div>


    </form>
</div>