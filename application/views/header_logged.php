<header class="navbar navbar-inverse">
	<div class="container">
		<nav role="navigation">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#">Centrobot</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li><a href="<?php echo base_url(); ?>index.php/robtivityController"><?php echo ($this->lang->line("nav_home")); ?></a></li>
		        <li><a href="<?php echo base_url(); ?>index.php/searchController/getSearch"><?php echo ($this->lang->line("nav_search")); ?></a></li>
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($this->lang->line("nav_may_acc")); ?> <b class="caret"></b></a>
		          <ul class="dropdown-menu">
		            <li><a href="<?php echo base_url(); ?>index.php/robtivityController/myrobtivies"><?php echo ($this->lang->line("nav_my_rbt")); ?></a></li>
		            <li><a href="<?php echo base_url(); ?>index.php/classController/myclasses"><?php echo ($this->lang->line("nav_classes")); ?></a></li>
		            <!--<li><a href="#"><?php //echo ($this->lang->line("nav_settings")); ?></a></li> -->
		            <li class="divider"></li>
		            <li><a href="<?php echo base_url(); ?>index.php/userController/logout"><?php echo ($this->lang->line("nav_logout")); ?></a></li>
		          </ul>
		        </li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($this->lang->line("nav_language")); ?> <b class="caret"></b></a>
		          <ul class="dropdown-menu">
		            <li><a href="<?php echo base_url(); ?>index.php/userController/changelang/slovak/2">Slovensky</a></li>
		            <li><a href="<?php echo base_url(); ?>index.php/userController/changelang/english/1">English</a></li>
		            <li><a href="#">Deutsch</a></li>
		          </ul>
		        </li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
	</div>
</header>