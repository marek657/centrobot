<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo ($data['class']['0']->name); ?></h3>
    </div>
    <div class="panel-body">

      <h3><?php echo ($this->lang->line("content")); ?></h3>
      <p><?php echo ($data['class']['0']->content);?></p>

      <h3><?php echo ($this->lang->line("files")); ?></h3>
      <?php 
      foreach ($data['files'] as $key => $value) {
       ?>
          <?php echo ($value->name); ?> - <a href="<?php echo ($value->link); ?>"><?php echo ($value->filename); ?></a> - 
          <a href="<?php echo base_url(); ?>index.php/classController/deletefile/<?php echo ($value->id); ?>">Delete</a> <br />
        <?php
      }
      ?>


    </div>
  </div>
</div>


