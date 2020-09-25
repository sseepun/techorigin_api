<head>
  <base href="">
  <meta charset="utf-8" />
  <title>ระบบการจัดการเอกสารอัจฉริยะ (IEAT SMART)</title>
  <meta name="description" content="Latest updates and statistic charts">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!--begin::Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;300;400;500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">

  <!--end::Fonts -->

  <!--begin::Page Vendors Styles(used by this page) -->
  <link href="../assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />

  <!--end::Page Vendors Styles -->

  <!--begin::Global Theme Styles(used by all pages) -->
  <link href="../assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
  <link href="../assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

  <!--end::Global Theme Styles -->

  <!--begin::Layout Skins(used by all pages) -->

  <!--end::Layout Skins -->
  <link rel="shortcut icon" href="../assets/media/logos/favicon.png" />

  <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />
</head>
<style>
  #linechart1,#linechart2,#linechart3{
    width: 100%;
    padding:10px;
  }
</style>
<!-- end::Head -->

<!-- begin::Body -->

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-all kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-scrolltop--on" data-gr-c-s-loaded="true">
  <!-- <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading"> -->

  <!-- begin::Page loader -->

  <!-- end::Page Loader -->

  <!-- begin:: Page -->


  <div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
      <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">


        <div class="kt-container  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch">
          <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
            <div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

              <!-- begin:: Content -->
              <div class="kt-container  kt-grid__item kt-grid__item--fluid">
                <div class="row pt-4">
                  <div class="col-12 col-lg-6 col-xl-7"> 
                    <!-- Feed Types -->
                    <div class="feed-types">
                      <button class="btn app-btn app-btn-a-link">มาใหม่</button>
                      <div class="app-separator"></div>
                      <button class="btn app-btn app-btn-header">ยอดนิยม</button>
                      <div class="app-separator-line mx-4"></div>
                      <button class="btn app-btn app-btn-icon app-btn-shape2">
                        <span class="material-icons-outlined">tune</span>
                      </button>
                    </div>

                    <!-- Feed date -->
                    <div class="feed-date">
                      วันนี้
                      <div class="app-separator-line ml-4"></div>
                    </div>

                    <?php 
                    for($aa=1;$aa<=2;$aa++){
                    ?>
                    <!-- Post 1 -->
                    <div class="kt-portlet feed-card">
                      <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                          <div class="feed-card-header">
                            <div class="avatar-wrapper">
                              <a href="#" class="kt-media kt-media--circle">
                                <img src="../assets/media/users/100_1.jpg" alt="image">
                              </a>
                            </div>
                            <div class="feed-header">
                              <div class="person-line">
                                <a href="#" class="from-person">การะเกต แสงขัย</a>
                                <span class="material-icons person-divider">chevron_right</span>
                                <a href="#" class="to-person">จัดการงานเอกสาร</a>
                              </div>
                              <div class="date-line">24 เมษายน เวลา 12:09 น.</div>
                              <div class="content-line">
                                <div class="attachment">
                                  <img src="../assets/images/feed/pdf.png" alt="pdf">
                                </div>
                                <a href="#" class="content">
                                  <div class="content-title">สรุปหนังสือ ทำไม Netflix ถึงมีแต่คนโคตรเก่ง</div>
                                  <div class="content-category">บทความ / ความรู้</div>
                                  <div class="content-detail">ผมว่าใจความสำคัญของเล่มนี้คือ “บริหารทีมงานเหมือนทีมกีฬา” คุณอาจสงสัยว่าแล้วการบริหาร “ทีมกีฬา” มันต่างจากการบริหาร “ทีมงาน” แบบเดิมอย่างไรล่ะ แต่ก่อนจะไปถึงจุดนั้น เราคุ้นเคยกับประโยคที่บอกว่า ทีมงานเรา “เหมือนครอบครัว” ได้ใช่มั้ยครับ</div>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                          <div class="kt-portlet__head-toolbar-wrapper">
                            <div class="dropdown dropdown-inline">
                              <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-ellipsis-v"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">สัปดาห์นี้</span>
                                    </a>
                                  </li>
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">เดือนนี้</span>
                                    </a>
                                  </li>
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">ไตรมาสนี้</span>
                                    </a>
                                  </li>
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">เดือนที่ผ่านมา</span>
                                    </a>
                                  </li>
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">ไตรมาสที่ผ่านมา</span>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="feed-card-actions">
                        <div class="actions-row">
                          <div class="reactions">
                            <span class="material-icons-outlined">thumb_up</span>
                            <span class="material-icons-outlined">sentiment_satisfied_alt</span>
                            <span class="material-icons">favorite</span>
                            <span class="material-icons-outlined">sentiment_very_dissatisfied</span>
                            <span class="text-a-link2">123</span>
                          </div>
                          <div class="num-comments">
                            ความคิดเห็น 2 รายการ
                          </div>
                        </div>
                        <div class="actions-row">
                          <button class="btn app-btn app-btn-lg app-btn-shape4 flex-fill mr-2">
                            <span class="material-icons-outlined">thumb_up</span>
                            ถูกใจ
                          </button>
                          <button class="btn app-btn app-btn-lg app-btn-shape4 flex-fill ml-2">
                            <span class="material-icons-outlined">mode_comment</span>
                            แสดงความคิดเห็น
                          </button>
                        </div>
                      </div>
                      <div class="kt-portlet__body kt-portlet__body--fluid p-0">
                        <div class="feed-card-body">
                          <!-- Comment 1 -->
                          <div class="comment-block">
                            <div class="avatar-wrapper">
                              <a href="#" class="kt-media kt-media--circle kt-media--custom">
                                <img src="../assets/media/users/100_2.jpg" alt="image">
                              </a>
                            </div>
                            <div class="comment-wrapper">
                              <div class="comment-bubble">
                                <a href="#" class="comment-name">สมศรีเอง</a>
                                <div class="comment-content">สรุปเนื้อหาดี อ่านเข้าใจง่าย ขอบคุณมากๆค่ะ</div>
                              </div>
                              <div class="comment-actions">
                                <span class="comment-action">ถูกใจ</span>
                                <div class="app-separator app-separator-sm"></div>
                                <span class="comment-action">ตอบกลับ</span>
                                <div class="app-separator app-separator-sm"></div>
                                <span class="comment-date">2 วัน</span>
                              </div>
                            </div>
                          </div>
                          <!-- Comment 2 -->
                          <div class="comment-block">
                            <div class="avatar-wrapper">
                              <a href="#" class="kt-media kt-media--circle kt-media--custom">
                                <img src="../assets/media/users/100_3.jpg" alt="image">
                              </a>
                            </div>
                            <div class="comment-wrapper">
                              <div class="comment-sticker">
                                <a href="#" class="comment-name">นายกมล</a>
                                <img src="../assets/images/feed/sticker.png" alt="เยี่ยมเลย">
                              </div>
                              <div class="comment-actions">
                                <span class="comment-action">ถูกใจ</span>
                                <div class="app-separator app-separator-sm"></div>
                                <span class="comment-action">ตอบกลับ</span>
                                <div class="app-separator app-separator-sm"></div>
                                <span class="comment-date">1 วัน</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Post 1 -->

                    <!-- Post 2 -->
                    <div class="kt-portlet feed-card">
                      <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                          <div class="feed-card-header">
                            <div class="avatar-wrapper">
                              <a href="#" class="kt-media kt-media--circle">
                                <img src="../assets/media/users/100_7.jpg" alt="image">
                              </a>
                            </div>
                            <div class="feed-header">
                              <div class="person-line">
                                <a href="#" class="from-person">ปาริชาต สมสินใจ</a>
                                <span class="material-icons person-divider">chevron_right</span>
                                <a href="#" class="to-person">จัดการการฝึกอบรม</a>
                              </div>
                              <div class="date-line">24 เมษายน เวลา 14:53 น.</div>
                              <div class="content-line">
                                <div class="attachment">
                                  <img src="../assets/images/feed/excel.png" alt="excel">
                                </div>
                                <a href="#" class="content">
                                  <div class="content-title">Excel Advance ประยุกต์หลากสาย เรียนรู้จากกลาง - สูง</div>
                                  <div class="content-category">โปรแกรมสำนักงาน / Microsoft Excel</div>
                                  <div class="content-detail">เป็นหลักสูตรที่เหมาะสำหรับผู้ที่จบจากหลักสูตร “สำหรับผู้เริ่มต้นจนถึงระดับกลาง” หรือเป็นผู้ที่เคยใช้โปรแกรมมาบ้างพอสมควร เช่น การเปิดไฟล์งาน การบันทึก การจัดรูปแบบขั้นพื้นฐาน รวมทั้งการแก้ไขปัญหาการพิมพ์ด้วยปุ่มบนคีย์บอร์ด ซึ่งต้องการใช้งานโปรแกรม Excel แบบขั้นสูงในด้านเทคนิคต่างๆ</div>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                          <div class="kt-portlet__head-toolbar-wrapper">
                            <div class="dropdown dropdown-inline">
                              <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-ellipsis-v"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">สัปดาห์นี้</span>
                                    </a>
                                  </li>
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">เดือนนี้</span>
                                    </a>
                                  </li>
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">ไตรมาสนี้</span>
                                    </a>
                                  </li>
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">เดือนที่ผ่านมา</span>
                                    </a>
                                  </li>
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">ไตรมาสที่ผ่านมา</span>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="feed-card-actions">
                        <div class="actions-row">
                          <div class="reactions">
                            <span class="material-icons-outlined">thumb_up</span>
                            <span class="material-icons-outlined">sentiment_satisfied_alt</span>
                            <span class="material-icons">favorite</span>
                            <span class="material-icons-outlined">sentiment_very_dissatisfied</span>
                            <span class="text-a-link2">234</span>
                          </div>
                          <div class="num-comments">
                            ความคิดเห็น 14 รายการ
                          </div>
                        </div>
                        <div class="actions-row">
                          <button class="btn app-btn app-btn-lg app-btn-shape4 flex-fill mr-2">
                            <span class="material-icons-outlined">thumb_up</span>
                            ถูกใจ
                          </button>
                          <button class="btn app-btn app-btn-lg app-btn-shape4 flex-fill ml-2">
                            <span class="material-icons-outlined">mode_comment</span>
                            แสดงความคิดเห็น
                          </button>
                        </div>
                      </div>
                    </div>
                    <!-- End Post 2 -->

                    <!-- Post 3 -->
                    <div class="kt-portlet feed-card">
                      <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                          <div class="feed-card-header">
                            <div class="avatar-wrapper">
                              <a href="#" class="kt-media kt-media--circle">
                                <img src="../assets/media/users/100_10.jpg" alt="image">
                              </a>
                            </div>
                            <div class="feed-header">
                              <div class="person-line">
                                <a href="#" class="from-person">ธัญพิชชา สายใย</a>
                                <span class="material-icons person-divider">chevron_right</span>
                                <a href="#" class="to-person">Task & Project Management</a>
                              </div>
                              <div class="date-line">25 เมษายน เวลา 10:19 น.</div>
                              <div class="content-line">
                                <div class="attachment">
                                  <img src="../assets/images/feed/5s.png" alt="5s">
                                </div>
                                <a href="#" class="content">
                                  <div class="content-title">โครงการกิจกรรม 5ส.</div>
                                  <div class="content-category">โครงการภายใน</div>
                                  <div class="content-detail">การจัดระเบียบและปรับปรุงสถานที่ทำงานหรือสภาพทำงาน และงานของตนด้วยตนเอง เพื่อก่อให้ เกิดสภาพแวดล้อมการทำงานที่ดี ปลอดภัย มีระเบียบเรียบร้อย มีคุณภาพและประสิทธิภาพ อันเป็นพื้นฐานใน การเพิ่มผลผลิต</div>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                          <div class="kt-portlet__head-toolbar-wrapper">
                            <div class="dropdown dropdown-inline">
                              <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-ellipsis-v"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">สัปดาห์นี้</span>
                                    </a>
                                  </li>
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">เดือนนี้</span>
                                    </a>
                                  </li>
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">ไตรมาสนี้</span>
                                    </a>
                                  </li>
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">เดือนที่ผ่านมา</span>
                                    </a>
                                  </li>
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">ไตรมาสที่ผ่านมา</span>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="feed-card-actions">
                        <div class="actions-row">
                          <div class="reactions">
                            <span class="material-icons-outlined">thumb_up</span>
                            <span class="material-icons-outlined">sentiment_satisfied_alt</span>
                            <span class="material-icons">favorite</span>
                            <span class="material-icons-outlined">sentiment_very_dissatisfied</span>
                            <span class="text-a-link2">162</span>
                          </div>
                          <div class="num-comments">
                            ความคิดเห็น 54 รายการ
                          </div>
                        </div>
                        <div class="actions-row">
                          <button class="btn app-btn app-btn-lg app-btn-shape4 flex-fill mr-2">
                            <span class="material-icons-outlined">thumb_up</span>
                            ถูกใจ
                          </button>
                          <button class="btn app-btn app-btn-lg app-btn-shape4 flex-fill ml-2">
                            <span class="material-icons-outlined">mode_comment</span>
                            แสดงความคิดเห็น
                          </button>
                        </div>
                      </div>
                    </div>
                    <!-- End Post 3 -->

                    <!-- Post 4 -->
                    <div class="kt-portlet feed-card">
                      <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                          <div class="feed-card-header">
                            <div class="avatar-wrapper">
                              <a href="#" class="kt-media kt-media--circle">
                                <img src="../assets/media/users/100_14.jpg" alt="image">
                              </a>
                            </div>
                            <div class="feed-header">
                              <div class="person-line">
                                <a href="#" class="from-person">สุเมธ จิตรุ่งเรือง</a>
                                <span class="material-icons person-divider">chevron_right</span>
                                <a href="#" class="to-person">จัดการงานเอกสาร</a>
                              </div>
                              <div class="date-line">25 เมษายน เวลา 10:19 น.</div>
                              <div class="content-line">
                                <div class="attachment">
                                  <img src="../assets/images/feed/docx.png" alt="docx">
                                </div>
                                <a href="#" class="content">
                                  <div class="content-title">แบบสอบถามความพึงพอใจ ในการเข้ารับบริการจากหน่วยงาน xxx</div>
                                  <div class="content-category">โครงการภายใน / เอกสารทั่วไป</div>
                                  <div class="content-detail">แบบสอบถามนี้มีวัตถุประสงค์เพื่อประเมินความพึงพอใจของผู้ใช้บริการส่วนการเจ้าหน้าที่ ผลการประเมินและข้อเสนอแนะที่ได้จากแบบสอบถามนี้จะถูกนำไปประมวลผลในภาพรวม และนำผลไปใช้ในการปรับปรุงให้บริการของส่วนการเจ้าหน้าที่ให้มีประสิทธิภาพมากยิ่งขึ้นต่อไป</div>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                          <div class="kt-portlet__head-toolbar-wrapper">
                            <div class="dropdown dropdown-inline">
                              <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-ellipsis-v"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">สัปดาห์นี้</span>
                                    </a>
                                  </li>
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">เดือนนี้</span>
                                    </a>
                                  </li>
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">ไตรมาสนี้</span>
                                    </a>
                                  </li>
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">เดือนที่ผ่านมา</span>
                                    </a>
                                  </li>
                                  <li class="kt-nav__item">
                                    <a href="#" class="kt-nav__link">
                                      <span class="kt-nav__link-text">ไตรมาสที่ผ่านมา</span>
                                    </a>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="feed-card-actions">
                        <div class="actions-row">
                          <div class="reactions">
                            <span class="material-icons-outlined">thumb_up</span>
                            <span class="material-icons-outlined">sentiment_satisfied_alt</span>
                            <span class="material-icons">favorite</span>
                            <span class="material-icons-outlined">sentiment_very_dissatisfied</span>
                            <span class="text-a-link2">162</span>
                          </div>
                          <div class="num-comments">
                            ความคิดเห็น 54 รายการ
                          </div>
                        </div>
                        <div class="actions-row">
                          <button class="btn app-btn app-btn-lg app-btn-shape4 flex-fill mr-2">
                            <span class="material-icons-outlined">thumb_up</span>
                            ถูกใจ
                          </button>
                          <button class="btn app-btn app-btn-lg app-btn-shape4 flex-fill ml-2">
                            <span class="material-icons-outlined">mode_comment</span>
                            แสดงความคิดเห็น
                          </button>
                        </div>
                      </div>
                    </div>
                    <!-- End Post 4 -->

                    <?php }?>

                    <button class="btn app-btn app-btn-xl app-btn-primary-light w-100 my-4 my-xl-0">
                      + โหลดข้อมูลเพิ่มเติม
                    </button>
                  </div>
                  <div class="col-12 col-lg-6 col-xl-5">
                    <!-- Online List -->
                    <div class="kt-portlet">
                      <div class="kt-portlet__head kt-portlet__head--noborder">
                        <div class="kt-portlet__head-label">
                          <h3 class="kt-portlet__head-title">พนักงานที่ออนไลน์</h3>
                        </div>
                      </div>
                      <div class="kt-portlet__body kt-portlet__body--fluid">
                        <div class="d-flex align-items-center flex-column flex-md-row">
                          <div class="number">
                            <h1>153</h1>
                          </div>
                          <div class="online-list">
                            <?php 
                              for($aa=1;$aa<=23;$aa++){
                                $_index = ($aa>14?$aa-14:$aa);
                            ?>
                            <div class="person-wrapper">
                              <a href="#" class="kt-media kt-media--circle kt-media--custom">
                                <img src="../assets/media/users/100_<?=$_index?>.jpg" alt="image">
                              </a>
                            </div>
                            <?php }?>
                            <div class="person-wrapper">
                              <a href="#" class="kt-media kt-media--circle kt-media--custom">
                                <img src="../assets/media/users/300_7.jpg" alt="image">
                              </a>
                              <span class="counter">
                                +123
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Schedule -->
                    <div class="kt-portlet schedule-card">
                      <div class="kt-portlet__head kt-portlet__head--noborder">
                        <div class="kt-portlet__head-label">
                          <h3 class="kt-portlet__head-title">ตารางนัดหมาย</h3>
                        </div>
                      </div>
                      <div class="kt-portlet__body kt-portlet__body--fluid">
                        <div class="schedule-card-body">
                          <!-- Today -->
                          <div class="schedule-day schedule-today">
                            <div class="schedule-date">
                              <div class="number">
                                <h1>25</h1>
                                <span>May</span>
                              </div>
                            </div>
                            <div class="schedule-plan">
                              <a href="#" class="schedule-plan-item plan-item-blue">
                                <div class="plan-time">09:30 น. - 11:00 น.</div>
                                <div class="plan-title">ประชุมกับฝ่ายจัดซื้อจัดจ้าง</div>
                                <div class="plan-location"><span class="material-icons-outlined">
                                    pin_drop
                                  </span> ห้องมิตรไมตรี ชั้น 3 อาคารอำนวยการ
                                </div>
                              </a>
                              <a href="#" class="schedule-plan-item plan-item-red">
                                <div class="plan-time">13:30 น. - 14:30 น.</div>
                                <div class="plan-title">ประชุมร่างงบประมาณ 2563</div>
                                <div class="plan-location"><span class="material-icons-outlined">
                                    pin_drop
                                  </span> ห้องมิตรไมตรี ชั้น 3 อาคารอำนวยการ</div>
                              </a>
                              <a href="#" class="schedule-plan-item">
                                <div class="plan-time">15:00 น. - 16:00 น.</div>
                                <div class="plan-title">ประชุมอัพเดทงานภายใน</div>
                              </a>
                            </div>
                          </div>

                          <!-- Other Day -->
                          <div class="schedule-day">
                            <div class="schedule-date">
                              <div class="number">
                                <h1>26</h1>
                                <span>May</span>
                              </div>
                            </div>
                            <div class="schedule-plan">
                              <a href="#" class="schedule-plan-item">
                                <div class="plan-time">08:00 น. - 09:30 น.</div>
                                <div class="plan-title">ประชุมอัพเดทงานภายใน(ต่อ)</div>
                              </a>
                            </div>
                          </div>
                          <!-- End Other Day -->

                          <!-- Other Day -->
                          <div class="schedule-day">
                            <div class="schedule-date">
                              <div class="number">
                                <h1>27</h1>
                                <span>May</span>
                              </div>
                            </div>
                            <div class="schedule-plan">
                              <a href="#" class="schedule-plan-item plan-item-green">
                                <div class="plan-time">ทั้งวัน</div>
                                <div class="plan-title">ประชุมตรวจรับงานเว็บไซต์และเว็บไซต์ย่อย</div>
                              </a>
                            </div>
                          </div>
                          <!-- End Other Day -->
                        </div>
                      </div>
                    </div>

                    <!-- Monthly Stat. Card -->
                    <div class="kt-portlet stat-card">
                      <div class="kt-portlet__head kt-portlet__head--noborder">
                        <div class="kt-portlet__head-label">
                          <h3 class="kt-portlet__head-title">สถิติงานเดือนนี้</h3>
                        </div>
                      </div>
                      <div class="kt-portlet__body kt-portlet__body--fluid">
                        <div class="stat-card-body">
                          <div class="stat-row">
                            <div class="stat-status">
                              <div class="number text-danger">
                                <h1>18</h1>
                                <span>เกินกำหนด</span>
                              </div>
                            </div>
                            <div class="stat-graph">
                              <div id="linechart1"></div>
                            </div>
                          </div>
                          <div class="stat-row">
                            <div class="stat-status">
                              <div class="number text-primary">
                                <h1>27</h1>
                                <span>งานกำลังทำ</span>
                              </div>
                            </div>
                            <div class="stat-graph">
                              <div id="linechart2"></div>
                            </div>
                          </div>
                          <div class="stat-row">
                            <div class="stat-status">
                              <div class="number text-success">
                                <h1>18</h1>
                                <span>งานที่ทำเสร็จ</span>
                              </div>
                            </div>
                            <div class="stat-graph">
                              <div id="linechart3"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Monthly Stat. Card -->
                    <div id="widget1" class="kt-portlet stat-card" style="display:none;" >
                      <div class="kt-portlet__head kt-portlet__head--noborder">
                        <div class="kt-portlet__head-label">
                          <h3 class="kt-portlet__head-title">ความคืบหน้าของโครงการ</h3>
                        </div>
                      </div>
                      <div class="kt-portlet__body kt-portlet__body--fluid">
                        <div class="stat-card-body">
                          
                          <div id="projectprogress" style="width:100%;"></div>
                          
                        </div>
                      </div>
                    </div>

                    <!-- Monthly Stat. Card -->
                    <div id="widget2" class="kt-portlet stat-card" style="display:none;">
                      <div class="kt-portlet__head kt-portlet__head--noborder">
                        <div class="kt-portlet__head-label">
                          <h3 class="kt-portlet__head-title">สถิติการเข้าใช้งานระบบ</h3>
                        </div>
                      </div>
                      <div class="kt-portlet__body kt-portlet__body--fluid">
                        <div class="stat-card-body">
                          
                          <div id="staticlogin" style="width:100%;"></div>
                          
                        </div>
                      </div>
                    </div>

                    <!-- Monthly Stat. Card -->
                    <div id="widget3" class="kt-portlet stat-card" style="display:none;">
                      <div class="kt-portlet__head kt-portlet__head--noborder">
                        <div class="kt-portlet__head-label">
                          <h3 class="kt-portlet__head-title">ภาพรวมพื้นที่ Diskspace</h3>
                        </div>
                      </div>
                      <div class="kt-portlet__body kt-portlet__body--fluid">
                        <div class="stat-card-body">
                          <div class="stat-row">
                            <div class="stat-status">
                              <div class="number text-danger">
                                <h1>27%</h1>
                              </div>
                            </div>
                            <div class="stat-graph">
                              <div id="diskspace" style="width:100%;"></div>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-end">
                      <button class="btn app-btn app-btn-primary-light" data-toggle="modal" data-target="#addWidget">+ เพิ่มวิดเจ็ต</button>
                      <div class="app-separator"></div>
                      <button class="btn app-btn app-btn-primary-light">จัดเรียงวิดเจ็ต</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- end:: Content -->
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

  <!-- end:: Page -->

  <div class="modal fade bd-example-modal-xl" id="addWidget" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">เพิ่มวิดเจ็ต</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="max-height: 500px;">
          <div class="row">
            <div class="col-md-3">

               <input type="text" class="form-control" style="width:87%; margin-bottom: 10px;" placeholder="คำค้น...">
             
            </div>
            <div class="col-md-9">
              <table class="table table-striped table-hover">
                <?php
                for($aa=1;$aa<50;$aa++){
                ?>
                  <tr>
                    <td width="20%" style="text-align: center;">
                      <img src="../assets/images/apex-charts/charts-<?=rand(1,24)?>.svg" alt="area-chart-spline" style="height: 100px;">
                    </td>
                    <td >
                        <div class="content">
                          <h6 class="content-title">Activity Stream</h6>
                          <small class="content-category">Feed Streaming</small>
                          <div class="content-detail">แสดงรายการกิจกรรมล่าสุดทุกระบบที่ผู้ใช้งานมีสิทธิเข้าถึง</div>
                        </div>
                    </td>
                    <td width="20%" style="text-align: right; vertical-align:middle;">
                    <button type="button" onClick="divFunction()" class="btn btn-primary btn-sm">เพิ่มวิดเจ็ต</button>
                    </td>
                  </tr>
                <?php }?>
              </table>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn app-btn app-btn-primary-light" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- begin::Scrolltop -->
  <div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
  </div>

  <!-- end::Scrolltop -->