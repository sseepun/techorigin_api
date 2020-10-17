<h2 class="intro-y text-lg font-medium mt-8">
    บัญชีผู้ใช้
</h2>
<form id="table_form" action="" method="GET">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="<?= $appUrl ?>admin/user-create" class="button text-white bg-theme-1 shadow-md mr-2">
                เพิ่มบัญชีผู้ใช้
            </a>
            <?php include_once(APPPATH.'Views/admins/templates/table-top.php') ?>
        </div>
        <?php
            if($tableObject && $tableObject['result']){
                foreach($tableObject['result'] as $r){
        ?>
            <div class="intro-y col-span-12 md:col-span-6">
                <div class="box">
                    <div class="flex flex-col lg:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                            <img alt="User Profile" class="rounded-full" src="<?php 
                                if(!empty($r['profile'])) echo $appUrl.$r['profile'];
                                else echo $appUrl.'public/images/default/profile.png';
                            ?>" />
                        </div>
                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                            <a href="<?= $appUrl.'admin/user-read/'.ssEncrypt($r['id']) ?>" class="font-medium">
                                <?= $r['firstname'] ?> <?= $r['lastname'] ?>
                                <span class="text-gray-600 text-xs">(<?= $r['role'] ?>)</span>
                            </a> 
                            <div class="text-gray-600 text-xs"><?= $r['email'] ?></div>
                        </div>
                        <div class="flex -ml-2 lg:ml-0 lg:justify-end mt-3 lg:mt-0">
                            <a href="<?= $appUrl.'admin/user-read/'.ssEncrypt($r['id']) ?>" class="button button--sm text-white bg-theme-1 mr-2">
                                ดูข้อมูล
                            </a>
                            <a href="<?= $appUrl.'admin/user-edit/'.ssEncrypt($r['id']) ?>" class="button button--sm text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300">
                                แก้ไข
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php }}else{?>
            <div class="intro-y col-span-12 my-3">
                <h1 class="text-lg font-medium text-center">ไม่พบข้อมูลที่ค้นหา</h1>
            </div>
        <?php }?>
        <?php include_once(APPPATH.'Views/admins/templates/table-bottom.php') ?>
    </div>
</form>
