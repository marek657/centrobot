<div class="container panel panel-default">
  <div class="panel-body">
    <?php
		echo form_open('classController/addclass');
	?>
	<label for="workname">Class Name</label>
    <input type="text" class="form-control" id="name" placeholder="Class name" name="name">

    <h3><?php echo ($this->lang->line("content")); ?></h3>
	<textarea name="content" id="content" rows="10" cols="80"></textarea>
    
    <button type="submit" name="submit" class="btn btn-default"><?php echo ($this->lang->line("create_new_class")); ?></button>

    <script>
    	CKEDITOR.replace( 'content', {
			filebrowserWindowWidth: '860',
			filebrowserWindowHeight: '660'
		});
    </script>


  </div>
</div>


