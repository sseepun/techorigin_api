
<div class="kt-subheader kt-grid__item mb-0">
    <div class="kt-container">

        <div class="table-options mb-2">
            <div class="custom-btns mb-4">
                <button class="btn custom-btn-primary" type="button"data-toggle="modal" data-target="#uploadModal">
                    Import เงินเดือน
                </button>
            </div>
            <div class="options">
                <div class="option mr-2">
                    <select class="form-control">
                        <option value="" selected>สถานะการ</option>
                        <option value="1">เปิดใช้งาน</option>
                        <option value="2">ปิดใช้งาน</option>
                    </select>
                </div>
                <div class="option option-search">
                    <input type="text" class="form-control" placeholder="ค้นหา" required />
                    <i class="flaticon2-search-1"></i>
                </div>
            </div>
        </div>

        <div class="table-wrapper kt-scroll" data-scroll="true" data-scroll-x="true" data-scroll-y="false">
            <table class="table table-striped m-table">
                <thead>
                    <tr>
                        <th style="min-width:240px;">รายการเงินเดือน</th>
                        <th class="text-center" style="min-width:100px;">เดือน/ปี</th>
                        <th class="text-center" style="min-width:120px;">จำนวนรายการ</th>
                        <th class="text-center" style="min-width:80px;">ไฟล์แนบ</th>
                        <th class="text-center" style="min-width:140px;">สถานะการใช้งาน</th>
                        <th class="text-center" style="min-width:70px;">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<10; $i++){?>
                        <tr>
                            <td>
                                <a href="portals/monthly-records/2563/9" class="link">
                                    สลิปเงินเดือนประจำเดือน กรกฎาคม 2563
                                </a>
                            </td>
                            <td class="text-center">ก.ค.2563</td>
                            <td class="text-center">2,345</td>
                            <td class="text-center">
                                <a href="#" class="link-icon link-icon-lg color-gray">
                                    <i class="flaticon2-download"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" checked />
                                    <label class="custom-control-label">
                                        เปิดใช้งาน
                                    </label>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="#" class="link-icon color-danger">
                                    <i class="flaticon2-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>

        <div class="kt-pagination mt-4">
            <ul class="kt-pagination__links">
                <li class="kt-pagination__link--first">
                    <a href="#"><i class="fa fa-angle-double-left"></i></a>
                </li>
                <li class="kt-pagination__link--next">
                    <a href="#"><i class="fa fa-angle-left"></i></a>
                </li>
                <li>
                    <a href="#">...</a>
                </li>
                <li>
                    <a href="#">29</a>
                </li>
                <li>
                    <a href="#">30</a>
                </li>
                <li class="kt-pagination__link--active">
                    <a href="#">32</a>
                </li>
                <li>
                    <a href="#">34</a>
                </li>
                <li>
                    <a href="#">...</a>
                </li>
                <li class="kt-pagination__link--prev">
                    <a href="#"><i class="fa fa-angle-right"></i></a>
                </li>
                <li class="kt-pagination__link--last">
                    <a href="#"><i class="fa fa-angle-double-right"></i></a>
                </li>
            </ul>
            <div class="kt-pagination__toolbar">
                <select class="form-control" style="width:60px;">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span class="pagination__desc">
                    แสดง 1 - 10 จาก 230
                </span>
            </div>
        </div>

    </div>
</div>
