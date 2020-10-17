<div class="top-bar">
    <?php include_once('breadcrumb.php') ?>
    <?php include_once('notification.php') ?>
    <div class="intro-x dropdown w-8 h-8">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
            <img alt="User Profile" src="<?= $userModel->getProfile() ?>" />
        </div>
        <div class="dropdown-box w-56">
            <div class="dropdown-box__content box bg-theme-38 dark:bg-dark-6 text-white">
                <div class="p-4 border-b border-theme-40 dark:border-dark-3">
                    <div class="font-medium">
                        <?= $userModel->getInfo()['firstname'] ?> 
                        <?= $userModel->getInfo()['lastname'] ?>
                    </div>
                    <div class="text-xs text-theme-41 dark:text-gray-600">
                        <?= $userModel->getInfo()['email'] ?>
                    </div>
                </div>
                <div class="p-2">
                    <a href="<?= $appUrl ?>admin/profile" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="user" class="w-4 h-4 mr-2"></i>
                        ข้อมูลของฉัน
                    </a>
                    <a href="<?= $appUrl ?>admin/my-account-create" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="edit" class="w-4 h-4 mr-2"></i>
                        สร้างผู้ใช้ของฉัน    
                    </a>
                    <a href="<?= $appUrl ?>admin/help" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="help-circle" class="w-4 h-4 mr-2"></i>
                        วิธีการใช้งาน    
                    </a>
                </div>
                <div class="p-2 border-t border-theme-40 dark:border-dark-3">
                    <a href="<?= $appUrl ?>signout" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                        <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i>
                        ออกจากระบบ    
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
