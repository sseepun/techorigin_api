<div class="kt-header__bottom">
    <div class="kt-container">

        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn">
            <i class="la la-close"></i>
        </button>

        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
                <ul class="kt-menu__nav ">

                    <li class="kt-menu__item  kt-menu__item--open kt-menu__item--rel <?php if($pageActive=='Slip Report')echo 'kt-menu__item--here'; ?>">
                        <a href="/portals" class="kt-menu__link">
                            <span class="kt-menu__link-text">รายงานเงินเดือน</span>
                        </a>
                    </li>
                    <li class="kt-menu__item  kt-menu__item--open kt-menu__item--rel <?php if($pageActive=='Report')echo 'kt-menu__item--here'; ?>">
                        <a href="/portals/report" class="kt-menu__link">
                            <span class="kt-menu__link-text">รายงาน</span>
                        </a>
                    </li>
                    <?php if($userModel->isAdmin()){?>
                        <li class="kt-menu__item  kt-menu__item--open kt-menu__item--rel <?php if($pageActive=='Admin Panel')echo 'kt-menu__item--here'; ?>">
                            <a href="/admins" class="kt-menu__link">
                                <span class="kt-menu__link-text">ผู้ดูแลระบบ</span>
                            </a>
                        </li>
                    <?php }?>
                    
                </ul>
            </div>
        </div>
    </div>
</div>
