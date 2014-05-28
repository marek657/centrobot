<div class="container panel panel-default">
  <div class="panel-body">
    <?php
    $hidden = array('id' => $data['0']->id);

    echo form_open_multipart('/classController/updateclass', '', $hidden);
	?>
	<label for="workname">Class Name</label>
    <input type="text" class="form-control" id="name" value="<?php echo ($data['0']->name); ?>" name="name">

    <h3><?php echo ($this->lang->line("content")); ?></h3>
	<textarea name="content" id="content" rows="10" cols="80"> <?php echo ($data['0']->content); ?> </textarea>
    
    <button type="submit" name="submit" class="btn btn-default"><?php echo ($this->lang->line("save")); ?></button>

    <script>
    	CKEDITOR.replace( 'content', {
			filebrowserWindowWidth: '860',
			filebrowserWindowHeight: '660'
		});
    </script>


  </div>
</div>


