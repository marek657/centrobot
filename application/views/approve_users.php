<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo ($this->lang->line("nav_registrations")); ?></h3>
    </div>
    <div class="panel-body">
         <!-- Table -->
      <table class="table">
        <thead>
            <tr>
                <th><?php echo ($this->lang->line("first_name")); ?></th>
                <th><?php echo ($this->lang->line("last_name")); ?></th>
                <th><?php echo ($this->lang->line("email")); ?></th>
                <th><?php echo ($this->lang->line("action")); ?></th>
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
                <a href="<?php echo base_url(); ?>index.php/adminController/approveRegistration/<?php echo ($value->id); ?>" class="btn btn-default btn-sm" role="button"><?php echo ($this->lang->line("approve")); ?></a>
                <a href="<?php echo base_url(); ?>index.php/adminController/disapproveRegistration/<?php echo ($value->id); ?>" class="btn btn-default btn-sm" role="button"><?php echo ($this->lang->line("disapprove")); ?></a>
                <?php
                echo ("</td>");
                
                echo "</tr>";
            }
            ?>
        </tbody>
      </table>
    </div>
  </div>
</div>