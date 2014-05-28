<div class="container">
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading"><?php echo ($this->lang->line("nav_users")); ?></div>

	  <!-- Table -->
	  <table class="table">
	  	<thead>
            <tr>
				<th><?php echo ($this->lang->line("first_name")); ?></th>
				<th><?php echo ($this->lang->line("last_name")); ?></th>
				<th><?php echo ($this->lang->line("email")); ?></th>
				<th><?php echo ($this->lang->line("actions")); ?></th>
				<th></th>
        	</tr>
        </thead>
        <tbody>
	    	<?php
			foreach ($data as $key => $value) {
				echo "<tr>";
				echo ("<td>");
				echo ($value->name);
				echo ("</td>");
				echo ("<td>");
				echo ($value->lastname);
				echo ("</td>");
				echo ("<td>");
				echo ($value->email);
				echo ("</td>");
				echo ("<td>");
				?>
				<a href="<?php echo base_url(); ?>index.php/adminController/promoteUser/<?php echo ($value->id); ?>" class="btn btn-default btn-sm" role="button"><?php echo ($this->lang->line("promote")); ?></a>
				<a href="<?php echo base_url(); ?>index.php/adminController/removeUser/<?php echo ($value->id); ?>" class="btn btn-default btn-sm" role="button"><?php echo ($this->lang->line("delete")); ?></a>
				<?php
				echo ("</td>");
				
				echo "</tr>";
			}
			?>
		</tbody>
	  </table>
	</div>
</div>