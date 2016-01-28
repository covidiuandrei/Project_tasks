<div class="container">
    <?php if (isset($this->data['tasks']) && count($this->data['tasks']) > 0): ?>
    <form method="GET" action="<?php echo $this->config['site_url'].'/tasks'; ?>">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search" >
                <span class="input-group-btn">
                    <button class="btn btn-default" type="default">GO!</button>
                </span>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <?php foreach (array_keys(current($this->data['tasks'])) as $field) { ?>
                        <th>
                            <?php if (isset($_GET['field']) && isset($_GET['order']) && $_GET['field'] == $field && $_GET['order'] == 'ASC') { ?>
                                <a href="<?php echo $this->config['site_url'] . '/tasks/?'.http_build_query(array_merge($_GET, ['field'=> $field , 'order'=>'DESC'])); ?>"><?php echo $field ?><span class="glyphicon glyphicon-arrow-down"></span></a>
                            <?php } else if (isset($_GET['field']) && $_GET['field'] == $field) { ?>
                                <a href="<?php echo $this->config['site_url'] . '/tasks/?'.http_build_query(array_merge($_GET, ['field'=> $field , 'order'=>'ASC'])); ?>"><?php echo $field ?><span class="glyphicon glyphicon-arrow-up"></span></a>
                            <?php } else { ?>
                                <a href="<?php echo $this->config['site_url'] . '/tasks/?'.http_build_query(array_merge($_GET, ['field'=> $field , 'order'=>'ASC'])); ?>"><?php echo $field ?></span></a>
                            <?php } ?>
                        </th>
                    <?php } ?>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->data['tasks'] as $row): array_map('htmlentities', $row); ?>
                    <tr>
                        <td><?php echo implode('</td><td>', $row); ?></td>
                        <td>
                            <a class="btn btn-default" href="<?php echo $this->config['site_url'] . '/tasks/edit/' . $row['id']; ?>"><span class="glyphicon glyphicon-edit"></span></a>
                            <a class="btn btn-default" href="<?php echo $this->config['site_url'] . '/tasks/delete/' . $row['id']; ?>" onclick="return confirm('Are you sure?')"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <div class="row">
        <nav>
        <ul class="pagination">
        <?php if ($this->data['page']>1) { ?>
          <li>
            <a href="<?php echo $this->config['site_url'].'/tasks?'.http_build_query(array_merge($_GET, ["page" => $this->data['page']-1])); ?>" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
        <?php } else { ?>
            <li>
                <a href="" class="btn disabled" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
          </li>
        <?php } ?>
          <?php for($i=1;$i<=$this->data['pages'];$i++) { 
              if ($i != $this->data['page'] ) {?>
                <li><a href="<?php echo $this->config['site_url'].'/tasks?'.http_build_query(array_merge($_GET, ["page" =>$i])); ?>"><?php echo $i ?></a></li>
          <?php } else { ?>
                <li><a href="" class="btn disabled" ><?php echo $i ?></a></li>
          <?php }}?>
          <?php if ($this->data['page']<$this->data['pages']) { ?>
          <li>
            <a href="<?php echo $this->config['site_url'].'/tasks?'.http_build_query(array_merge($_GET, ["page" => $this->data['page']+1])); ?>" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        <?php } else { ?>
            <li>
                <a href="" class="btn disabled" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
          </li>
        <?php } ?>
          
        </ul>
      </nav>
        <a href="<?php echo $this->config['site_url'].'/tasks/add/'; ?>" class="btn btn-success pull-right"><span class="glyphicon-plus"></span> ADD</a>
    </div>
    <?php else: ?>
    <form method="GET" action="<?php echo $this->config['site_url'].'/tasks'; ?>">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search" >
                <span class="input-group-btn">
                    <button class="btn btn-default" type="default">GO!</button>
                </span>
            </div>
        </form>
    <h4> No results </h4>
    <?php endif; ?>
</div>