<?php
/* Smarty version 3.1.30, created on 2020-07-13 14:45:41
  from "/home/noith792/public_html/tpl/tpl/150/category/thanh-toan.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f0c11253caf25_41207299',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5f0718373e65601a022f1fd14f38f488fad451c5' => 
    array (
      0 => '/home/noith792/public_html/tpl/tpl/150/category/thanh-toan.tpl',
      1 => 1594624896,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../header.tpl' => 1,
    'file:../sidebar.tpl' => 1,
    'file:../footer.tpl' => 1,
  ),
),false)) {
function content_5f0c11253caf25_41207299 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '6665440165f0c1125305150_45103716';
$_smarty_tpl->_subTemplateRender("file:../header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


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
                    <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->display_bread_crumb();?>

                </div>
                
                <h1 id="" class="page-h1">
					<?php echo $_smarty_tpl->tpl_vars['category_info']->value['title'];?>
             
				</h1>
				
				<?php if (!empty($_smarty_tpl->tpl_vars['category_info']->value['description'])) {?>
				    <div class="cat-des">
				        <?php echo $_smarty_tpl->tpl_vars['category_info']->value['description'];?>

				    </div>
				<?php }?> 
				
		        
                 
                <div class="content" style="margin-bottom: 20px;front-family:arial !important;">
                    <div class="row">
                       
                            
                            <?php echo $_smarty_tpl->tpl_vars['g_functions']->value->thanhtoan();?>

                         
                
                            <div class="infocheckout">
                                <div class="box-form" style="width:100%;float:left">
                                    <div class="checkoutleft">
                                        <div class="title-form" style="margin-bottom:20px">
                                            <i class="fa fa-info-circle" aria-hidden="true" style="margin-right: 5px;color:#35c853;font-size: 18px"></i>
                                            <a style="font-size:14px;font-weight: bold;color:#35c853">Th??ng tin kh??ch h??ng</a>
                                        </div>
                
                                        <div class="pad-contact">
                                            <div class="inputphai">
                                                <input type="text" class="form-control" name="hoten" id="hoten" placeholder="H??? v?? t??n" required>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="pad-contact" style="margin-right: 0px">
                                            <div class="inputphai">
                                                <div style="padding-left: 0px;width: 96%">
                                                    <input type="number"  class="form-control" name="dienthoai" id="dienthoai" placeholder="??i???n tho???i" required>
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
                                                    <input type="text" class="form-control" name="diachi" id="diachi" placeholder="?????a ch???" style="padding-left: 2%;" required>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div style="clear: both;"></div>
                
                                       
                                            <div class="thongtinform" style="margin-top:5px; margin-bottom: 5px;width: 96%;float: left;border: 1px solid #d6d6d6;padding: 2%;">
                                            <p style="color:#7d7d7d;width: 100%;float:left;margin-bottom:10px">H??nh th???c thanh to??n(*)</p>
                                            <div style="clear: both;"></div>
                                            <div class="khung_check">
                                                <div class="left_radio" style="width: 29%;float:left">
                                                    <input type="radio" name="phuongthuc" value="2" checked=""> Giao h??ng (COD)
                                                </div>
                                                <div class="left_radio" style="width: 51%;float:left">
                                                    <input type="radio" name="phuongthuc" value="1"> Chuy???n kho???n ATM / ng??n h??ng
                                                </div>
                                                <div class="left_radio" style="width: 20%;float:left">
                                                    <input type="radio" name="phuongthuc" value="3"> Kh??c
                                                </div>
                                            </div>
                                            <div style="clear: both;"></div>
                                        </div>
                
                                        <div class="thongtinform"  style="margin-top:5px; margin-bottom: 5px;width: 96%;float: left;border: 1px solid #d6d6d6;padding: 2%;">
                                            <div class="noidung_giohang">
                                                <p></p>
                                                <p style="text-align: justify;">
                                                    <span style="color:#000000;">
                                                        <img alt="" src="https://noithatzip.com/uploads/logo/icon_detail.png">&nbsp;Qu?? kh??ch c?? th??? thanh to??n b???ng h??nh th???c chuy???n kho???n ho???c giao h??ng thu ti???n t???i nh??!<br>
                                                        <img alt="" src="https://noithatzip.com/uploads/logo/icon_detail.png">&nbsp;Vui l??ng ki???m tra k??? c??c th??ng tin m???t l???n n???a, sau ???? nh???n n??t&nbsp;"
                                                    </span>
                                                    <span style="color:#ff0000;">?????T H??NG</span>
                                                    <span style="color:#000000;">"&nbsp;????? g???i ????n ?????t h??ng c???a qu?? kh??ch.<br>
                                                        <img alt="" src="https://noithatzip.com/uploads/logo/icon_detail.png">
                                                    </span>
                                                    <span style="color:#ff0000;"><i>
                                                        <strong>Ch?? ?? I:</strong></i>
                                                    </span>
                                                    <span style="color:#000000;">
                                                        <i>&nbsp;Nh??n vi??n s??? li??n h??? ????? x??c minh ????n h??ng m???t l???n n???a, v?? v???y Qu?? kh??ch vui l??ng ch?? ?? ??i???n tho???i. Chi ph?? giao h??ng s??? ???????c nh??n vi??n th??ng b??o khi li??n h???.</i>
                                                        
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
                                            <button name="continue" type="submit" id="datthanhtoan" class="continue " style="width: 100%;float:right;text-align: center;background: red;height: 40px;border:none;color:white;cursor: pointer;">?????T H??NG</button>
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
   <!--             <?php $_smarty_tpl->_subTemplateRender("file:../sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
-->
   <!--         </div>-->
            <span class="clear"></span>
        </div>
    </section>
</div>

 
 
<span class="clear"></span>
<?php $_smarty_tpl->_subTemplateRender("file:../footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
