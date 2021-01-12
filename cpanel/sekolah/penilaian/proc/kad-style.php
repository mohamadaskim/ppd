         <tr>
                    <th  rowspan="2"  class="d-none d-md-table-cell"><?=  $x; ?></th>
                    <th  class="text-left align-top"><?=  $tajuk; ?></th>

<?php 

if($data=='radio'){
  for($i=1;$i<=$radio;$i++){
    ?>
    <th><label for="mula"></label>
        <input type="hidden"  name="dataid[<?=  $dataid; ?>]" value="<?=  $name; ?>">
        <input type="radio"  name="data[<?=  $dataid; ?>]" value="<?=  $i; ?>">
        </th> 
    <?php
} ?>

<?php
}
if($data=='text'){

    ?>
    <th colspan="5">
        
    </th> 
    <?php

}


?>


                </tr>
                <?php if($data=='radio'){ ?>
                <tr>
                    <th  colspan="6"><textarea  placeholder="Ulasan sekiranya ada"  rows="1" name="datatext[<?=  $dataid; ?>]" class="form-control"></textarea> </th>
                </tr>
                <?php } ?>
                                <?php if($data=='text'){ ?>
                <tr>
                    <th  colspan="6"><input type="hidden"  name="dataid[<?=  $dataid; ?>]" value="<?=  $name; ?>"><textarea  placeholder=""  rows="4" name="datatext[<?=  $dataid; ?>]" class="form-control"></textarea> </th>
                </tr>
                <?php } ?>