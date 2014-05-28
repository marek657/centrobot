<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo ($this->lang->line("edit_level")); ?></h3>
    </div>
    <div class="panel-body">
    	<?php 
        $pom = $data['0']->id_level;
        foreach ($data as $key => $value) {
            if ($pom != $value->id_level) {
                echo("<hr>");
                $pom = $value->id_level;
            }
            echo form_open('adminController/updateLevel/' . $value->id_level . "/" . $value->id_lang);
            ?>
            <div class="form-group">
                <label for="InputName"><?php echo $value->name; ?></label>
                <input type="text" name="level_name" value="<?php echo $value->level_name; ?>" class="form-control" >
            </div>
            <button type="submit" name="submit" class="btn btn-default btn-sm"><?php echo ($this->lang->line("edit")); ?></button>
        </form>
            <?php
        }
        ?>
        
    </div>
  </div>
</div>