<div class="container">
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title"><?php echo ($data['0']->name); ?></h3>
	  </div>
	  <div class="panel-body">

	    <?php 
	   // print_r($data);
	    	echo("<h3>" . $this->lang->line("authors") . "</h3>");
	    	foreach ($data['authors'] as $key => $value) {
	    		echo($value->name . " " . $value->lastname . " - " . $value->email . " - ");
	    		?>
	    		<a href="<?php echo base_url(); ?>index.php/adminController/removeAuthor/<?php echo ($data['0']->id_robtivity); ?>/<?php echo ($value->id); ?>">Remove</a> <br />
	    		<?php
	    	}


	    	$hidden = array('id' => $data['0']->id_robtivity, 'id_lang' => $data['0']->id_lang);

	    	echo form_open_multipart('robtivityController/updaterobtivity', '', $hidden); 
	    ?>
	    	<h3><?php echo ($this->lang->line("pictures")); ?></h3>
	    	<?php 
	    		foreach ($data['pictures_files'] as $key => $value) {
	    			?>
	    				<a href="<?php echo ($value->link); ?>"><?php echo ($value->name); ?></a> - 
	    				<a href="<?php echo base_url(); ?>index.php/robtivityController/deletefile/<?php echo ($value->id); ?>">Delete</a> <br />
	    			<?php
	    		}
	    	?>
	    	<input type="file" name="pictures[]" multiple="multiple" />

	    	<h3><?php echo ($this->lang->line("name")); ?></h3>
	    	<input type="text" name="Rname" value="<?php echo ($data['0']->name); ?>" class="form-control"><br>

	    	<h3><?php echo ($this->lang->line("keywords")); ?></h3>
	    	<input type="text" name="keywords" value="<?php echo ($data['0']->keywords); ?>" class="form-control"/>
	    	

	    	<h3><?php echo ($this->lang->line("content")); ?></h3>
	    	<ul><li><?php echo ($this->lang->line("content_desc")); ?></li></ul>
	    	<textarea name="content" id="content" rows="10" cols="80">
				<?php echo ($data['0']->content); ?>
			</textarea>

			<h3><?php echo ($this->lang->line("required_knowledge")); ?></h3>
			<ul><li><?php echo ($this->lang->line("required_knowledge_desc")); ?></li></ul>
			<textarea name="required_knowledge" id="required_knowledge" rows="10" cols="80">
				<?php echo ($data['0']->required_knowledge); ?>
			</textarea>

			<h3><?php echo ($this->lang->line("time_consumption")); ?></h3>
			<ul><li><?php echo ($this->lang->line("time_consumption_desc")); ?></li></ul>
			<textarea name="time_consumption" id="time_consumption" rows="10" cols="80">
				<?php echo ($data['0']->time_consumption); ?>
			</textarea>

			<h3><?php echo ($this->lang->line("enviroment")); ?></h3>
			<ul><li><?php echo ($this->lang->line("enviroment_desc")); ?></li></ul>
			<textarea name="enviroment" id="enviroment" rows="10" cols="80">
				<?php echo ($data['0']->enviroment); ?>
			</textarea>

			<h3><?php echo ($this->lang->line("equipment")); ?></h3>
			<ul><li><?php echo ($this->lang->line("equipment_desc")); ?></li></ul>
			<textarea name="equipment" id="equipment" rows="10" cols="80">
				<?php echo ($data['0']->equipment); ?>
			</textarea>

			<h3><?php echo ($this->lang->line("presentations")); ?></h3>
			<ul><li><?php echo ($this->lang->line("presentations_desc")); ?></li></ul>
				<div class="form-group">
					<label for="files_presentations_description"><?php echo ($this->lang->line("description")); ?></label>
					<input type="text" name="files_presentations_description" class="form-control"/>
					<label for="files_presentations[]"><?php echo ($this->lang->line("files")); ?></label>
					<input type="file" name="files_presentations[]" multiple="multiple"/>
				</div>            	
            <?php 
	    		foreach ($data['presentations_files'] as $key => $value) {
	    			?>
	    				<a href="<?php echo ($value->link); ?>"><?php echo ($value->name); ?></a> - 
	    				<a href="<?php echo base_url(); ?>index.php/robtivityController/deletefile/<?php echo ($value->id); ?>">Delete</a> <br />
	    			<?php
	    		}
	    	?>


			<h3><?php echo ($this->lang->line("papers")); ?></h3>
			<ul><li><?php echo ($this->lang->line("papers_desc")); ?></li></ul>
				<div class="form-group">
					<label for="files_papers_description"><?php echo ($this->lang->line("description")); ?></label>
					<input type="text" name="files_papers_description" class="form-control"/>
					<label for="files_papers[]"><?php echo ($this->lang->line("files")); ?></label>
					<input type="file" name="files_papers[]" multiple="multiple"/>
				</div> 
			<?php 
	    		foreach ($data['papers_files'] as $key => $value) {
	    			?>
	    				<a href="<?php echo ($value->link); ?>"><?php echo ($value->name); ?></a> - 
	    				<a href="<?php echo base_url(); ?>index.php/robtivityController/deletefile/<?php echo ($value->id); ?>">Delete</a> <br />
	    			<?php
	    		}
	    	?>

			<h3><?php echo ($this->lang->line("teacher_description")); ?></h3>
			<ul><li><?php echo ($this->lang->line("teacher_description_desc")); ?></li></ul>
			<textarea name="teacher_description" id="teacher_description" rows="10" cols="80">
				<?php echo ($data['0']->teacher_description); ?>
			</textarea>

			<h3><?php echo ($this->lang->line("student_description")); ?></h3>
			<ul><li><?php echo ($this->lang->line("student_description_desc")); ?></li></ul>
			<textarea name="student_description" id="student_description" rows="10" cols="80">
				<?php echo ($data['0']->student_description); ?>
			</textarea>

			<h3><?php echo ($this->lang->line("sample_solution")); ?></h3>
			<ul><li><?php echo ($this->lang->line("sample_solution_desc")); ?></li></ul>
			<textarea name="sample_solution" id="sample_solution" rows="10" cols="80">
				<?php echo ($data['0']->sample_solution); ?>
			</textarea>
			<div class="form-group">
					<label for="files_sample_solution_description"><?php echo ($this->lang->line("description")); ?></label>
					<input type="text" name="files_sample_solution_description" class="form-control"/>
					<label for="files_sample_solution[]"><?php echo ($this->lang->line("files")); ?></label>
					<input type="file" name="files_sample_solution[]" multiple="multiple"/>
				</div> 
			<?php 
	    		foreach ($data['sample_solution_files'] as $key => $value) {
	    			?>
	    				<a href="<?php echo ($value->link); ?>"><?php echo ($value->name); ?></a> - 
	    				<a href="<?php echo base_url(); ?>index.php/robtivityController/deletefile/<?php echo ($value->id); ?>">Delete</a> <br />
	    			<?php
	    		}
	    	?>

			<h3><?php echo ($this->lang->line("multimedia_artifacts")); ?></h3>
			<ul><li><?php echo ($this->lang->line("multimedia_artifacts_desc")); ?></li></ul>
			<textarea name="multimedia_artifacts" id="multimedia_artifacts" rows="10" cols="80">
				<?php echo ($data['0']->multimedia_artifacts); ?>
			</textarea>
			<div class="form-group">
					<label for="files_multimedia_artifacts_description"><?php echo ($this->lang->line("description")); ?></label>
					<input type="text" name="files_multimedia_artifacts_description" class="form-control"/>
					<label for="files_multimedia_artifacts[]"><?php echo ($this->lang->line("files")); ?></label>
					<input type="file" name="files_multimedia_artifacts[]" multiple="multiple"/>
				</div> 
			<?php 
	    		foreach ($data['multimedia_files'] as $key => $value) {
	    			?>
	    				<a href="<?php echo ($value->link); ?>"><?php echo ($value->name); ?></a> - 
	    				<a href="<?php echo base_url(); ?>index.php/robtivityController/deletefile/<?php echo ($value->id); ?>">Delete</a> <br />
	    			<?php
	    		}
	    	?>

			<h3><?php echo ($this->lang->line("construction_manual")); ?></h3>
			<ul><li><?php echo ($this->lang->line("construction_manual_desc")); ?></li></ul>
			<textarea name="construction_manual" id="construction_manual" rows="10" cols="80">
				<?php echo ($data['0']->construction_manual); ?>
			</textarea>

			<h3><?php echo ($this->lang->line("components_description")); ?></h3>
			<ul><li><?php echo ($this->lang->line("components_description_desc")); ?></li></ul>
			<textarea name="components_desc" id="components_desc" rows="10" cols="80">
				<?php echo ($data['0']->components_desc); ?>
			</textarea>

			<h3><?php echo ($this->lang->line("faq")); ?></h3>
			<textarea name="faq" id="faq" rows="10" cols="80">
				<?php echo ($data['0']->faq); ?>
			</textarea>

			<h3><?php echo ($this->lang->line("robtivity_resources")); ?></h3>
			<ul><li><?php echo ($this->lang->line("robtivity_resources_desc")); ?></li></ul>
			<textarea name="robtivity_resources" id="robtivity_resources" rows="10" cols="80">
				<?php echo ($data['0']->robtivity_resources); ?>
			</textarea>

			<h3><?php echo ($this->lang->line("general_resources")); ?></h3>
			<ul><li><?php echo ($this->lang->line("general_resources_desc")); ?></li></ul>
			<textarea name="general_resources" id="general_resources" rows="10" cols="80">
				<?php echo ($data['0']->general_resources); ?>
			</textarea>
			<label for="publicaion">Publicaion:</label>	<br />			
    		<input type="radio" name="publication" value="1">Yes<br>
			<input type="radio" name="publication" value="0">No
    			<br />

			<input type="submit" name="submit" class="btn btn-default" value="submit" />

			<script>
				function CkEditorURLTransfer(url)
				{
					//window.parent.CKEDITOR.tools.callFunction(1, url, '');
					//$('#cke_111_textInput').val(url);
				}
				// Replace the <textarea id="editor1"> with a CKEditor
				// instance, using default configuration.
				CKEDITOR.replace( 'content', {
					//filebrowserBrowseUrl: 'http://localhost/centrobot/ckeditor/plugins/w3bdeveloper_uimages/index.php',
					filebrowserWindowWidth: '860',
					filebrowserWindowHeight: '660'
				});
				CKEDITOR.replace( 'required_knowledge', {
					//filebrowserBrowseUrl: 'http://localhost/centrobot/ckeditor/plugins/w3bdeveloper_uimages/index.php',
					filebrowserWindowWidth: '860',
					filebrowserWindowHeight: '660'
				});
				CKEDITOR.replace( 'time_consumption', {
					//filebrowserBrowseUrl: 'http://localhost/centrobot/ckeditor/plugins/w3bdeveloper_uimages/index.php',
					filebrowserWindowWidth: '860',
					filebrowserWindowHeight: '660'
				});
				CKEDITOR.replace( 'enviroment', {
					//filebrowserBrowseUrl: 'http://localhost/centrobot/ckeditor/plugins/w3bdeveloper_uimages/index.php',
					filebrowserWindowWidth: '860',
					filebrowserWindowHeight: '660'
				});
				CKEDITOR.replace( 'equipment', {
					//filebrowserBrowseUrl: 'http://localhost/centrobot/ckeditor/plugins/w3bdeveloper_uimages/index.php',
					filebrowserWindowWidth: '860',
					filebrowserWindowHeight: '660'
				});
				CKEDITOR.replace( 'teacher_description', {
					//filebrowserBrowseUrl: 'http://localhost/centrobot/ckeditor/plugins/w3bdeveloper_uimages/index.php',
					filebrowserWindowWidth: '860',
					filebrowserWindowHeight: '660'
				});
				CKEDITOR.replace( 'student_description', {
					//filebrowserBrowseUrl: 'http://localhost/centrobot/ckeditor/plugins/w3bdeveloper_uimages/index.php',
					filebrowserWindowWidth: '860',
					filebrowserWindowHeight: '660'
				});
				CKEDITOR.replace( 'sample_solution', {
					//filebrowserBrowseUrl: 'http://localhost/centrobot/ckeditor/plugins/w3bdeveloper_uimages/index.php',
					filebrowserWindowWidth: '860',
					filebrowserWindowHeight: '660'
				});
				CKEDITOR.replace( 'multimedia_artifacts', {
					//filebrowserBrowseUrl: 'http://localhost/centrobot/ckeditor/plugins/w3bdeveloper_uimages/index.php',
					filebrowserWindowWidth: '860',
					filebrowserWindowHeight: '660'
				});
				CKEDITOR.replace( 'construction_manual', {
					//filebrowserBrowseUrl: 'http://localhost/centrobot/ckeditor/plugins/w3bdeveloper_uimages/index.php',
					filebrowserWindowWidth: '860',
					filebrowserWindowHeight: '660'
				});
				CKEDITOR.replace( 'components_desc', {
					//filebrowserBrowseUrl: 'http://localhost/centrobot/ckeditor/plugins/w3bdeveloper_uimages/index.php',
					filebrowserWindowWidth: '860',
					filebrowserWindowHeight: '660'
				});
				CKEDITOR.replace( 'faq', {
					//filebrowserBrowseUrl: 'http://localhost/centrobot/ckeditor/plugins/w3bdeveloper_uimages/index.php',
					filebrowserWindowWidth: '860',
					filebrowserWindowHeight: '660'
				});
				CKEDITOR.replace( 'robtivity_resources', {
					//filebrowserBrowseUrl: 'http://localhost/centrobot/ckeditor/plugins/w3bdeveloper_uimages/index.php',
					filebrowserWindowWidth: '860',
					filebrowserWindowHeight: '660'
				});
				CKEDITOR.replace( 'general_resources', {
					//filebrowserBrowseUrl: 'http://localhost/centrobot/ckeditor/plugins/w3bdeveloper_uimages/index.php',
					filebrowserWindowWidth: '860',
					filebrowserWindowHeight: '660'
				});
			</script>
			
		</form>

	  </div>
	</div>
</div>