<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo ($this->lang->line("edit_technology")); ?></h3>
    </div>
    <div class="panel-body">
    	<?php 
        $pom = $data['0']->id_technology;
        foreach ($data as $key => $value) {
            if ($pom != $value->id_technology) {
                echo("<hr>");
                $pom = $value->id_technology;
            }
            echo form_open('adminController/updateTechnology/' . $value->id_technology . "/" . $value->id_lang);
            ?>
            <div class="form-group">
                <label for="InputName"><?php echo $value->name; ?></label>
                <input type="text" name="technology_name" value="<?php echo $value->technology_name; ?>" class="form-control" >
            </div>
            <button type="submit" name="submit" class="btn btn-default btn-sm"><?php echo ($this->lang->line("edit")); ?></button>
        </form>
            <?php
        }
        ?>
        
    </div>
  </div>
</div>