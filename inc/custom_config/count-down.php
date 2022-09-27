<div class="v-form-fixed-3   v-form-fixed     ">        
    <div class="wrap-v-form">
        <div class="order-time"> 
            <?php
                $last = get_option("last-km");
                display_edit_option_icon("last-km", 'text');
                $s = strtotime($last) - hcv_time();
                $s_  = $s % 60;
                if( strlen($s_) < 2 ) $s_ = '0' . $s_;
                
                $m_ = floor($s / 60) % 60 ;
                if( strlen($m_) < 2 ) $m_ = '0' . $m_;
                
                $d_  = floor ($s / 86400 );  
                if( strlen($d_) < 2 ) $d_ = '0' . $d_;
                
                $h_ = floor(( $s - $d_ * 86400 ) / 3600);
                if( strlen($h_) < 2 ) $h_ = '0' . $h_;
                $time_part = explode('/', $last);
          ?> 
          
          <div class="clock-detail">
                <div class="clock-detail-1 v-lg-float-left v-md-float-left v-sm-float-left v-col-lg-6 v-col-md-6 v-col-sm-6 border-box">
                    <p id="tgcl">Tri ân khách hàng</p>
                    <div class="wrap-order-price"> Giảm <span>10%</span> giá website </div>
                    
                    <div class="thoi-han">Chỉ áp dụng đến <?php echo $time_part[1] ?>/<?php echo $time_part[0] ?>/<?php echo $time_part[2] ?><?php //echo $last ?></div>
                    <div class="bt-thoi-han v-lg-none v-md-none v-sm-none">&nbsp;</div>
                </div>
                
                <div class="clock-detail-2 v-lg-float-left v-md-float-left v-sm-float-left v-col-lg-6 v-col-md-6 v-col-sm-6 border-box">
                    <div class="thoi-gian-con">Thời gian còn lại</div>
                
                    <div class="v-clock-item v-clock-day">
                        <span class="v-clock-day-value v-clock-value"><?php echo $d_ ?></span>
                        <span class="v-clock-day-title v-clock-title">ngày</span>
                    </div>
                    <div class="v-clock-item v-clock-hour">
                        <span class="v-clock-hour-value v-clock-value"><?php echo $h_ ?></span>
                        <span class="v-clock-hour-title v-clock-title">giờ</span>
                    </div>
                    <div class="v-clock-item v-clock-minute">
                        <span class="v-clock-minute-value v-clock-value"><?php echo $m_ ?></span>
                        <span class="v-clock-minute-title v-clock-title">phút</span>
                    </div>
                    <div class="v-clock-item v-clock-second">
                        <span class="v-clock-second-value v-clock-value"><?php echo $s_ ?></span>
                        <span class="v-clock-second-title v-clock-title">giây</span>
                    </div>
                </div>
                
                <span class="clear"></span>
                
                <a class="v-form-register" href="#">
                Đăng ký ngay
                </a>
                
          </div>

        </div>
    </div>
    <div class="before v-close-form-fixed">+</div>
</div>
<div class="v-open-form-fixed-3">
    <i class="fa fa-envelope" aria-hidden="true"></i>
</div>
<script>
    $("document").ready(function(){
        function set_fixed_form_max_width()
        {
            var fixed_form_w = $(".v-form-fixed-3").outerWidth();
            if(screen.width <= fixed_form_w )
            {
                $(".v-form-fixed-3").addClass("over-screen");
            }
        }
        
        set_fixed_form_max_width();
        
        $(".v-close-form-fixed").click(function(){
            $(".v-form-fixed-3").removeClass("active");
            $(".v-open-form-fixed-3").addClass("active");
        });
        setTimeout(function(){
             $(".v-form-fixed-3").addClass("active");
             set_fixed_form_max_width();
        },15000)
        $(".v-open-form-fixed-3").click(function(){
            $(".v-form-fixed-3").addClass("active");
            $(".v-open-form-fixed-3").removeClass("active");
            set_fixed_form_max_width();
        });
        
        var fixed_form_3_item = $(".v-form-fixed-3 .v-form-item").size();
         
         
        switch(fixed_form_3_item)
        {
            case 2 :
            {
                $(".v-form-fixed-3 .v-form-item").addClass("v-col-6 fl border-box");
                break;
            }
            case 3 :
            {
                $(".v-form-fixed-3 .v-form-item").addClass("v-col-4 fl border-box");
                break;
            }
            case 4 :
            {
                $(".v-form-fixed-3 .v-form-item").addClass("v-col-6 fl border-box");
                break;
            }
        }
        
        
    });
</script><style>
.v-form-fixed-3 {
    position: fixed;
    background: rgba(1, 94, 167, 0.94);
    text-align: left;
    color: #fff;
    z-index: 9;
    transition:left 1.2s, right 1.2s;
    -webkit-transition:left 1.2s, right 1.2s;
    max-width:100%;
    padding: 10px 20px;
    box-sizing:border-box;
    border-radius: 3px;
}

.v-form-fixed-3.over-screen.active{
    left:0;
    width:100%;
}

.v-form-fixed-3 .v-form-item {
    padding-right: 15px;
}



.v-form-fixed-3 input.form-text {
    background: white;
    box-sizing:border-box;
    width:100%;
    border:0;
    padding: 10px 15px;
    border-radius:3px;
}

.v-form-fixed-3 .v-form-item{
    margin: 15px 0;
}

.v-form-fixed-3 .before {
    content: "+"; 
    position: absolute;
    width: 100px;
    height: 100px;
    text-align: center;
    line-height: 100px;
    top: -30px;
    right: -20px;
    font-size: 40px;
    -ms-transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    font-weight: normal;
    cursor: pointer;
}

.v-form-fixed-3 .v-form-title {
    margin: 15px 0;
    background: none;
    padding: 0;
    text-transform: uppercase;
    text-align: left;
}

.v-form-fixed-3 .v-form-item-title {
    display: none;
}

.v-form-fixed-3 input.form-submit {
    width: 100%;
    border: 1px solid #fff;
    padding: 9px 12px;
    background: #f78e05;
    font-weight: bold;
    color: #fff;
    cursor: pointer;
}

.v-form-fixed-3 input.form-submit:hover {
    background: #ab6407;
}

.v-form-fixed-3 .v-form-content {
    padding: 0;
}


.v-open-form-fixed-3 {
    position: fixed;
    transition: all 1.1s;
    -webkit-transition:all 1.1s;
    z-index: 9;
    background: rgba(96, 168, 204, 0.9);
    height: 40px;
    line-height: 40px;
    width: 40px;
    text-align: center;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
}

.v-open-form-fixed-3:hover {
    background: #015ea7;
}

 
.v-form-fixed-3 {
    left:-700px;
    bottom:72px;
     border-radius:0px 3px 3px 0px;
    
}
.v-form-fixed-3.active {
    left:10px;
}
.v-open-form-fixed-3{
    left:-700px;
    bottom:155px;
}
.v-open-form-fixed-3.active{
    left:0;
}
.order-time span.core-edit-option-icon {
    z-index: 999;
}
</style>
