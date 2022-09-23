<div class="v-popup-form have-border-top">
        <div class="opacity" style="position: fixed; background: #000; opacity: 0.7; width: 100%; height: 100%; left: 0; top: 0; z-index: 99;"></div>
        <?php display_form(array('id'=>$attr['form_id'])) ?>
        <div class="v-close-popup-form">×</div>
    </div>
    <?php 
    if(!isset($_COOKIE['popup_form'])) //
    {
        ?>
        <script>
            $("document").ready(function(){
                setTimeout(function(){
                    $(".v-popup-form").css("display","block");
                        setTimeout(function(){
                            $(".v-popup-form").css("opacity","1");
                        }, 1000);
                    }, <?php echo 1000 * ($attr['time_delay_minute'] * 60 + $attr['time_delay_second']) ?>);
                    
                    $(".v-close-popup-form").click(function(){
                          $(".v-popup-form").css("display", "none");
                    });
                
                 //$(".v-popup-form .v-form-title").prependTo(".v-popup-form .wrap-v-form");
                //$(".v-popup-form .v-close-popup-form").prependTo(".v-popup-form .wrap-v-form");
            });
        </script>
        <?php
    }
    ?>
    
    <style>
        
        .v-popup-form{
            display:none;
            opacity:0;
            transition:all 1s;
            -webkit-transition:all 1s;
        }
        .v-popup-form .wrap-v-form {
            background: rgb(85, 134, 186);
            position: fixed;
            width: 50%;
            left: 25%;
            top: 10%;
            z-index: 100;
            /* height: 50%; */
            box-sizing: border-box;
        }
        
        .v-popup-form .v-form-content {
            padding: 20px;
            box-sizing: border-box;
            overflow: auto;
            background: rgb(85, 134, 186);
        }
        
        .v-popup-form form.v-form {
            padding: 20px 55px;
            border: 3px dashed rgb(224, 224, 224);
            margin: 0px;
            background: rgb(85, 134, 186);
            color:#fff;
        }
        
        .v-popup-form input.v-form-field-type-text {
            box-sizing: border-box;
            display: block;
            width: 100%;
        }
        
        .v-popup-form .v-form-item-content {
            width: 400px;
            margin: auto;
                max-width: 100%;
        }
        
        
        @media only screen and (max-width: 700px){
            .v-popup-form .wrap-v-form {
                width: 94%;
                left: 3%;
                top: 10%;
            }
            
            .v-popup-form form.v-form {
                padding: 10px;
            }
            
            .v-popup-form input.v-form-field-type-text {}
            
            .v-popup-form .v-form-item-content {
                width: 100%;
            }
        }
        
        .v-popup-form .v-form-title {
            background: none;
            font-size: 22px;
            margin-bottom: 20px;
            font-family: Roboto, arial;
            color:#fff;
            padding: 20px;
            padding-bottom: 0;
            text-align: center;
        }
        .v-close-popup-form {
            position: absolute;
            top: -15px;
            right: -15px;
            display: block;
            font-family: "Verdana", Arial, sans-serif;
            font-size: 26px;
            font-weight: bold;
            color: #333333;
            color: rgba(0,0,0,0.3);
            text-decoration: none !important;
            background-color: #000;
            color: rgba(255,255,255,0.8);
            border-radius: 999em;
            height: 30px;
            width: 30px;
            text-align: center;
            line-height: 26px;
            cursor:pointer;
        }
        </style>