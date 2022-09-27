<div class="v-tabs">
   <div class="v-tabs-nav">
      <div class="v-tabs-nav-inner">
         {foreach from = $temporary_setting_parameter item = $temp}
             <div class="v-tabs-nav-item" class="v-tabs-nav-item">
                {$temp.html_title}                             
             </div>
         {/foreach}
      </div>
   </div>
   <div class="v-tabs-content">
       {foreach from = $temporary_setting_parameter item = $temp}
             <div class="v-tabs-content-item" >
                 {$temp.html_value}    
              </div>
         {/foreach}
   </div>
</div>