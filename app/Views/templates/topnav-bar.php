<!-- begin:: Topbar -->
<div class="kt-header__topbar">

<!--begin: Search -->
<div class="kt-header__topbar-item kt-header__topbar-item--search">
   <div class="kt-header__topbar-wrapper">
      <div class="kt-quick-search kt-quick-search--inline kt-quick-search--result-compact" id="kt_quick_search_inline">
         <form method="get" class="kt-quick-search__form">
            <div class="input-group">
               <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
               <input type="text" class="form-control kt-quick-search__input" placeholder="Search...">
               <div class="input-group-append"><span class="input-group-text"><i class="la la-close kt-quick-search__close"></i></span></div>
            </div>
         </form>
         <div data-toggle="dropdown" data-offset="0,10px"></div>
         <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
            <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="325" data-mobile-height="200">
            </div>
         </div>
      </div>
   </div>
</div>

<!--end: Search -->

<!--begin: Quick Actions -->
<div class="kt-header__topbar-item dropdown">
   <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="20px,10px">
      <span class="kt-header__topbar-icon"><i class="flaticon-chat-1"></i></span>
      <span class="kt-badge kt-badge--danger">2</span>
   </div>
   <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-l">
      <div class="kt-head kt-head--sm">
         <h3 class="kt-head__title">Chat</h3>
      </div>
      <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll scroll-wrapper listview__scroll scrollbar-inner" data-scroll="true" data-height="400">
         <?php
         $str = file_get_contents('assets/data/personal.json');
         $str2 = file_get_contents('assets/data/chat.json');
         $json = json_decode($str, true);
         $json2 = json_decode($str2, true);
         $aa = 0;
         foreach ($json2 as $value) {
         ?>
         <a href="#" class="kt-notification__item">
            <div class="kt-notification__item-icon">
               <span href="#" class="kt-media kt-media--sm kt-media--circle" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="John Myer">
                  <img src="<?php echo $json[$aa]['img'];?>" alt="<?php echo $json[$aa]['fname'];?>">
               </span>
            </div>
            <div class="kt-notification__item-details">
               <div class="kt-notification__item-title">
                  <?php echo $json[$aa]['fname'];?>
                  <div><?php echo $value['msg'];?></div>
               </div>
               <div class="kt-notification__item-time">
                  <?php echo $value['time'];?>
               </div>
            </div>
         </a>
         <?php 
         $aa++;
         }?>
      </div>
   </div>
</div>
<!--end: Quick Actions -->



<!--begin: Notifications -->
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
      <div class="kt-notification kt-margin-t-30 kt-margin-b-10 kt-scroll scroll-wrapper listview__scroll scrollbar-inner" data-scroll="true" data-height="350">
         <div class="tab-content">
            <div class="tab-pane fade active show" role="tabpanel" aria-labelledby="top-notification-tab">
                <?php
                    $str = file_get_contents('assets/data/personal.json');
                    $str2 = file_get_contents('assets/data/notify.json');
                    $json = json_decode($str, true);
                    $json2 = json_decode($str2, true);
                    $aa = 0;
                    foreach ($json2 as $value) {
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
               <?php 
               $aa++;
               }?>
            </div>
            <div class="tab-pane fade" id="decision-tab" role="tabpanel" aria-labelledby="top-decision-tab">
               <?php
               $aa = 0;
               foreach ($json2 as $value) {
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
               <?php 
               $aa++;
               }?>
            </div>
            <div class="tab-pane fade" id="comment-tab" role="tabpanel" aria-labelledby="top-comment-tab">
            <?php
               $aa = 0;
               foreach ($json2 as $value) {
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
               <?php 
               $aa++;
               }?>
            </div>
         </div>
         
      </div>
   </div>
</div>
<!--end: Notifications -->


<!--begin: Quick Actions -->
<div class="kt-header__topbar-item dropdown">
   <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="20px,10px">
      <span class="kt-header__topbar-icon"><i class="flaticon-grid-menu"></i></span>
   </div>
   <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
      <div class="kt-head kt-head--sm">
         <h3 class="kt-head__title">แอพพลิเคชั่น</h3>
      </div>
      <div class="kt-grid-nav kt-margin-t-10 kt-padding-10 kt-margin-b-10 kt-scroll" data-scroll="true" data-height="600">
         <?php
         $str = file_get_contents('assets/data/apps.json');
         $json = json_decode($str, true);
         foreach ($json as $value) {
         ?>
         <a href="<?php echo $value['url'];?>" class="kt-grid-nav__item">
            <div class="kt-grid-nav__item-icon"><i class="<?php echo $value['icon'];?>"></i></div>
            <div class="kt-grid-nav__item-title"><?php echo $value['app-name'];?></div>
            <span class="kt-grid-nav__item-shortcuts kt-badge" style="background-color:<?php echo $value['color'];?>;"></span>
         </a>
         <?php }?>
      </div>
   </div>
</div>
<!--end: Quick Actions -->

<!--begin: Help -->
<div class="kt-header__topbar-item kt-header__topbar-item--user">
   <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="20px,10px">
      <span class="kt-header__topbar-icon"><i class="flaticon-questions-circular-button"></i></span>
   </div>
   <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-md">
      <div class="kt-user-card-v4 kt-user-card-v4--skin-light kt-notification-item-padding-x">
         <div class="kt-user-card-v4__name">
            คู่มือสำหรับผู้ใช้งาน
         </div>
      </div>
      <ul class="kt-nav kt-margin-b-10">
         <?php for($aa=1;$aa<5;$aa++){?>
         <li class="kt-nav__item">
            <a href="custom/profile/personal-information.html" class="kt-nav__link">
               <span class="kt-nav__link-icon"><i class="la la-circle"></i></span>
               <span class="kt-nav__link-text">คู่มือสำหรับผู้ใช้งาน <?=$aa?></span>
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
            <a href="custom/profile/personal-information.html" class="kt-nav__link">
               <span class="kt-nav__link-icon"><i class="la la-circle"></i></span>
               <span class="kt-nav__link-text">คู่มือสำหรับผู้ดูแล <?=$aa?></span>
            </a>
         </li>
         <?php }?>
      </ul>
   </div>
</div>

<!--end: Help -->

<!--begin: User -->
<div class="kt-header__topbar-item kt-header__topbar-item--user">
   <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="20px,10px">
      <img alt="Pic" src="assets/media/users/300_21.jpg" />
   </div>
   <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-md">
      <div class="kt-user-card-v4 kt-user-card-v4--skin-light kt-notification-item-padding-x">
         <div class="kt-user-card-v4__avatar">

            <!--use "kt-rounded" class for rounded avatar style-->
            <img class="kt-rounded-" alt="Pic" src="assets/media/users/300_25.jpg" />

            <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
            <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">S</span>
         </div>
         <div class="kt-user-card-v4__name">
            Sean Stone
            <small>Product Designer</small>
         </div>
         <div class="kt-user-card-v4__badge kt-hidden">
            <span class="btn btn-label-primary btn-sm btn-bold btn-font-md">23 messages</span>
         </div>
      </div>
      <ul class="kt-nav kt-margin-b-10">
         <li class="kt-nav__item">
            <a href="custom/profile/personal-information.html" class="kt-nav__link">
               <span class="kt-nav__link-icon"><i class="flaticon2-schedule"></i></span>
               <span class="kt-nav__link-text">My Profile</span>
            </a>
         </li>
         <li class="kt-nav__item">
            <a href="custom/profile/overview-1.html" class="kt-nav__link">
               <span class="kt-nav__link-icon"><i class="flaticon2-writing"></i></span>
               <span class="kt-nav__link-text">Tasks</span>
            </a>
         </li>
         <li class="kt-nav__item">
            <a href="custom/profile/overview-2.html" class="kt-nav__link">
               <span class="kt-nav__link-icon"><i class="flaticon2-mail-1"></i></span>
               <span class="kt-nav__link-text">Messages</span>
            </a>
         </li>
         <li class="kt-nav__item">
            <a href="custom/profile/account-settings.html" class="kt-nav__link">
               <span class="kt-nav__link-icon"><i class="flaticon2-drop"></i></span>
               <span class="kt-nav__link-text">Settings</span>
            </a>
         </li>
         <li class="kt-nav__separator kt-nav__separator--fit"></li>
         <li class="kt-nav__custom kt-space-between">
            <a href="/signout" class="btn btn-label-brand btn-upper btn-sm btn-bold">SIGN OUT</a>
            <i class="flaticon2-information kt-label-font-color-2" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Click to learn more..."></i>
         </li>
      </ul>
   </div>
</div>

<!--end: User -->
</div>
