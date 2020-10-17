<?php
    if($tableObject){
        $page = $tableObject['page'];
        $totalPages = $tableObject['total_pages'];
        $pp = $tableObject['pp'];
        $total = $tableObject['total'];
?>
    <input type="hidden" name="page" value="<?= $page ?>" />
    <input type="hidden" name="pp" value="<?= $pp ?>" />
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
        <ul class="pagination">
            <li>
                <a data-page="1" class="pagination__link <?php if($page==1)echo 'disabled'; ?>" href="#">
                    <i class="w-4 h-4" data-feather="chevrons-left"></i>
                </a>
            </li>
            <li>
                <a data-page="<?= $page - 1 ?>" class="pagination__link <?php if($page==1)echo 'disabled'; ?>" href="#">
                    <i class="w-4 h-4" data-feather="chevron-left"></i>
                </a>
            </li>
            <?php
                if($totalPages){
                    $startPage = $page-2;
                    if($page==$totalPages) $startPage = $page-4;
                    else if($page==$totalPages-1) $startPage = $page-3;
                    $k=0; for($i=$startPage; $i<=$totalPages; $i++){ if($i>0 && ($i<=$page+2 || $k<5)){ $k++;
            ?>
                <li>
                    <a data-page="<?= $i ?>" class="pagination__link <?php if($i==$page)echo 'pagination__link--active'; ?>" href="#">
                        <?= $i ?>
                    </a>
                </li>
            <?php }}}else{?>
                <li>
                    <a class="pagination__link pagination__link--active" href="#">
                        1
                    </a>
                </li>
            <?php }?>
            <li>
                <a data-page="<?= $page + 1 ?>" class="pagination__link <?php if(!$totalPages || $page==$totalPages)echo 'disabled'; ?>" href="#">
                    <i class="w-4 h-4" data-feather="chevron-right"></i>
                </a>
            </li>
            <li>
                <a data-page="<?= $totalPages ?>" class="pagination__link <?php if(!$totalPages || $page==$totalPages)echo 'disabled'; ?>" href="#">
                    <i class="w-4 h-4" data-feather="chevrons-right"></i>
                </a>
            </li>
        </ul>
        <select class="pp w-20 input box mt-3 sm:mt-0">
            <option value="10" <?php if($pp==10)echo 'selected'; ?>>10</option>
            <option value="25" <?php if($pp==25)echo 'selected'; ?>>25</option>
            <option value="50" <?php if($pp==50)echo 'selected'; ?>>50</option>
            <option value="10" <?php if($pp==100)echo 'selected'; ?>>100</option>
        </select>
    </div>
<?php }?>
