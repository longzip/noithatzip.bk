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
             
            
            <div class="fr" id="col2">
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
                
                 
                <div class="col2-content" style="">
                        {include file='../box1.tpl'}
                </div>
                 
                <span class="clear"></span>
                
                {$g_functions->display_pagination()}
                
                
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