<h2 class="intro-y text-lg font-medium mt-8">
    ตำแหน่งผู้ใช้
</h2>
<form id="table_form" action="" method="GET">
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <a href="<?= $appUrl ?>admin/user-role/create" class="button text-white bg-theme-1 shadow-md mr-2">
                เพิ่มตำแหน่ง
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
                        <th class="whitespace-no-wrap">ตำแหน่ง</th>
                        <th class="text-center whitespace-no-wrap">ผู้ดูแลระบบ</th>
                        <th class="text-center whitespace-no-wrap">ผู้ดูแลระบบขั้นสูง</th>
                        <th class="text-center whitespace-no-wrap">ค่าเริ่มต้น</th>
                        <th class="text-center whitespace-no-wrap">ลำดับ</th>
                        <th class="text-center whitespace-no-wrap">สภานะ</th>
                        <th class="text-center whitespace-no-wrap">การจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($tableObject && $tableObject['result']){
                            foreach($tableObject['result'] as $r){
                    ?>
                        <tr class="intro-x">
                            <td class="whitespace-no-wrap">
                                <a href="<?= $appUrl.'admin/user-role/read/'.ssEncrypt($r['id'], 'User Role') ?>" class="font-medium whitespace-no-wrap">
                                    <?= $r['name'] ?>
                                </a> 
                            </td>
                            <td class="w-30 text-center font-medium">
                                <?php if($r['is_admin']){?>
                                    <div class="text-theme-9">Yes</div>
                                <?php }else{?>
                                    <div class="text-theme-6">No</div>
                                <?php }?>
                            </td>
                            <td class="w-30 text-center font-medium">
                                <?php if($r['is_super_admin']){?>
                                    <div class="text-theme-9">Yes</div>
                                <?php }else{?>
                                    <div class="text-theme-6">No</div>
                                <?php }?>
                            </td>
                            <td class="w-30 text-center font-medium">
                                <?php if($r['is_default']){?>
                                    <div class="text-theme-9">Yes</div>
                                <?php }else{?>
                                    <div class="text-theme-6">No</div>
                                <?php }?>
                            </td>
                            <td class="w-30 text-center"><?= $r['rank'] ?></td>
                            <td class="w-30 text-center font-medium">
                                <?php if($r['status']==1){?>
                                    <div class="text-theme-9">Active</div>
                                <?php }else{?>
                                    <div class="text-theme-6">Inactive</div>
                                <?php }?>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a href="<?= $appUrl.'admin/user-role/read/'.ssEncrypt($r['id'], 'User Role') ?>" class="button button--sm text-white bg-theme-1 mr-2 whitespace-no-wrap">
                                        ดูข้อมูล
                                    </a>
                                    <?php if($r['id'] > 2){?>
                                        <a href="<?= $appUrl.'admin/user-role/update/'.ssEncrypt($r['id'], 'User Role') ?>" class="button button--sm text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300 whitespace-no-wrap">
                                            แก้ไข
                                        </a>
                                    <?php }?>
                                </div>
                            </td>
                        </tr>
                    <?php }}else{?>
                        <tr class="intro-x">
                            <td colspan="7" class="text-center">
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
