<nav class="side-nav">
    <a href="<?= $appUrl ?>admin" class="intro-x flex items-center pl-5 pt-4">
        <img alt="<?= $appTitle ?>" class="w-6" src="<?= $appUrl ?>public/logo_white.png" />
        <span class="hidden xl:block text-white text-lg ml-3">
            <?= $appTitle ?>    
        </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="<?= $appUrl ?>admin" class="side-menu <?php if($pageActive=='Dashboard')echo 'side-menu--active'; ?>">
                <div class="side-menu__icon"><i data-feather="home"></i></div>
                <div class="side-menu__title">หน้าสรุปผล</div>
            </a>
        </li>
        <li>
            <a href="<?= $appUrl ?>admin/my-accounts" class="side-menu <?php if($pageActive=='My Accounts')echo 'side-menu--active'; ?>">
                <div class="side-menu__icon"><i data-feather="box"></i></div>
                <div class="side-menu__title">ผู้ใช้ของฉัน</div>
            </a>
        </li>
        <?php if($userModel->isSuperAdmin()){?>
            <li class="side-nav__devider my-6"></li>
            <li>
                <a href="<?= $appUrl ?>admin/users" class="side-menu <?php if($pageActive=='Users')echo 'side-menu--active'; ?>">
                    <div class="side-menu__icon"><i data-feather="users"></i></div>
                    <div class="side-menu__title">บัญชีผู้ใช้</div>
                </a>
            </li>
            <li>
                <a href="<?= $appUrl ?>admin/user-roles" class="side-menu <?php if($pageActive=='User Roles')echo 'side-menu--active'; ?>">
                    <div class="side-menu__icon"><i data-feather="edit"></i></div>
                    <div class="side-menu__title">ตำเเหน่งผู้ใช้</div>
                </a>
            </li>
            <li>
                <a href="<?= $appUrl ?>admin/accounts" class="side-menu <?php if($pageActive=='Accounts')echo 'side-menu--active'; ?>">
                    <div class="side-menu__icon"><i data-feather="trello"></i></div>
                    <div class="side-menu__title">บัญชีผู้ใช้ย่อย</div>
                </a>
            </li>
        <?php }?>
    </ul>
</nav>
