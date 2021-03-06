<div class="container">
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title"><?php echo ($data['0']->name);?></h3>
	  </div>
	  <div class="panel-body">
	  		<?php 
	  			$pom = $data['robtivity_rank']['0']->total_value / $data['robtivity_rank']['0']->total_votes;
	  			?>
	  			<h3>Rank:</h3>
	  			<h4>Average rank: <?php echo($pom); ?> </h4><br />
	  			
	    	<h3><?php echo ($this->lang->line("content")); ?></h3>
				<p><?php echo ($data['0']->content);?></p>

			<h3><?php echo ($this->lang->line("required_knowledge")); ?></h3>
				<?php echo ($data['0']->required_knowledge); ?>

			<h3><?php echo ($this->lang->line("time_consumption")); ?></h3>
				<?php echo ($data['0']->time_consumption); ?>

			<h3><?php echo ($this->lang->line("enviroment")); ?></h3>
				<?php echo ($data['0']->enviroment); ?>

			<h3><?php echo ($this->lang->line("equipment")); ?></h3>
				<?php echo ($data['0']->equipment); ?>

			<h3><?php echo ($this->lang->line("presentations")); ?></h3>
				<?php echo ($data['0']->presentations); ?>
				<?php 
	    		foreach ($data['presentations_files'] as $key => $value) {
	    			?>
	    				<a href="<?php echo ($value->link); ?>"><?php echo ($value->name); ?></a> - 
	    			<?php
	    			echo($value->desc);
	    		}
	    	?>

			<h3><?php echo ($this->lang->line("papers")); ?></h3>
				<?php echo ($data['0']->papers); ?>
				<?php 
	    		foreach ($data['papers_files'] as $key => $value) {
	    			?>
	    				<a href="<?php echo ($value->link); ?>"><?php echo ($value->name); ?></a> - 
	    			<?php
	    			echo($value->desc);
	    		}
	    	?>

			<h3><?php echo ($this->lang->line("student_description")); ?></h3>
				<?php echo ($data['0']->student_description); ?>

			<h3><?php echo ($this->lang->line("multimedia_artifacts")); ?></h3>
				<?php echo ($data['0']->multimedia_artifacts); ?>
				<?php 
	    		foreach ($data['multimedia_files'] as $key => $value) {
	    			?>
	    				<a href="<?php echo ($value->link); ?>"><?php echo ($value->name); ?></a> - 
	    			<?php
	    			echo($value->desc);
	    		}
	    	?>

			<h3><?php echo ($this->lang->line("construction_manual")); ?></h3>
				<?php echo ($data['0']->construction_manual); ?>

			<h3><?php echo ($this->lang->line("components_desription")); ?></h3>
				<?php echo ($data['0']->components_desc); ?>

			<h3><?php echo ($this->lang->line("faq")); ?></h3>
				<?php echo ($data['0']->faq); ?>

			<h3><?php echo ($this->lang->line("robtivity_resources")); ?></h3>
				<?php echo ($data['0']->robtivity_resources); ?>

			<h3><?php echo ($this->lang->line("general_resources")); ?></h3>
				<?php echo ($data['0']->general_resources); ?>
		</form>

		<script > $("#input-id").rating(); </script>
		<h3><?php echo ($this->lang->line("comments")); ?></h3>
		<div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'centrobot'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
    
	  </div>
	</div>
</div>

