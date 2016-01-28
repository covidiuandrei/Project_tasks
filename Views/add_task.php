<div class="container">
    <h3 class="text-center">Add new Task</h3>
    <hr/>
    <form class="form-horizontal" id="add-task-form" role="form" method="post">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" placeholder="Task name ... " value="">
            </div>
        </div>
        <div class="form-group">
            <label for="message" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="4" name="description" placeholder="Task description ..."></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Date</label>
            <div class="col-sm-10">
                <input type="text" class="datepicker" name="date">
            </div>
        </div>
        <hr/>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <a href="<?php echo $this->config['site_url'] . '/tasks'; ?>"  class="btn btn-danger pull-left">View tasks</a>
                <input id="submit" name="Add" type="submit" value="Add" class="btn btn-success pull-right"/>
            </div>
        </div>


    </form>
</div>