

<?php 
if($submenushow!=$submenu) 
{$submenushow=$submenu;
    ?>
<tr>
                    <th  colspan ="4"  class="bg-info text-left align-top"><?=  substr($submenu, 3); ?></th>
                    
                </tr>
    <?php
}


if($data=='radio'){
    ?>
         <tr>
                    <th  rowspan="2"  class="d-none d-md-table-cell"><?=  $x; ?></th>
                    <th  class="text-left align-top"><?=  $tajuk; ?></th>
    <?php
  for($i=1;$i<=$radio;$i++){

    ?>
    <th><label for="mula"></label>
        <input type="hidden"  name="dataid[<?=  $dataid; ?>]" value="<?=  $name; ?>">
        <input type="radio" <?php if(isset($datavalue) && $datavalue==$i) echo "checked"; ?> required  name="data[<?=  $dataid; ?>]" value="<?=  $i; ?>">
        </th> 
    <?php
} ?>

<?php
}
if($data=='text'){
    ?>
         <tr>
                    <th  rowspan="2"  class="d-none d-md-table-cell"><?=  $x; ?></th>
                    <th  class="text-left align-top"><?=  $tajuk; ?></th>
    <?php
    ?>
    <th colspan="5">
        
    </th> 
    <?php

}

if($data=='option1'){
    ?>
         <tr>

                    <th  rowspan="1"  class="d-none d-md-table-cell"><?=  $x; ?></th>
                    <th  class="text-left align-top"><?=  $tajuk; ?></th>
    <?php
    ?>
    <th colspan="5">
        <input type="hidden"  name="dataid[<?=  $dataid; ?>]" value="<?=  $name; ?>">
      <select name="data[<?=  $dataid; ?>]" required class="form-control"><?php echo option1($datavalue); ?></select>  
    </th> 
    <?php

}
if($data=='option2'){
    ?>
         <tr>
                    <th  rowspan="1"  class="d-none d-md-table-cell"><?=  $x; ?></th>
                    <th  class="text-left align-top"><?=  $tajuk; ?></th>
    <?php
    ?>
    <th colspan="5">
        <input type="hidden"  name="dataid[<?=  $dataid; ?>]" value="<?=  $name; ?>">
       <select name="data[<?=  $dataid; ?>]" required class="form-control"><?php echo option2($datavalue); ?></select>   
    </th> 
    <?php

}


?>


                </tr>
                <?php if($data=='radio'){ ?>
                <tr>
                    <th  colspan="6"><textarea  placeholder="Ulasan sekiranya ada"  rows="1" name="datatext[<?=  $dataid; ?>]" class="form-control"><?php if(isset($dataulasan)) echo $dataulasan; ?></textarea> </th>
                </tr>
                <?php } ?>

                                <?php if($data=='text'){ ?>
                <tr>
                    <th  colspan="6"><input type="hidden"  name="dataid[<?=  $dataid; ?>]" value="<?=  $name; ?>"><textarea  placeholder=""  rows="4" name="datatext[<?=  $dataid; ?>]" class="form-control"><?php if(isset($dataulasan)) echo $dataulasan; ?></textarea> </th>
                </tr>
                <?php } ?>

