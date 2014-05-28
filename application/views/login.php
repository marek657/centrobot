<div class="container">
	<div class="row">
		<div class="col-xs-6">
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title"><?php echo ($this->lang->line("login")); ?></h3>
			  </div>
			  <div class="panel-body">
			    <fieldset>
			    	<?php echo form_open('userController/login'); ?>
					 	<div class="form-group">
							<label for="InputEmail"><?php echo ($this->lang->line("email")); ?></label>
							<input type="email" name="email" value="Email" class="form-control" placeholder="Enter email">
						</div>
						<div class="form-group">
							<label for="InputPassword"><?php echo ($this->lang->line("password")); ?></label>
							<input type="password" name="password" value="passowrd" class="form-control" placeholder="Password">
						</div>
						<button type="submit" name="submit" class="btn btn-default"><?php echo ($this->lang->line("login")); ?></button>
					</form> 
				</fieldset>
			  </div>
			</div>
		</div>
		<div class="col-xs-6">
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title"><?php echo ($this->lang->line("sign_up")); ?></h3>
			  </div>
			  <div class="panel-body">
			    <fieldset>
			    	<?php echo form_open('userController/registration'); ?>
					 	<div class="form-group">
							<label for="InputEmail"><?php echo ($this->lang->line("email")); ?></label>
							<input type="email" name="email" value="Email" class="form-control" placeholder="Enter email">
						</div>
						<div class="form-group">
							<label for="InputName"><?php echo ($this->lang->line("first_name")); ?></label>
							<input type="text" name="name" value="First Name" class="form-control" placeholder="Enter first name">
						</div>
						<div class="form-group">
							<label for="InputName"><?php echo ($this->lang->line("last_name")); ?></label>
							<input type="text" name="lastname" value="Last Name" class="form-control" placeholder="Enter last name">
						</div>						
						<div class="form-group">
							<label for="exampleInputPassword1"><?php echo ($this->lang->line("password")); ?></label>
							<input type="password" name="password" value="passowrd" class="form-control" id="exampleInputPassword1" placeholder="Password">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1"><?php echo ($this->lang->line("confirm_password")); ?></label>
							<input type="password" name="password2" value="passowrd2" class="form-control" id="exampleInputPassword1" placeholder="Password">
						</div>
						<button type="submit" name="submit" class="btn btn-default"><?php echo ($this->lang->line("sign_up")); ?></button>
					</form> 
				</fieldset>
			  </div>
			</div>
		</div>
	</div>
</div>