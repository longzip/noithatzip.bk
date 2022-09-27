<div id="list-billing" class="clearfix  ">
    <h2 class="list-billing-title">Quý khách chọn một trong các hình thức sau :</h2>
    <div class="box other-billing  border-box">
        <div class=" ">
            <div class="v-tabs">
                <div class="v-tabs-nav">
                    <div class="v-tabs-nav-item">Chuyển khoản ngân hàng</div>
                    <div class="v-tabs-nav-item">Thẻ cào điện thoại</div>
                    <div class="v-tabs-nav-item">Soạn tin nhắn</div>
                </div>
                <div class="v-tabs-content">
                    <div class="v-tabs-content-item">
                        <div class="qtll-right-title">Chuyển khoản ngân hàng với nội dung : "Nap tien tài khoản id <?php echo USER_ID ?> "</div>
                        <div class="nh-content">
                            <?php 
                                $admin_ecommerce_bank_info = get_config('admin_ecommerce_bank_info');
                                echo  $admin_ecommerce_bank_info;
                            ?>
                        </div>
                    </div>
                    <div class="v-tabs-content-item">
                        <form action="" method="POST" id="the-cao" class=" ">
                            <input type="hidden" value="nap_the_cao_dt" name="type" />
                            <h2 class="nt-title">Nạp qua thẻ cào điện thoại</h2>
            				 <div id="chonloaithe">
            					<span id="chonloaithe-title">Chọn loại thẻ</span>
            					<div class="listhe">
            						<label class="label viettel" for="loaithe-viettel"> </label> <br>
            						
            						<input checked="" id="loaithe-viettel" value="VIETTEL" type="radio" name="card_type" />
            						 
            						
            						 
            						
            						<span class="clear"></span>
            					</div>
            					
            					<div class="listhe">
            						<label class="label vinaphone" for="loaithe-vinaphone"> </label> <br>
            						
            						<input id="loaithe-vinaphone" value="VNP" type="radio" name="card_type">
            						 
            						
            						 
            						
            						<span class="clear"></span>
            					</div>
            					
            					<div class="listhe">
            						<label class="label mobifone" for="loaithe-mobifone"> </label> <br>
            						
            						<input id="loaithe-mobifone" value="VMS" type="radio" name="card_type">
            						 
            						
            						 
            						
            						<span class="clear"></span>
            					</div>
            					
            				</div>
            				
            				<div class="card-info" id="card-seri">
            					<span class="card-info-label">Mã số thẻ :</span> <input type="number" name="card_number" value="">
            				</div>
            				
            				<div class="card-info" id="card-number">
            					<span class="card-info-label">Seri thẻ :</span> <input type="number" name="card_seri" value="">
            				</div>
                            
                            <div class="nap-the-noti"></div>
            				
            				<div id="card-submit">
            					<input type="submit" name="submit" value="Nạp tiền">
            				</div>
            			</form>
                    </div>
                    
                    <div class="v-tabs-content-item">
                        <div class="sms-billing">
                            <?php 
                                $admin_ecommerce_billing_sms = get_config('admin_ecommerce_billing_sms');
                                echo str_replace('@id', USER_ID, $admin_ecommerce_billing_sms);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
                    
                    
               </div>
    </div>
     
</div>