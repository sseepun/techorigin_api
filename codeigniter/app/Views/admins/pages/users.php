<h2 class="intro-y text-lg font-medium mt-8">
    บัญชีผู้ใช้
</h2>
<form id="table_form" action="" method="GET">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="<?= $appUrl ?>admin/user-create" class="button text-white bg-theme-1 shadow-md mr-2">
                เพิ่มบัญชีผู้ใช้
            </a>
            <div class="dropdown">
                <a href="javascript:" class="block dropdown-toggle button px-2 box text-gray-700 dark:text-gray-300">
                    <span class="w-5 h-5 flex items-center justify-center">
                        <i class="w-4 h-4" data-feather="plus"></i>
                    </span>
                </a>
                <div class="dropdown-box w-40">
                    <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                        <a href="#" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print
                        </a>
                        <a href="#" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to Excel
                        </a>
                        <a href="#" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to PDF
                        </a>
                    </div>
                </div>
            </div>
            <?php include_once(APPPATH.'Views/admins/templates/table-top.php') ?>
        </div>
        
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">รูปโปรไฟล์</th>
                        <th class="whitespace-no-wrap">ชื่อ-นามสกุล</th>
                        <th class="text-center whitespace-no-wrap">ตำเเหน่ง</th>
                        <th class="text-center whitespace-no-wrap">สภานะ</th>
                        <th class="text-center whitespace-no-wrap">วันที่สมัคร</th>
                        <th class="text-center whitespace-no-wrap">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($tableObject && $tableObject['result']){
                            foreach($tableObject['result'] as $r){
                    ?>
                        <tr class="intro-x">
                            <td class="w-30">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        <img alt="User Profile" class="tooltip rounded-full" src="<?php 
                                            if(!empty($r['profile'])) echo $appUrl.$r['profile'];
                                            else echo $appUrl.'public/images/default/profile.png';
                                        ?>" />
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="<?= $appUrl.'admin/user-read/'.ssEncrypt($r['id']) ?>" class="font-medium whitespace-no-wrap">
                                    <?= $r['firstname'] ?> <?= $r['lastname'] ?>
                                </a> 
                                <div class="text-gray-600 text-xs whitespace-no-wrap">
                                    <?= $r['email'] ?>
                                </div>
                            </td>
                            <td class="text-center"><?= $r['role'] ?></td>
                            <td class="w-30 text-center font-medium">
                                <?php if($r['status']==1){?>
                                    <div class="text-theme-9">Active</div>
                                <?php }else if($r['status']==0){?>
                                    <div class="text-theme-11">Pending</div>
                                <?php }else if($r['status']==-1){?>
                                    <div class="text-theme-6">Banned</div>
                                <?php }?>
                            </td>
                            <td class="text-center"><?= $r['created_at'] ?></td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a href="<?= $appUrl.'admin/user-read/'.ssEncrypt($r['id']) ?>" class="button button--sm text-white bg-theme-1 mr-2">
                                        ดูข้อมูล
                                    </a>
                                    <a href="<?= $appUrl.'admin/user-edit/'.ssEncrypt($r['id']) ?>" class="button button--sm text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300">
                                        แก้ไข
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php }}else{?>
                        <tr class="intro-x">
                            <td colspan="6" class="text-center">
                                <h1 class="text-base font-medium">
                                    ไม่พบข้อมูลที่ค้นหา 
                                    <a class="text-theme-1" href="<?= $appUrl ?>admin/users">
                                        <u>เริ่มค้นหาใหม่</u>
                                    </a>
                                </h1>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>

        <?php include_once(APPPATH.'Views/admins/templates/table-bottom.php') ?>
    </div>
</form>