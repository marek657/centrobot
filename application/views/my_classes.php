<div class="container">
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading"><?php echo ($this->lang->line("my_classes")); ?></div>

	  <!-- Table -->
	  <table class="table">
	  	<thead>
            <tr>
				<th><?php echo ($this->lang->line("name")); ?></th>
				<th></th>
        	</tr>
        </thead>
        <tbody>
	    	<?php
			foreach ($data as $key => $value) {
				echo "<tr>";
				echo ("<td>");
				?> 
				<a href="<?php echo base_url(); ?>index.php/classController/viewclass/<?php echo ($value->id); ?>"> <?php echo ($value->name); ?></a> 
				<?php
				echo ("</td>");
				echo ("<td>");
				?>
				<a href="<?php echo base_url(); ?>index.php/classController/editclass/<?php echo ($value->id); ?>" class="btn btn-default btn-sm" role="button"><?php echo ($this->lang->line("edit")); ?></a>
				<a href="<?php echo base_url(); ?>index.php/classController/deleteClass/<?php echo ($value->id); ?>" class="btn btn-default btn-sm" role="button"><?php echo ($this->lang->line("delete")); ?></a>
				<?php
				echo ("</td>");
				echo "</tr>";
			}
			?>
		</tbody>
	  </table>
	</div>
	<a href="<?php echo base_url(); ?>index.php/classController/createclass"" class="btn btn-default" role="button"><?php echo ($this->lang->line("create_new_class")); ?></a>
</div>