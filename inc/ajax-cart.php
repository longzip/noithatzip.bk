<?php

if (isset($_POST['type']) && $_POST['type'] == 'add_product_to_cart') {
    $ls = explode(",", $_POST['product_id']);
    foreach ($ls as $l) {
        $post = get_post($l);
        if (empty($post['gia']) && empty($post['gia_km'])) $price = 0;
        if (!empty($post['gia']) && !empty($post['gia_km'])) $price = price_to_num($post['gia_km']);
        if (!empty($post['gia']) && empty($post['gia_km'])) $price = price_to_num($post['gia']);
        if (empty($post['gia']) && !empty($post['gia_km'])) $price = price_to_num($post['gia_km']);
        if (!empty($post['gia']) && !empty($post['recent_km'])) {
            $real_price = floor(($post["gia"] - ($post["recent_km"]/100 * $post["gia"]))/1000)*1000;
            $price = price_to_num($real_price);
        }

        add_product_to_cart($l, $_POST['num'], $price);
    }

}

if (isset($_POST['type']) && $_POST['type'] == 'add_data_khach') {
    
    $lists[] = array('name'=>$_POST['name'], 'place'=>$_POST['place'], 'phone'=>$_POST['phone'], 'email'=>$_POST['email'], 'other_info'=>$_POST['other_info']);
    var_dump($lists);
	setcookie('datakhach', json_encode($lists), time() + 3600*24*3, '/');

}

if (isset($_POST['type']) && $_POST['type'] == 'display_cart') {
    display_cart();
}


if (isset($_POST['type']) && $_POST['type'] == 'empty_cart') {
    setcookie('cart', json_encode($lists), time() - 3600 * 24 * 30, '/');
}

if (isset($_POST['type']) && $_POST['type'] == 'delete_cart_item') {
    $lists = json_decode($_COOKIE['cart'], TRUE);
    unset($lists[$_POST['product_id']]);
    setcookie('cart', json_encode($lists), time() + 3600 * 24 * 3, '/');
}

if (isset($_POST['type']) && $_POST['type'] == 'update_cart_item') {
    $lists = json_decode($_COOKIE['cart'], TRUE);

    $lists[$_POST['product_id']]['num'] = $_POST['num'];

    setcookie('cart', json_encode($lists), time() + 3600 * 24 * 3, '/');
}

if (isset($_POST['type']) && $_POST['type'] == 'removeCombo') {
    setcookie('sb', '', time() - 3600 * 24 * 365, '/');
}


if (isset($_POST['type']) && $_POST['type'] == 'order') {
    $total_cost = 0;

    $lists = json_decode($_COOKIE['cart'], TRUE);
    foreach ($lists as $k => $v) {
        $total_cost = $total_cost + $v['price'] * $v['num'];
    }
    if (empty($_COOKIE['sb'])) $_COOKIE['sb'] = '';
    $insert_content = array(
        'name' => $_POST['name'],
        'phone' => $_POST['phone'],
        'place' => $_POST['place'],
        'email' => $_POST['email'],
        'ip_address' => $_SERVER['REMOTE_ADDR'],
        'the_status' => 'new',
        'total_cost' => $total_cost,
        'time_create' => hcv_time(),
        'content' => $_COOKIE['cart'],
        'sb' => $_COOKIE['sb'],
        'other' => $_POST['other_info']
    );

    $insert_id = models_DB::insert($insert_content, ORDER_TABLE);
    if ($insert_id) {

        $notification_content = array(
            'type' => 'user_order',
            'name' => $_POST['name'],
            'order_id' => $insert_id
        );

        $admin = models_DB::get('SELECT id FROM ' . USER_TABLE . ' WHERE permission=\'admin\'');


        foreach ($admin as $v_admin) {
            $param_noti = array(
                'user_id' => $v_admin['id'],
                'content' => json_encode($notification_content),
                'already_read' => 0,
                'time_create' => $insert_content['time_create']
            );
            insert_user_notification($param_noti);
        }
        ?>
        <div id="after-order">
            <p>Đơn hàng của bạn đã được gửi đi</p>
            <p>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất</p>
            <p>Hoặc bạn có thể liên hệ với chúng tôi qua: 0912.99.66.33</p>
            <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi !</p>
            <p>&nbsp;</p>
            <p>Giỏ hàng sẽ được đóng trong <span id="order-desc-time">8</span> giây</p>
        </div>
        <?php
    } else {
        echo 'Đã xảy ra lỗi trong khi đặt hàng';
    }
}
