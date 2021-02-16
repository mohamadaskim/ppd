         <tr>
                    <th    class="d-none d-md-table-cell"><?=  $x; ?></th>
                    <th  class="text-left align-top"><?=  $tajuk; ?></th>

<?php 

    ?>
    <th><label for="mula">Bil Pegawai : </label>
        <input type="hidden"  name="dataid[<?=  $dataid; ?>]" value="<?=  $name; ?>">
        <input  type="number" required style="text-align:center; width: 3em" size="3"  name="data2018[<?=  $dataid; ?>]" value="<?php if(isset($v2018) ) echo $v2018; else echo 0;?>">
        </th> 
    <th><label for="mula">Bil Pegawai : </label>
        <input type="hidden"  name="dataid[<?=  $dataid; ?>]" value="<?=  $name; ?>">
        <input  type="number"  required style="text-align:center; width: 3em" size="3"  name="data2019[<?=  $dataid; ?>]" value="<?php if(isset($v2019) ) echo $v2019; else echo 0;?>">
        </th> 
            <th><label for="mula">Bil Pegawai : </label>
        <input type="hidden"  name="dataid[<?=  $dataid; ?>]" value="<?=  $name; ?>">
        <input  type="number"  required style="text-align:center; width: 3em" size="3"  name="data2020[<?=  $dataid; ?>]" value="<?php if(isset($v2020) ) echo $v2020; else echo 0;?>">
        </th> 

<?php

if($data=='text'){

    ?>
    <th colspan="5">
        
    </th> 
    <?php

}


?>


