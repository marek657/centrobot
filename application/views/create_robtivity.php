<div class="container">
	<div class="panel panel-default">
		
		<div class="panel-heading">
			<h3 class="panel-title"><?php echo ($this->lang->line("create_new_robtivity")); ?></h3>
		</div>

		<div class="panel-body">
		    <fieldset>
		    	<?php
					echo form_open('robtivityController/addrobtivity');
				?>
				<div class="form-group">
    				<label for="workname">Workname</label>
    				<input type="text" class="form-control" id="workname" placeholder="Workname" name="workname">
  				</div>
			<div class="row">
	  			<div class="col-md-4">

  				<h4><?php echo ($this->lang->line("technology")); ?></h4><br />
				  	<?php
				  		foreach ($parrentTechnology as $key => $value) {
				  	?> 
						<div class="input-group">
							<span class="input-group-addon">
						    	<input type="radio" name="technology" value="<?php echo ($value->id_technology)?>">
						    </span>
						    <label class="form-control"><?php echo ($value->technology_name)?></label>
						</div><!-- /input-group -->
						<?php $pom = $value->id_technology;
						foreach ($technology as $key => $value) {
							if ($value->id_parrent == $pom) {
						?> 
						<div class="input-group" style="margin-left:40px">
							<span class="input-group-addon">
						    	<input type="radio" name="technology" value="<?php echo ($value->id_technology)?>">
						    </span>
						    <label class="form-control"><?php echo ($value->technology_name)?></label>
						</div><!-- /input-group -->
					<?php
						}} ?><br /> <?php }
					?>
					<a href="<?php echo base_url(); ?>index.php/robtivityController/addtechnologyform" class="btn btn-default" role="button"><?php echo ($this->lang->line("add")); ?></a>
				</div>
				<div class="col-md-4">
				<h4><?php echo ($this->lang->line("domain")); ?></h4><br />
				  	<?php
				  		foreach ($parrentDomain as $key => $value) {
				  	?> 
						<div class="input-group">
							<span class="input-group-addon">
						    	<input type="radio" name="domain" value="<?php echo ($value->id_domain)?>">
						    </span>
						    <label class="form-control"><?php echo ($value->domain_name)?></label>
						</div><!-- /input-group -->
						<?php $pom = $value->id_domain;
						foreach ($domain as $key => $value) {
							if ($value->id_parrent == $pom) {
						?> 
						<div class="input-group" style="margin-left:40px">
							<span class="input-group-addon">
						    	<input type="radio" name="domain" value="<?php echo ($value->id_domain)?>">
						    </span>
						    <label class="form-control"><?php echo ($value->domain_name)?></label>
						</div><!-- /input-group -->
					<?php
						}} ?><br /> <?php }
					?>
					<a href="<?php echo base_url(); ?>index.php/robtivityController/adddomainform" class="btn btn-default" role="button"><?php echo ($this->lang->line("add")); ?></a>
				</div>
				<div class="col-md-4">
				<h4><?php echo ($this->lang->line("level")); ?></h4><br />
				  	<?php
				  		foreach ($parrentLevel as $key => $value) {
				  	?> 
						<div class="input-group">
							<span class="input-group-addon">
						    	<input type="radio" name="level" value="<?php echo ($value->id_level)?>">
						    </span>
						    <label class="form-control"><?php echo ($value->level_name)?></label>
						</div><!-- /input-group -->
						<?php $pom = $value->id_level;
						foreach ($level as $key => $value) {
							if ($value->id_parrent == $pom) {
						?> 
						<div class="input-group" style="margin-left:40px">
							<span class="input-group-addon">
						    	<input type="radio" name="level" value="<?php echo ($value->id_level)?>">
						    </span>
						    <label class="form-control"><?php echo ($value->level_name)?></label>
						</div><!-- /input-group -->
					<?php
						}} ?><br /> <?php }
					?>
					<a href="<?php echo base_url(); ?>index.php/robtivityController/addlevelform" class="btn btn-default" role="button"><?php echo ($this->lang->line("add")); ?></a>
				</div><!-- /.col-lg-6 -->
				</div><!-- /.row -->
				<br />
				<button type="submit" name="submit" class="btn btn-default"><?php echo ($this->lang->line("create_new_robtivity")); ?></button>
			 </fieldset>
	  </div><!-- /.panel-body -->
	</div><!-- /.panel -->
</div><!-- /.container -->