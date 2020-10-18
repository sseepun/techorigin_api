<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        ตำแหน่งผู้ใช้
    </h2>
</div>
<form action="" id="crud_form" method="POST">
    <?= csrf_field() ?>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6 md:col-span-9 sm:col-span-10">
            <div class="intro-y box p-5 grid grid-cols-12 row-gap-6 col-gap-6">
                <div class="col-span-12 <?= errorClass($validation, 'name') ?>">
                    <label>ชื่อตำแหน่ง</label>
                    <input type="text" name="name" class="input w-full border mt-2" <?= intputAttr($process) ?>
                    value="<?= inputValue($target, 'name', '', set_value('name')) ?>" required />
                    <?= errorDisplay($validation, 'name') ?>
                </div>
                <div class="col-span-6 md:col-span-4">
                    <label>ค่าเริ่มต้น</label>
                    <div class="mt-2">
                        <select name="is_default" class="input w-full border" <?= intputAttr($process) ?>>
                            <?= optionValue($target, 'is_default', 1, 'Yes', false, set_value('is_default')) ?>
                            <?= optionValue($target, 'is_default', 0, 'No', true, set_value('is_default')) ?>
                        </select>
                    </div>
                </div>
                <div class="col-span-6 md:col-span-4">
                    <label>ผู้ดูแลระบบ</label>
                    <div class="mt-2">
                        <select name="is_admin" class="input w-full border" <?= intputAttr($process) ?>>
                            <?= optionValue($target, 'is_admin', 1, 'Yes', false, set_value('is_admin')) ?>
                            <?= optionValue($target, 'is_admin', 0, 'No', true, set_value('is_admin')) ?>
                        </select>
                    </div>
                </div>
                <div class="col-span-6 md:col-span-4">
                    <label>ผู้ดูแลระบบขั้นสูง</label>
                    <div class="mt-2">
                        <select name="is_super_admin" class="input w-full border" <?= intputAttr($process) ?>>
                            <?= optionValue($target, 'is_super_admin', 1, 'Yes', false, set_value('is_super_admin')) ?>
                            <?= optionValue($target, 'is_super_admin', 0, 'No', true, set_value('is_super_admin')) ?>
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label>ลำดับ</label>
                    <input type="number" name="rank" class="input w-full border mt-2" <?= intputAttr($process) ?> 
                    value="<?= inputValue($target, 'rank', 0, set_value('rank')) ?>" required min="0" max="99" step="1" />
                </div>
                <div class="col-span-6">
                    <label>สถานะ</label>
                    <div class="mt-2">
                        <select name="status" class="input w-full border" <?= intputAttr($process) ?>>
                            <?= optionValue($target, 'status', 1, 'Active', true, set_value('status')) ?>
                            <?= optionValue($target, 'status', 0, 'Inactive', false, set_value('status')) ?>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 mt-3">
                    <input type="hidden" name="id" value="<?= inputValue($target, 'id', 0) ?>" />
                    <input type="hidden" name="process" value="<?= $process ?>" />
                    <input type="hidden" name="killbot" />
                    <?= buttonSet($process) ?>
                    <a href="<?= $appUrl ?>admin/user-roles" class="inline-block button w-24 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">
                        ย้อนกลับ
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?= inputModal($process) ?>
</form>
