                <tr>
                <td class="align-middle d-none d-md-table-cell"><?=  $x; ?></td>
                <td class="align-middle my-lh-1 text-sm1"><?=  $tarikh; ?></td>
                <td class="text-left align-middle"><span class="text-info font-weight-bold"><?=  $kewpa; ?></span><?php  if($sahkan!='') { ?><br><small class="text-info ">Disahkan Oleh <?=  $sahkan; ?></small> <?php } ?>
                </td>
                        <td class="align-middle"><?=  $kategori; ?></td>
                        <td class="align-middle"><?=  $tahunperolehan; ?></td>
                        <td  class="align-middle">
                     <?php  if($sahkan=='') { ?>
                        <a style="display: inline;" href="/ppdkluang/cpanel/sekolah/ict/edit.php?id=<?=  $id; ?>" class="buang btn btn-block btn-sm btn-success"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a style="display: inline;" href="/ppdkluang/cpanel/sekolah/ict/proc/isi.php?buang=<?=  $id; ?>" class="buang btn btn-block btn-sm btn-info"><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php } ?>
<?php  if($sahkan!='') { ?><span class="text-info">Disahkan</span><?php } ?>
                    </td>
                    </tr>    