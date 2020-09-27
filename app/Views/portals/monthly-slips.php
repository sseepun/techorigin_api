
<div class="kt-subheader kt-grid__item mb-0">
    <div class="kt-container">

        <div class="table-options mb-2">
            <div class="custom-btns mb-4">
                <a href="/portals" class="ml-3 a-link">
                    กลับไปหน้ารวมรายการ
                </a>
            </div>
            <div class="options">
                <div class="option mr-2">
                    <select class="form-control">
                        <option value="" selected>สำนัก</option>
                        <option value="1">เปิดใช้งาน</option>
                        <option value="2">ปิดใช้งาน</option>
                    </select>
                </div>
                <div class="option option-search">
                    <input type="text" class="form-control" placeholder="ค้นหา" required 
                    value="<?= $tablePaginate['keywords']; ?>" />
                    <i class="flaticon2-search-1"></i>
                </div>
            </div>
        </div>

        <div class="table-wrapper kt-scroll" data-scroll="true" data-scroll-x="true" data-scroll-y="false">
            <table class="table table-striped m-table">
                <thead>
                    <tr>
                        <th style="min-width:220px;">เจ้าหน้าที่</th>
                        <th class="text-center" style="min-width:100px;">เลขสลิป</th>
                        <th class="text-center" style="min-width:120px;">เลข PSN</th>
                        <th class="text-center" style="min-width:80px;">เปิดดูโดยตรง</th>
                        <th class="text-center" style="min-width:140px;">เปิดดูผ่าน QR Code</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tablePaginate['data'] as $d){?>
                        <tr>
                            <td>
                                <a href="portals/slip/<?= $d['id']; ?>" class="link">
                                    <?= $d['prefix']; ?> <?= $d['firstname']; ?> <?= $d['lastname']; ?>
                                </a>
                            </td>
                            <td class="text-center"><?= $d['slip_id']; ?></td>
                            <td class="text-center"><?= $d['psn_id']; ?></td>
                            <td class="text-center">3</td>
                            <td class="text-center">12</td>
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
