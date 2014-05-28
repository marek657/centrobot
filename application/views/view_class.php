<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo ($data['0']->name); ?></h3>
    </div>
    <div class="panel-body">

      <h3><?php echo ($this->lang->line("content")); ?></h3>
      <p><?php echo ($data['0']->content);?></p>
      <h3><?php echo ("Odošli riešenie"); ?></h3>
      <?php
        $hidden = array('id' => $data['0']->id);
        echo form_open_multipart('classController/sendfile', '', $hidden); 
      ?>
      <label for="InputName"><?php echo ($this->lang->line("name")); ?></label>
      <input type="text" name="name">
      <input type="file" name="userfile" /> <br />
      <button type="submit" name="submit" class="btn btn-default"><?php echo ($this->lang->line("send")); ?></button>

    </div>
  </div>
</div>


