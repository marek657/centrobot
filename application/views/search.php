<div class="container">
	<div class="panel panel-default">
		
		<div class="panel-heading">
			<h3 class="panel-title"><?php echo ($this->lang->line("nav_search")); ?></h3>
		</div>

		<div class="panel-body">
		    <fieldset>
		    	<?php
					echo form_open('searchController/search');
				?>
				<div class="form-group">
    				<label for="keywords"><?php echo ($this->lang->line("keywords")); ?></label>
    				<input type="text" class="form-control" id="keywords" placeholder="<?php echo ($this->lang->line("keywords")); ?>" name="keywords">
  				</div>
			<div class="row">
	  			<div class="col-md-4">

  				<h4><?php echo ($this->lang->line("technology")); ?></h4><br />
				  	<?php
				  		foreach ($parrentTechnology as $key => $value) {
				  	?> 
						<div class="input-group">
							<span class="input-group-addon">
						    	<input type="radio" name="technology" value="<?php echo ($value->id)?>">
						    </span>
						    <label class="form-control"><?php echo ($value->technology_name)?></label>
						</div><!-- /input-group -->
						<?php $pom = $value->id_technology;
						foreach ($technology as $key => $value) {
							if ($value->id_parrent == $pom) {
						?> 
						<div class="input-group" style="margin-left:40px">
							<span class="input-group-addon">
						    	<input type="radio" name="technology" value="<?php echo ($value->id)?>">
						    </span>
						    <label class="form-control"><?php echo ($value->technology_name)?></label>
						</div><!-- /input-group -->
					<?php
						}} ?><br /> <?php }
					?>

				</div>
				<div class="col-md-4">
				<h4><?php echo ($this->lang->line("domain")); ?></h4><br />
				  	<?php
				  		foreach ($parrentDomain as $key => $value) {
				  	?> 
						<div class="input-group">
							<span class="input-group-addon">
						    	<input type="radio" name="domain" value="<?php echo ($value->id)?>">
						    </span>
						    <label class="form-control"><?php echo ($value->domain_name)?></label>
						</div><!-- /input-group -->
						<?php $pom = $value->id_domain;
						foreach ($domain as $key => $value) {
							if ($value->id_parrent == $pom) {
						?> 
						<div class="input-group" style="margin-left:40px">
							<span class="input-group-addon">
						    	<input type="radio" name="domain" value="<?php echo ($value->id)?>">
						    </span>
						    <label class="form-control"><?php echo ($value->domain_name)?></label>
						</div><!-- /input-group -->
					<?php
						}} ?><br /> <?php }
					?>
				</div>
				<div class="col-md-4">
				<h4><?php echo ($this->lang->line("level")); ?></h4><br />
				  	<?php
				  		foreach ($parrentLevel as $key => $value) {
				  	?> 
						<div class="input-group">
							<span class="input-group-addon">
						    	<input type="radio" name="level" value="<?php echo ($value->id)?>">
						    </span>
						    <label class="form-control"><?php echo ($value->level_name)?></label>
						</div><!-- /input-group -->
						<?php $pom = $value->id_level;
						foreach ($level as $key => $value) {
							if ($value->id_parrent == $pom) {
						?> 
						<div class="input-group" style="margin-left:40px">
							<span class="input-group-addon">
						    	<input type="radio" name="level" value="<?php echo ($value->id)?>">
						    </span>
						    <label class="form-control"><?php echo ($value->level_name)?></label>
						</div><!-- /input-group -->
					<?php
						}} ?><br /> <?php }
					?>
				
				</div><!-- /.col-lg-6 -->
				</div><!-- /.row -->
				<button type="submit" name="submit" class="btn btn-default"><?php echo ($this->lang->line("nav_search")); ?></button>
			 </fieldset>
	  </div><!-- /.panel-body -->
	</div><!-- /.panel -->
</div><!-- /.container -->