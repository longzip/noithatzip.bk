 <div class="v-form-fixed v-form-fixed-bottom-left v-xs-none v-tx-none v-form-fixed-<?php echo $attr['form_id'] ?>">
    <?php display_form(array('id'=>$attr['form_id'])) ?>
    <div class="before">+</div>
</div>
    <script>
        $("document").ready(function(){
            $(".v-form-fixed .before").click(function(){
                $(".v-form-fixed").removeClass("active");
            });
            
             $(".show-v-form-fixed").click(function(){
                $(".v-form-fixed").addClass("active");
            });
            
            setTimeout(function(){
                $(".v-form-fixed").addClass("active");
            },<?php echo 1000 * ($attr['time_delay_minute'] * 60 + $attr['time_delay_second']) ?>);
        });
    </script>
    
    <style>
        .v-form-fixed-bottom-left {
            position: fixed;
            left: -530px;
            bottom: 50px;
            max-width: 530px;
            transition: all 0.8s;
            -webkit-transition: all 0.8s;
        }
        
        .v-form-fixed-bottom-left.active {
            left: 10px; 
        }
        
        .v-form-fixed-bottom-left .v-form-item {
            display: inline-block;
            margin: 0 10px;
        }
        
        .v-form-fixed-bottom-left .before {
            content: "+";
            position: absolute;
            width: 100px;
            height: 100px;
            text-align: center;
            line-height: 100px;
            top: -30px;
            right: -19px;
            font-size: 40px;
            -ms-transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            font-weight: normal;
            cursor: pointer;
        }
        
        .v-form-fixed-bottom-left .before:hover {
        } 
    </style>