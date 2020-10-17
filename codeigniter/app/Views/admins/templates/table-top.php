<?php
    if($tableObject){
        $page = $tableObject['page'];
        $totalPages = $tableObject['total_pages'];
        $pp = $tableObject['pp'];
        $total = $tableObject['total'];
?>
    <div class="hidden md:block mx-auto text-gray-600">
        แสดง <?= min($pp * ($page - 1) + 1, $total) ?> 
        ถึง <?= min($pp * $page + 1, $total) ?> 
        ของ <?= $total ?> entries
    </div>
    <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
        <div class="w-56 relative text-gray-700 dark:text-gray-300">
            <input type="text" name="keyword" class="input w-56 box pr-10 placeholder-theme-13" 
            placeholder="ค้นหา..." value="<?php if(!empty($_GET['keyword']))echo $_GET['keyword']; ?>" />
            <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i> 
        </div>
    </div>
<?php }?>
