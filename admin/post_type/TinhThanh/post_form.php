<script>
$(document).ready(function(){
    
    var tinh_thanh_first_value = $(".tinh_thanh-select").val();
    
    $("body").on("change" , ".tinh_thanh-select", function(){
        var value = $(this).val();
        var par = $(this).find(":selected").attr("par");
        if(value != tinh_thanh_first_value) $(".quan_huyen-select").val("0");
        if(par == '0')
        {
            $(".quan_huyen-noneselect").css("display", "block");
            $(".quan_huyen-select .quan-huyen").css("display", "none");
            
            return;
        }
        
         
        var parent = $(this).closest(".khu_vuc-" + par);
        
         
        
        $(".quan_huyen-select .quan-huyen").css("display", "none");
        $(".quan_huyen-noneselect").css("display", "none");
        $(".quan_huyen-select .quan-huyen-" + par).css("display", "block");
     });
     $(".tinh_thanh-select").change();
});
</script>


<div class="new-thread-item box">
    <div class="field-title">
        <label class="label"><?php echo $temp_post_type['title'] ?></label>
    </div>
    
    <div class="field-content">
        <?php 
            $lists = array(
            'Hà Nội' => 'Ba Đình, Ba Vì, Bắc Từ Liêm, Cầu Giấy, Chương Mỹ, Đan Phượng, Đông Anh, Đống Đa, Gia Lâm, Hà Đông, Hai Bà Trưng, Hoài Đức, Hoàn Kiếm, Hoàng Mai, Long Biên, Mê Linh, Mỹ Đức, Nam Từ Liêm, Phú Xuyên, Phúc Thọ, Quốc Oai, Sóc Sơn, Sơn Tây, Tây Hồ, Thạch Thất, Thanh Oai, Thanh Trì, Thanh Xuân, Thường Tín, Ứng Hòa',
            'TP HCM' => 'Bình Chánh, Bình Tân, Bình Thạnh, Cần Giờ, Củ Chi, Gò Vấp, Hóc Môn, Nhà Bè, Phú Nhuận, Quận 1, Quận 2, Quận 3, Quận 4, Quận 5, Quận 6, Quận 7, Quận 8, Quận 9, Quận 10, Quận 11, Quận 12, Tân Bình, Tân Phú, Thủ Đức',
            'Cần Thơ'=> 'Bình Thủy, Cái Răng, Cờ Đỏ, Ninh Kiều, Ô Môn, Phong Điền, Thốt Nốt, Thới Lai, Vĩnh Thạnh',
            'Đà Nẵng' => 'Cẩm Lệ, Hải Châu, Hòa Vang, Hoàng Sa, Liên Chiểu, Ngũ Hành Sơn, Sơn Trà, Thanh Khê',
            'Hải Phòng' => 'An Dương, An Lão, Bạch Long Vĩ, Cát Hải, Dương Kinh, Đồ Sơn, Hải An, Hồng Bàng, Kiến An, Kiến Thụy, Lê Chân, Ngô Quyền, Thuỷ Nguyên, Tiên Lãng, Vĩnh Bảo',
            'An Giang' => 'An Phú, Châu Đốc, Châu Phú, Châu Thành, Chợ Mới, Long Xuyên, Phú Tân, Tân Châu, Thoại Sơn, Tịnh Biên, Tri Tôn',
            'Bà Rịa - Vũng Tàu' => 'Côn Đảo, Đất Đỏ, Tân Thành, Vũng Tàu, Xuyên Mộc, Bà Rịa, Châu Đức, Long Điền',
            'Bắc Giang' => 'Bắc Giang, Hiệp Hòa, Lạng Giang, Lục Nam, Lục Ngạn, Sơn Động, Tân Yên, Việt Yên, Yên Dũng, Yên Thế',
            'Bắc Kạn' => 'Ba Bể, Bạch Thông, Bắc Kạn, Chợ Đồn, Chợ Mới, Na Rì, Ngân Sơn, Pác Nặm',
            'Bạc Liêu' => 'Bạc Liêu, Đông Hải, Giá Rai, Hoà Bình, Hồng Dân, Phước Long, Vĩnh Lợi',
            'Bắc Ninh' => 'Bắc Ninh, Gia Bình, Lương Tài, Quế Võ, Thuận Thành, Tiên Du, Từ Sơn, Yên Phong',
            'Bến Tre' => 'Ba Tri, Bến Tre, Bình Đại, Châu Thành, Chợ Lách, Giồng Trôm, Mỏ Cày Bắc, Mỏ Cày Nam, Thạnh Phú',
            'Bình Định' => 'An Lão, An Nhơn, Hoài Ân, Hoài Nhơn, Phù Cát, Phù Mỹ, Quy Nhơn, Tây Sơn, Tuy Phước, Vân Canh, Vĩnh Thạnh',
            'Bình Dương' => 'Bàu Bàng, Bắc Tân Uyên, Bến Cát, Dầu Tiếng, Dĩ An, Phú Giáo, Tân Uyên, Thủ Dầu Một, Thuận An',
            'Bình Phước' => 'Bình Long, Bù Đăng, Bù Đốp, Bù Gia Mập, Chơn Thành, Đồng Phú, Đồng Xoài, Hớn Quản, Lộc Ninh, Phú Riềng, Phước Long',
            'Bình Thuận' => 'Bắc Bình, Đức Linh, Hàm Tân, Hàm Thuận Bắc, Hàm Thuận Nam, La Gi, Phan Thiết, Phú Quý, Tánh Linh, Tuy Phong',
            'Cà Mau' => 'Cà Mau, Cái Nước, Đầm Dơi, Năm Căn, Ngọc Hiển, Phú Tân, Thới Bình, Trần Văn Thời, U Minh',
            'Cao Bằng' => 'Bảo Lạc, Bảo Lâm, Cao Bằng, Hà Quảng, Hạ Lang, Hòa An, Nguyên Bình, Phục Hòa, Quảng Uyên, Thạch An, Thông Nông, Trà Lĩnh, Trùng Khánh',
            'Đắk Lắk' => 'Buôn Đôn, Buôn Hồ, Buôn Ma Thuột, Cư Kuin, Cư M\'gar, Ea H\'leo, Ea Kar, Ea Súp, Krông Ana, Krông Bông, Krông Búk, Krông Năng, Krông Pắk, Lắk, M\'Đrăk',
            'Đắk Nông' => 'Gia Nghĩa, Tuy Đức , Cư Jút, Đắk Glong, Đắk Mil, Đắk R\'lấp, Đăk Song, Krông Nô',
            'Điện Biên' => 'Yên Bình, Điện Biên, Điện Biên Đông, Điện Biên Phủ, Mường Ảng, Mường Chà, Mường Lay, Mường Nhé, Nậm Pồ, Tủa Chùa, Tuần Giáo',
            'Đồng Nai' => 'Biên Hòa, Cẩm Mỹ, Định Quán, Long Khánh, Long Thành, Nhơn Trạch, Tân Phú, Thống Nhất, Trảng Bom, Vĩnh Cửu, Xuân Lộc',
            'Đồng Tháp' => 'Cao Lãnh, Cao Lãnh, Châu Thành, Hồng Ngự, Hồng Ngự, Lai Vung, Lấp Vò, Sa Đéc, Tam Nông, Tân Hồng, Thanh Bình, Tháp Mười',
            'Gia Lai' => 'An Khê, Ayun Pa, Chư Păh, Chư Prông, Chư Pưh, Chư Sê, Đắk Đoa, Đak Pơ, Đức Cơ, Ia Grai, Ia Pa, KBang, Kông Chro, Krông Pa, Mang Yang, Phú Thiện, Pleiku',
            'Hà Giang' => 'Bắc Mê, Bắc Quang, Đồng Văn, Hà Giang, Hoàng Su Phì, Mèo Vạc, Quản Bạ, Quang Bình, Vị Xuyên, Xín Mần, Yên Minh',
            'Hà Nam' => 'Bình Lục, Duy Tiên, Kim Bảng, Lý Nhân, Phủ Lý, Thanh Liêm',
            'Hà Tĩnh' => 'Can Lộc, Cẩm Xuyên, Đức Thọ, Hà Tĩnh, Hồng Lĩnh, Hương Khê, Hương Sơn, Kỳ Anh, Kỳ Anh, Lộc Hà, Nghi Xuân, Thạch Hà, Vũ Quang',
            'Hải Dương' => 'Bình Giang, Cẩm Giàng, Chí Linh, Gia Lộc, Hải Dương, Kim Thành, Kinh Môn, Nam Sách, Ninh Giang, Thanh Hà, Thanh Miện, Tứ Kỳ',
			'Hậu Giang' => 'Châu Thành, Châu Thành A, Long Mỹ, Long Mỹ, Ngã Bảy, Phụng Hiệp, Vị Thanh, Vị Thủy',
            'Hòa Bình' =>'Cao Phong, Đà Bắc, Hoà Bình, Kim Bôi, Kỳ Sơn, Lạc Sơn, Lạc Thủy, Lương Sơn, Mai Châu, Tân Lạc, Yên Thủy',
            'Hưng Yên' => 'Ân Thi, Hưng Yên, Khoái Châu, Kim Động, Mỹ Hào, Phù Cừ, Tiên Lữ, Văn Giang, Văn Lâm, Yên Mỹ',
            'Khánh Hòa' => 'Cam Lâm, Cam Ranh, Diên Khánh, Khánh Sơn, Khánh Vĩnh, Nha Trang, Ninh Hòa, Trường Sa, Vạn Ninh',
            'Kiên Giang' => 'An Biên, An Minh, Châu Thành, Giang Thành, Giồng Riềng, Gò Quao, Hà Tiên, Hòn Đất, Kiên Hải, Kiên Lương, Phú Quốc, Rạch Giá, Tân Hiệp, U Minh Thượng, Vĩnh Thuận',
            'Kon Tum' => 'Đắk Glei, Đắk Hà, Đăk Tô, Ia H\'Drai, Kon Plông, Kon Rẫy, Kon Tum, Ngọc Hồi, Sa Thầy, Tu Mơ Rông',
            'Lai Châu' => 'Lai Châu, Mường Tè, Nậm Nhùn, Phong Thổ, Sìn Hồ, Tam Đường, Tân Uyên, Than Uyên',
            'Lâm Đồng' => 'Bảo Lâm, Bảo Lộc, Cát Tiên, Di Linh, Đà Lạt, Đạ Huoai, Đạ Tẻh, Đam Rông, Đơn Dương, Đức Trọng, Lạc Dương, Lâm Hà',
            'Lạng Sơn' => 'Bắc Sơn, Bình Gia, Cao Lộc, Chi Lăng, Đình Lập, Hữu Lũng, Lạng Sơn, Lộc Bình, Tràng Định, Vãn Lãng, Văn Quan',
            'Lào Cai' => 'Bảo Thắng, Bảo Yên, Bát Xát, Bắc Hà, Lào Cai, Mường Khương, Sa Pa, Si Ma Cai, Văn Bàn',
            'Long An' => 'Bến Lức, Cần Đước, Cần Giuộc, Châu Thành, Đức Hòa, Đức Huệ, Kiến Tường, Mộc Hóa, Tân An, Tân Hưng, Tân Thạnh, Tân Trụ, Thạnh Hóa, Thủ Thừa, Vĩnh Hưng',
            'Nam Định' => 'Giao Thủy, Hải Hậu, Mỹ Lộc, Nam Định, Nam Trực, Nghĩa Hưng, Trực Ninh, Vụ Bản, Xuân Trường, Ý Yên',
            'Nghệ An' => 'Anh Sơn, Con Cuông, Cửa Lò, Diễn Châu, Đô Lương, Hoàng Mai, Hưng Nguyên, Kỳ Sơn, Nam Đàn, Nghi Lộc, Nghĩa Đàn, Quế Phong, Quỳ Châu, Quỳ Hợp, Quỳnh Lưu, Tân Kỳ, Thái Hòa, Thanh Chương, Tương Dương, Vinh, Yên Thành',
            'Ninh Bình' => 'Gia Viễn, Hoa Lư, Kim Sơn, Nho Quan, Ninh Bình, Tam Điệp, Yên Khánh, Yên Mô',
            'Ninh Thuận' => 'Bác Ái, Ninh Hải, Ninh Phước, Ninh Sơn, Phan Rang-Tháp Chàm, Thuận Bắc, Thuận Nam',
            'Phú Thọ' => 'Cẩm Khê, Đoan Hùng, Hạ Hòa, Lâm Thao, Phú Thọ, Phù Ninh, Tam Nông, Tân Sơn, Thanh Ba, Thanh Sơn, Thanh Thủy, Việt Trì, Yên Lập',
            'Phú Yên' => 'Đông Hòa, Đồng Xuân, Phú Hòa, Sông Cầu, Sông Hinh, Sơn Hòa, Tây Hòa, Tuy An, Tuy Hòa' ,
            'Quảng Bình' => 'Ba Đồn, Bố Trạch, Đồng Hới, Lệ Thủy, Minh Hóa, Quảng Ninh, Quảng Trạch, Tuyên Hóa',
            'Quảng Nam' => 'Bắc Trà My, Duy Xuyên, Đại Lộc, Điện Bàn, Đông Giang, Hiệp Đức, Hội An, Nam Giang, Nam Trà My, Nông Sơn, Núi Thành, Phú Ninh, Phước Sơn, Quế Sơn, Tam Kỳ, Tây Giang, Thăng Bình, Tiên Phước',
            'Quảng Ngãi' => 'Ba Tơ, Bình Sơn, Đức Phổ, Lý Sơn, Minh Long, Mộ Đức, Nghĩa Hành, Quảng Ngãi, Sơn Hà, Sơn Tây, Sơn Tịnh, Tây Trà, Trà Bồng, Tư Nghĩa',
            'Quảng Ninh' => 'Ba Chẽ, Bình Liêu, Cẩm Phả, Cô Tô, Đầm Hà, Đông Triều, Hạ Long, Hải Hà, Hoành Bồ, Móng Cái, Quảng Yên, Tiên Yên, Uông Bí, Vân Đồn',
            'Quảng Trị' => 'Cam Lộ, Cồn Cỏ, Đa Krông, Đông Hà, Gio Linh, Hải Lăng, Hướng Hóa, Quảng Trị, Triệu Phong, Vĩnh Linh',
            'Sóc Trăng' => 'Châu Thành, Cù Lao Dung, Kế Sách, Long Phú, Mỹ Tú, Mỹ Xuyên, Ngã Năm, Sóc Trăng, Thạnh Trị, Trần Đề, Vĩnh Châu',
            'Sơn La' => 'Bắc Yên, Mai Sơn, Mộc Châu, Mường La, Phù Yên, Quỳnh Nhai, Sông Mã, Sốp Cộp, Sơn La, Thuận Châu, Vân Hồ, Yên Châu',
            'Tây Ninh' => 'Bến Cầu, Châu Thành, Dương Minh Châu, Gò Dầu, Hòa Thành, Tân Biên, Tân Châu, Tây Ninh, Trảng Bàng',
            'Thái Bình' => 'Đông Hưng, Hưng Hà, Kiến Xương, Quỳnh Phụ, Thái Bình, Thái Thụy, Tiền Hải, Vũ Thư',
            'Thái Nguyên' => 'Đại Từ, Định Hóa, Đồng Hỷ, Phổ Yên, Phú Bình, Phú Lương, Sông Công, Thái Nguyên, Võ Nhai',
            'Thanh Hóa' => 'Bá Thước, Bỉm Sơn, Cẩm Thủy, Đông Sơn, Hà Trung, Hậu Lộc, Hoằng Hóa, Lang Chánh, Mường Lát, Nga Sơn, Ngọc Lặc, Như Thanh, Như Xuân, Nông Cống, Quan Hóa, Quan Sơn, Quảng Xương, Sầm Sơn, Thạch Thành, Thanh Hóa, Thiệu Hóa, Thọ Xuân, Thường Xuân, Tĩnh Gia, Triệu Sơn, Vĩnh Lộc, Yên Định',
            'Thừa Thiên Huế' => 'Huế, Hương Thủy, Hương Trà, Nam Đông, A Lưới, Phong Điền, Phú Lộc, Phú Vang, Quảng Điền',
            'Tiền Giang' => 'Cai Lậy, Cái Bè, Châu Thành, Chợ Gạo, Gò Công, Gò Công Đông, Gò Công Tây, Mỹ Tho, Tân Phú Đông, Tân Phước',
            'Trà Vinh' => 'Càng Long, Cầu Kè, Cầu Ngang, Châu Thành, Duyên Hải, Duyên Hải, Tiểu Cần, Trà Cú, Trà Vinh',
            'Tuyên Quang' => 'Chiêm Hóa ,Hàm Yên, Lâm Bình, Na Hang, Sơn Dương, Tuyên Quang, Yên Sơn',
            'Vĩnh Long' => 'Bình Minh, Bình Tân, Long Hồ, Mang Thít, Tam Bình, Trà Ôn, Vĩnh Long, Vũng Liêm',
            'Vĩnh Phúc' => 'Bình Xuyên, Lập Thạch, Phúc Yên, Sông Lô, Tam Dương, Tam Đảo, Vĩnh Tường, Vĩnh Yên, Yên Lạc',
            'Yên Bái' => 'Lục Yên, Mù Căng Chải, Nghĩa Lộ, Trạm Tấu, Trấn Yên, Văn Chấn, Văn Yên, Yên Bái',
            );
        ?>
        <select class="tinh_thanh-select" name="<?php echo $temp_post_type['name'] ?>">
            <option par="0" <?php if($default_value[$temp_post_type['name']] == 0) echo 'selected ' ?> value="0">-- Tỉnh Thành --</option>
            <?php
                //$lists = models_DB::get('SELECT * FROM ' . CATEGORY_TABLE . ' WHERE parent = 24 ORDER BY title ASC ');
                $n_lists = array('Hà Nội', 'Hồ Chí Minh', 'Đà Nẵng', 'Hải Phòng');
                foreach($lists as $list)
                {
                    //if(!in_array($list, $n_lists)) $n_lists[] = $list['title'];
                }
                 
                foreach( $lists as $k => $list)
                {
                    ?>
                    <option par="<?php echo pretty_string($k) ?>" class="<?php echo $temp_post_type['name'] ?>-<?php echo pretty_string($k) ?>" <?php if($default_value[$temp_post_type['name']] == $k) echo 'selected ' ?> value="<?php echo $k ?>"><?php echo $k ?></option>
                    <?php
                }
            ?>
            
             
        </select>
        
        <?php 
            
        ?>
    
    </div>
    <span class="clear"></span>
    
    <?php
    if(!empty($temp_post_type['description']))
    {
        ?>
        <div class="form-description">
            <span class="arrow"></span>

            <?php echo $temp_post_type['description'] ?>
        </div>
        <?php
    }
    ?>
     
</div>
<span class="clear"></span>
 
 