<?php
$admin_ecommerce_phone_show = get_config('admin_ecommerce_phone_show');
if(empty($admin_ecommerce_phone_show )) $admin_ecommerce_phone_show = 'yes';

$admin_ecommerce_cofirm_post = get_config('admin_ecommerce_cofirm_post');
if(empty($admin_ecommerce_cofirm_post)) $admin_ecommerce_cofirm_post = 'yes';

$admin_ecommerce_require_register_email = get_config('admin_ecommerce_require_register_email');
if(empty($admin_ecommerce_require_register_email)) $admin_ecommerce_require_register_email = 'yes';

$admin_ecommerce_max_files_upload = get_config('admin_ecommerce_max_files_upload');
if(empty($admin_ecommerce_max_files_upload)) $admin_ecommerce_max_files_upload = 9;

$admin_ecommerce_phi_dang_tin = get_config('admin_ecommerce_phi_dang_tin');
if(empty($admin_ecommerce_phi_dang_tin)) $admin_ecommerce_phi_dang_tin = 0;

$admin_ecommerce_phi_up_tin = get_config('admin_ecommerce_phi_up_tin');
if(empty($admin_ecommerce_phi_up_tin)) $admin_ecommerce_phi_up_tin = 0;

for($i=1;$i<=5;$i++)
{
    ${'admin_ecommerce_vip' . $i . '_cat_id'} = get_config('admin_ecommerce_vip' . $i .'_cat_id');
    ${'admin_ecommerce_vip' . $i . '_gia'} = get_config('admin_ecommerce_vip' . $i .'_gia');
}


$admin_ecommerce_bank_info = get_config('admin_ecommerce_bank_info');
$admin_ecommerce_billing_sms = get_config('admin_ecommerce_billing_sms');