<div class="kt-header__topbar">

    <!-- Global Search -->
    <div class="kt-header__topbar-item kt-header__topbar-item--search">
        <div class="kt-header__topbar-wrapper">
            <div class="kt-quick-search kt-quick-search--inline kt-quick-search--result-compact" id="kt_quick_search_inline">
                <form method="get" class="kt-quick-search__form">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="flaticon2-search-1"></i>
                            </span>
                        </div>
                        <input type="text" name="keywords" class="form-control kt-quick-search__input" placeholder="ค้นหา...">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-close kt-quick-search__close"></i>
                            </span>
                        </div>
                    </div>
                </form>
                <div data-toggle="dropdown" data-offset="0,10px"></div>
                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
                    <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="325" data-mobile-height="200"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    <div class="kt-header__topbar-item dropdown notify">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="20px,10px">
            <span class="kt-header__topbar-icon"><i class="flaticon-alarm"></i></span>
            <span class="kt-badge kt-badge--danger">3</span>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-l dropdown-menu-tab">
            <div class="kt-head kt-head--sm">
                <h3 class="kt-head__title">การแจ้งเตือน</h3>
                <ul class="nav nav-pills nav-fill nav-tabs-btn" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" role="tab" href="#notification-tab" id="top-notification-tab" aria-controls="notification-tab" aria-selected="true">
                            <span class="nav-link-title">การแจ้งเตือน</span>
                            <span class="kt-badge kt-badge--danger">4</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" role="tab" href="#decision-tab" id="top-decision-tab" aria-controls="decision-tab" aria-selected="false">
                            <span class="nav-link-title">ต้องตัดสินใจ</span>
                            <span class="kt-badge kt-badge--danger">2</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" role="tab" href="#comment-tab" id="top-comment-tab" aria-controls="comment-tab" aria-selected="false">
                            <span class="nav-link-title">ความคิดเห็น</span>
                            <span class="kt-badge kt-badge--danger">9+</span>
                        </a>
                    </li>
                </ul>
            </div>
            <?php
                $str = file_get_contents('assets/data/personal.json');
                $str2 = file_get_contents('assets/data/notify.json');
                $json = json_decode($str, true);
                $json2 = json_decode($str2, true);
            ?>
            <div class="kt-notification kt-margin-t-30 kt-margin-b-10 kt-scroll scroll-wrapper listview__scroll scrollbar-inner" data-scroll="true" data-height="350">
                <div class="tab-content">

                    <div class="tab-pane fade active show" role="tabpanel" aria-labelledby="top-notification-tab">
                        <?php
                            $aa = 0;
                            foreach($json2 as $value){
                        ?>
                            <a href="#" onclick="cls();" class="kt-notification__item">
                                <div class="kt-notification__item-icon">
                                    <span href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="John Myer">
                                        <img src="<?php echo $json[$aa]['img'];?>" alt="<?php echo $json[$aa]['fname'];?>">
                                    </span>
                                </div>
                                <div class="kt-notification__item-details">
                                    <div class="kt-notification__item-title">
                                        <span class="text-a-link">การะเกต์  แสงขัย</span> ได้เพิ่มเนื้อหาใน <span class="text-a-link">ระบบจัดการงานเอกสาร</span> 
                                    </div>
                                    <div class="kt-notification__item-time">
                                        24 เมษายน เวลา 12:09 น.
                                    </div>
                                </div>
                            </a>
                        <?php $aa++; }?>
                    </div>

                    <div class="tab-pane fade" id="decision-tab" role="tabpanel" aria-labelledby="top-decision-tab">
                        <?php
                            $aa = 0;
                            foreach($json2 as $value){
                        ?>
                            <a href="#" onclick="cls();" class="kt-notification__item">
                                <div class="kt-notification__item-icon">
                                    <span href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="John Myer">
                                        <img src="<?php echo $json[$aa]['img'];?>" alt="<?php echo $json[$aa]['fname'];?>">
                                    </span>
                                </div>
                                <div class="kt-notification__item-details">
                                    <div class="kt-notification__item-title">
                                        <span class="text-a-link">การะเกต์  แสงขัย</span> ได้เพิ่มเนื้อหาใน <span class="text-a-link">ระบบจัดการงานเอกสาร</span> 
                                    </div>
                                    <div class="kt-notification__item-time">
                                        24 เมษายน เวลา 12:09 น.
                                    </div>
                                </div>
                            </a>
                        <?php $aa++; }?>
                    </div>
                    
                    <div class="tab-pane fade" id="comment-tab" role="tabpanel" aria-labelledby="top-comment-tab">
                        <?php
                            $aa = 0;
                            foreach($json2 as $value){
                        ?>
                            <a href="#" onclick="cls();" class="kt-notification__item">
                                <div class="kt-notification__item-icon">
                                    <span href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="John Myer">
                                        <img src="<?php echo $json[$aa]['img'];?>" alt="<?php echo $json[$aa]['fname'];?>">
                                    </span>
                                </div>
                                <div class="kt-notification__item-details">
                                    <div class="kt-notification__item-title">
                                        <span class="text-a-link">การะเกต์  แสงขัย</span> ได้เพิ่มเนื้อหาใน <span class="text-a-link">ระบบจัดการงานเอกสาร</span> 
                                    </div>
                                    <div class="kt-notification__item-time">
                                        24 เมษายน เวลา 12:09 น.
                                    </div>
                                </div>
                            </a>
                        <?php $aa++; }?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Help -->
    <div class="kt-header__topbar-item kt-header__topbar-item--user">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="20px,10px">
            <span class="kt-header__topbar-icon">
                <i class="flaticon-questions-circular-button"></i>
            </span>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-md">
            <div class="kt-user-card-v4 kt-user-card-v4--skin-light kt-notification-item-padding-x">
                <div class="kt-user-card-v4__name">
                    คู่มือสำหรับผู้ใช้งาน
                </div>
            </div>
            <ul class="kt-nav kt-margin-b-10">
                <?php for($aa=1; $aa<5; $aa++){?>
                    <li class="kt-nav__item">
                        <a href="#" class="kt-nav__link">
                            <span class="kt-nav__link-icon"><i class="la la-circle"></i></span>
                            <span class="kt-nav__link-text">คู่มือสำหรับผู้ใช้งาน <?= $aa; ?></span>
                        </a>
                    </li>
                <?php }?>
            </ul>
            <div class="kt-user-card-v4 kt-user-card-v4--skin-light kt-notification-item-padding-x">
                <div class="kt-user-card-v4__name">
                    คู่มือสำหรับผู้ดูแล
                </div>
            </div>
            <ul class="kt-nav kt-margin-b-10">
                <?php for($aa=1;$aa<5;$aa++){?>
                    <li class="kt-nav__item">
                        <a href="#" class="kt-nav__link">
                            <span class="kt-nav__link-icon"><i class="la la-circle"></i></span>
                            <span class="kt-nav__link-text">คู่มือสำหรับผู้ดูแล <?= $aa; ?></span>
                        </a>
                    </li>
                <?php }?>
            </ul>
        </div>
    </div>

    <!-- User Panel -->
    <?php if($userModel->isSignedIn()){?>
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="20px,10px">
                <img alt="Pic" src="/assets/media/users/300_21.jpg" />
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-md">
                <div class="kt-user-card-v4 kt-user-card-v4--skin-light kt-notification-item-padding-x">
                    <div class="kt-user-card-v4__avatar">
                        <img class="kt-rounded-" alt="Pic" src="/assets/media/users/300_25.jpg" />
                    </div>
                    <div class="kt-user-card-v4__name">
                        <?= $user['firstname'].' '.$user['lastname']; ?>
                        <small><?= $userRole['name']; ?></small>
                    </div>
                </div>
                <ul class="kt-nav kt-margin-b-10">
                    <li class="kt-nav__item">
                        <a href="#" class="kt-nav__link">
                            <span class="kt-nav__link-icon"><i class="flaticon2-schedule"></i></span>
                            <span class="kt-nav__link-text">
                                โปรไฟล์ของฉัน
                            </span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="#" class="kt-nav__link">
                            <span class="kt-nav__link-icon"><i class="flaticon2-drop"></i></span>
                            <span class="kt-nav__link-text">
                                ตั้งค่าทั่วไป
                            </span>
                        </a>
                    </li>
                    <li class="kt-nav__separator kt-nav__separator--fit"></li>
                    <?php if($userModel->isAdmin()){?>
                        <li class="kt-nav__item">
                            <a href="#" class="kt-nav__link">
                                <span class="kt-nav__link-icon"><i class="flaticon2-user-1"></i></span>
                                <span class="kt-nav__link-text">
                                    หน้าผู้ดูแลระบบ
                                </span>
                            </a>
                        </li>
                        <li class="kt-nav__separator kt-nav__separator--fit"></li>
                    <?php }?>
                    <li class="kt-nav__custom kt-space-between">
                        <a href="/signout" class="btn custom-btn-secondary" style="width:100%;">
                            ออกจากระบบ
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    <?php }?>

</div>
