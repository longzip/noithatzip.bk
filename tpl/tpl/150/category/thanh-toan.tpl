{include file='../header.tpl'}

<style>
    #slide, #video-replace-slide{
        display:none;
    }
</style>

<div id="bread-crumb" class="v-full-width">
 
</div>

<div class="v-full-width middle">
    <section class="v-wrap-full" id="middle-content" style="margin-top: 0;">
        <div class="inner">
             
            
            <div class="fr  v-col-lg-12 v-col-md-12 v-col-sm-12 v-col-xs-12 v-col-tx-12 border-box" id="col2">
               <div class="col2-content" style="">
                        
                <div >
                    {$g_functions->display_bread_crumb()}
                </div>
                
                <h1 id="" class="page-h1">
					{$category_info.title}             
				</h1>
				
				{if !empty($category_info.description) }
				    <div class="cat-des">
				        {$category_info.description}
				    </div>
				{/if} 
				
		        
                 
                <div class="content" style="margin-bottom: 20px;front-family:arial !important;">
                    <div class="row">
                       
                            
                            {$g_functions->thanhtoan()}
                         
                
                            <div class="infocheckout">
                                <div class="box-form" style="width:100%;float:left">
                                    <div class="checkoutleft">
                                        <div class="title-form" style="margin-bottom:20px">
                                            <i class="fa fa-info-circle" aria-hidden="true" style="margin-right: 5px;color:#35c853;font-size: 18px"></i>
                                            <a style="font-size:14px;font-weight: bold;color:#35c853">Thông tin khách hàng</a>
                                        </div>
                
                                        <div class="pad-contact">
                                            <div class="inputphai">
                                                <input type="text" class="form-control" name="hoten" id="hoten" placeholder="Họ và tên" required>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="pad-contact" style="margin-right: 0px">
                                            <div class="inputphai">
                                                <div style="padding-left: 0px;width: 96%">
                                                    <input type="number"  class="form-control" name="dienthoai" id="dienthoai" placeholder="Điện thoại" required>
                                                </div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div style="clear: both;"></div>
                                        
                                        <div class="pad-contact" style="width: 100%;">
                                            <div class="inputphai">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" style="padding-left: 2%;">
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div style="clear: both;"></div>
                                        
                                        <div class="pad-contact" style="margin-right: 0px;width: 100%;float:left">
                                                <div class="inputphai">
                                                    <input type="text" class="form-control" name="diachi" id="diachi" placeholder="Địa chỉ" style="padding-left: 2%;" required>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div style="clear: both;"></div>
                
                                       
                                            <div class="thongtinform" style="margin-top:5px; margin-bottom: 5px;width: 96%;float: left;border: 1px solid #d6d6d6;padding: 2%;">
                                            <p style="color:#7d7d7d;width: 100%;float:left;margin-bottom:10px">Hình thức thanh toán(*)</p>
                                            <div style="clear: both;"></div>
                                            <div class="khung_check">
                                                <div class="left_radio" style="width: 29%;float:left">
                                                    <input type="radio" name="phuongthuc" value="2" checked=""> Giao hàng (COD)
                                                </div>
                                                <div class="left_radio" style="width: 51%;float:left">
                                                    <input type="radio" name="phuongthuc" value="1"> Chuyển khoản ATM / ngân hàng
                                                </div>
                                                <div class="left_radio" style="width: 20%;float:left">
                                                    <input type="radio" name="phuongthuc" value="3"> Khác
                                                </div>
                                            </div>
                                            <div style="clear: both;"></div>
                                        </div>
                
                                        <div class="thongtinform"  style="margin-top:5px; margin-bottom: 5px;width: 96%;float: left;border: 1px solid #d6d6d6;padding: 2%;">
                                            <div class="noidung_giohang">
                                                <p></p>
                                                <p style="text-align: justify;">
                                                    <span style="color:#000000;">
                                                        <img alt="" src="https://noithatzip.com/uploads/logo/icon_detail.png">&nbsp;Quý khách có thể thanh toán bằng hình thức chuyển khoản hoặc giao hàng thu tiền tại nhà!<br>
                                                        <img alt="" src="https://noithatzip.com/uploads/logo/icon_detail.png">&nbsp;Vui lòng kiểm tra kỹ các thông tin một lần nữa, sau đó nhấn nút&nbsp;"
                                                    </span>
                                                    <span style="color:#ff0000;">ĐẶT HÀNG</span>
                                                    <span style="color:#000000;">"&nbsp;để gửi đơn đặt hàng của quý khách.<br>
                                                        <img alt="" src="https://noithatzip.com/uploads/logo/icon_detail.png">
                                                    </span>
                                                    <span style="color:#ff0000;"><i>
                                                        <strong>Chú ý I:</strong></i>
                                                    </span>
                                                    <span style="color:#000000;">
                                                        <i>&nbsp;Nhân viên sẽ liên hệ để xác minh đơn hàng một lần nữa, vì vậy Quý khách vui lòng chú ý điện thoại. Chi phí giao hàng sẽ được nhân viên thông báo khi liên hệ.</i>
                                                        
                                                    </span>
                                                </p>
                                                <p></p>
                                            </div>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="pad-contact" style="float:right;margin-right: 0px">
                                        <div class="inputphai" style="width:100%;float:left;margin-top:20px">
                                            <button name="continue" type="submit" id="datthanhtoan" class="continue " style="width: 100%;float:right;text-align: center;background: red;height: 40px;border:none;color:white;cursor: pointer;">ĐẶT HÀNG</button>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>
                            
                        
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>    
                </div>
                 
                
                            
                
                <span class="clear"></span>
                </div>
            </div>
			
			<!--<div id="sidebar" class="fl v-col-lg-3 v-col-md-4 v-col-sm-6 v-col-xs-12 v-col-tx-12">-->
   <!--             {include file='../sidebar.tpl'}-->
   <!--         </div>-->
            <span class="clear"></span>
        </div>
    </section>
</div>

 
 
<span class="clear"></span>
{include file='../footer.tpl'}