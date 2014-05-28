<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo ($this->lang->line("edit_domain")); ?></h3>
    </div>
    <div class="panel-body">
    	<?php 
        $pom = $data['0']->id_domain;
        foreach ($data as $key => $value) {
            if ($pom != $value->id_domain) {
                echo("<hr>");
                $pom = $value->id_domain;
            }
            echo form_open('adminController/updateDomain/' . $value->id_domain . "/" . $value->id_lang);
            ?>
            <div class="form-group">
                <label for="InputName"><?php echo $value->name; ?></label>
                <input type="text" name="domain_name" value="<?php echo $value->domain_name; ?>" class="form-control" >
            </div>
            <button type="submit" name="submit" class="btn btn-default btn-sm"><?php echo ($this->lang->line("edit")); ?></button>
        </form>
            <?php
        }
        ?>
        
    </div>
  </div>
</div>