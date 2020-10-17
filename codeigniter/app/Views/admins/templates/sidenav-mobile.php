<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="<?= $appUrl ?>admin" class="flex mr-auto">
            <img alt="<?= $appTitle ?>" class="w-6" src="<?= $appUrl ?>public/logo_white.png" />
        </a>
        <a href="javascript:;" id="mobile-menu-toggler">
            <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i>
        </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
        <li>
            <a href="<?= $appUrl ?>admin" class="menu <?php if($pageActive=='Dashboard')echo 'menu--active'; ?>">
                <div class="menu__icon"><i data-feather="home"></i></div>
                <div class="menu__title">หน้าสรุปผล</div>
            </a>
        </li>
        <li>
            <a href="<?= $appUrl ?>admin/my-accounts" class="menu <?php if($pageActive=='My Accounts')echo 'menu--active'; ?>">
                <div class="menu__icon"><i data-feather="box"></i></div>
                <div class="menu__title">ผู้ใช้ของฉัน</div>
            </a>
        </li>
        <?php if($userModel->isSuperAdmin()){?>
            <li class="menu__devider my-6"></li>
            <li>
                <a href="<?= $appUrl ?>admin/users" class="menu <?php if($pageActive=='Users')echo 'menu--active'; ?>">
                    <div class="menu__icon"><i data-feather="users"></i></div>
                    <div class="menu__title">บัญชีผู้ใช้</div>
                </a>
            </li>
            <li>
                <a href="<?= $appUrl ?>admin/accounts" class="menu <?php if($pageActive=='Accounts')echo 'menu--active'; ?>">
                    <div class="menu__icon"><i data-feather="trello"></i></div>
                    <div class="menu__title">บัญชีผู้ใช้ย่อย</div>
                </a>
            </li>
        <?php }?>
    </ul>
</div>
