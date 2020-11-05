<?php

function intputAttr($process){
    if(in_array($process, ['read', 'delete'])) return 'disabled="disabled"';
    else return '';
}

function inputValue($target, $name, $default='', $postValue=''){
    if(!valueEmpty($postValue)){
        return $postValue;
    }else if(!empty($target) && !valueEmpty($target[$name])){
        return $target[$name];
    }else{
        return $default;
    }
}

function optionValue($target, $name, $value, $display, $default=false, $postValue=''){
    if(!valueEmpty($postValue)){
        if($postValue==$value){
            return '<option value="'.$value.'" selected>'.$display.'</option>';
        }else{
            return '<option value="'.$value.'">'.$display.'</option>';
        }
    }else if(!empty($target) &&  !valueEmpty($target[$name])){
        if($target[$name]==$value){
            return '<option value="'.$value.'" selected>'.$display.'</option>';
        }else{
            return '<option value="'.$value.'">'.$display.'</option>';
        }
    }else{
        if($default){
            return '<option value="'.$value.'" selected>'.$display.'</option>';
        }else{
            return '<option value="'.$value.'">'.$display.'</option>';
        }
    }
}

function valueEmpty($val){
    return empty($val) && $val != '0';
}

function buttonSet($process){
    if($process=='create'){
        return '<button type="submit" class="button w-24 bg-theme-1 text-white">เพิ่ม</button>';
    }else if($process=='update'){
        return '<button type="submit" class="button w-24 bg-theme-1 text-white">แก้ไข</button>
            <a href="javascript:;" data-toggle="modal" data-target="#delete-modal" class="button inline-block bg-theme-6 text-white w-24">ลบ</a>';
    }else if($process=='delete'){
        return '<a href="javascript:;" data-toggle="modal" data-target="#delete-modal" class="button inline-block bg-theme-6 text-white w-24">ลบ</a>';
    }
}
function inputModal($process){
    if(in_array($process, ['update', 'delete'])){
        return '<div class="modal" id="delete-modal">
            <div class="modal__content">
                <div class="p-5 text-center">
                    <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                    <div class="text-3xl mt-5">ยืนยันการลบข้อมูล</div>
                    <div class="text-gray-600 mt-2">
                        กรุณายืนยันการลบข้อมูล กระบวนการนี้ไม่สามารถยกเลิกได้
                    </div>
                </div>
                <div class="px-5 pb-8 text-center">
                    <button type="button" class="button w-24 bg-theme-6 text-white" id="confirm_delete_btn">ทำการลบ</button>
                    <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">ยกเลิก</button>
                </div>
            </div>
        </div>';
    }
}

function errorDisplay($validation, $name){
    if($validation && !empty($validation->getError($name))){
        return '<div class="pristine-error text-theme-6 mt-2">'.$validation->getError($name).'</div>';
    }else{
        return '';
    }
}
function errorClass($validation, $name){
    if($validation && !empty($validation->getError($name))){
        return 'has-error';
    }else{
        return '';
    }
}
