<div class="container">
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading"><?php echo ($this->lang->line("all_robtivies")); ?></div>

	  <!-- Table -->
	  <table class="table">
	  	<thead>
            <tr>
				<th><?php echo ($this->lang->line("name")); ?></th>
				<th><?php echo ($this->lang->line("language")); ?></th>
				<th><?php echo ($this->lang->line("technology")); ?></th>
				<th><?php echo ($this->lang->line("domain")); ?></th>
				<th><?php echo ($this->lang->line("level")); ?></th>
				<th><?php echo ($this->lang->line("add_author")); ?></th>
				<th><?php echo ($this->lang->line("actions")); ?></th>
				<th></th>
        	</tr>
        </thead>
        <tbody>
	    	<?php
			foreach ($data as $key => $value) {
				echo "<tr>";
				echo ("<td>");
				?> 
				<a href="<?php echo base_url(); ?>index.php/robtivityController/viewrobtivity/<?php echo ($value->id_robtivity); ?>/1"> <?php echo ($value->workname); ?></a> 
				<?php
				echo ("</td>");
				echo ("<td>");
				echo ($value->name);
				echo ("</td>");
				echo ("<td>");
				echo ($value->technology_name);
				echo ("</td>");
				echo ("<td>");
				echo ($value->domain_name);
				echo ("</td>");
				echo ("<td>");
				echo ($value->level_name);
				echo ("</td>");
				echo ("<td>");
				$hidden = array('id' => $value->id_robtivity);
	    		echo form_open_multipart('robtivityController/addAuthor', '', $hidden); 
				?>
					<input type="text" name="email">
					<button type="submit" name="submit" class="btn btn-default btn-sm"><?php echo ($this->lang->line("add")); ?></button>
				</form> 
				<?php
				echo ("</td>");
				echo ("<td>");
				?>
				<a href="<?php echo base_url(); ?>index.php/robtivityController/editrobtivity/<?php echo ($value->id_robtivity); ?>" class="btn btn-default btn-sm" role="button"><?php echo ($this->lang->line("edit")); ?></a>
				<a href="<?php echo base_url(); ?>index.php/robtivityController/deleteRobtivity/<?php echo ($value->id_robtivity); ?>" class="btn btn-default btn-sm" role="button"><?php echo ($this->lang->line("delete")); ?></a>
				<?php
				echo ("</td>");
				
				echo "</tr>";
			}
			?>
		</tbody>
	  </table>
	</div>
	<a href="<?php echo base_url(); ?>index.php/robtivityController/createrobtivity"" class="btn btn-default" role="button"><?php echo ($this->lang->line("create_new_robtivity")); ?></a>
</div>