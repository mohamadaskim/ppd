

                <tr>
                <td class="align-middle d-none d-md-table-cell"><?=  $x; ?></td>
                <td class="align-middle my-lh-1 text-sm1"><?=  $tarikh; ?></td>
                <td class=" align-middle"><span class="text-info font-weight-bold"><?=  $kewpa; ?></span><?php  if($sahkan!='') { ?><br><small class="text-info ">Disahkan Oleh <?=  $sahkan; ?></small> <?php } ?>
                </td>
                        <td class="align-middle"><?=  $kategori; ?></td>
                        <td class="align-middle"><?=  $tahunperolehan; ?></td>
                        <td  class="align-middle">

                        

                     <?php  if($sahkan=='') { ?>
                        <a style="display: inline;" href="/ppdkluang/cpanel/sekolah/icakna/proc/isi.php?buang=<?=  $id; ?>&view=<?=  $urla; ?>&page=<?=  $page; ?>" class="buang btn btn-block btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php } ?>

                    </td>
                    </tr>    