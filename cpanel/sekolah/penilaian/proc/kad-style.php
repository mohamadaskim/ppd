                <tr>
                    <th class="d-none d-md-table-cell"><?=  $x; ?></th>
                    <th class="text-left align-top"><?=  $tajuk; ?></th>

<?php 

if($data=='radio'){
  for($i=1;$i<=$radio;$i++){
    ?>
    <th><label for="mula"></label><input type="radio"  name="data[<?=  $name; ?>]" value="<?=  $name; ?>"></th> 
    <?php
}  
}
if($data=='text'){

    ?>
    <th colspan="5">
        <textarea  rows="4" name="data[<?=  $name; ?>]" class="form-control"></textarea>
    </th> 
    <?php

}


?>
                   

                </tr>