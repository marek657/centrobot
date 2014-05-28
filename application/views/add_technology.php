<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo ($this->lang->line("add_technology")); ?></h3>
    </div>
    <div class="panel-body">
    	<?php 
	    	echo ("<h3>" . $this->lang->line("add_names") . "</h3>");
	    	echo form_open('robtivityController/addTechnology'); 
	    	foreach ($data['languages'] as $key => $value) {
	    		?>
	    		<div class="form-group">
					<label for="InputName"><?php echo $value->name; ?></label>
					<input type="text" name="<?php echo $value->id; ?>" value="" class="form-control" >
				</div>
	    		<?php
	    	}

	    	echo ("<h3>" . $this->lang->line("add_parrent") . "</h3>");
    	?>

    	<select name="id_parrent" class="form-control">
    		<option value="0" >-</option>
    		<?php
    			foreach ($data['technology'] as $key => $value) {
    		?>
    			<option value="<?php echo $value->id_technology; ?>" ><?php echo $value->technology_name; ?></option>
    		<?php }	?>
		</select>
    	<br />
    	<button type="submit" name="submit" class="btn btn-default btn-sm"><?php echo ($this->lang->line("add")); ?></button>
    	</form>
    </div>
  </div>
</div>