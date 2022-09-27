<style>
.v-form-fixed-1 {
    position: fixed;
    background: rgba(8, 21, 80, 0.39);
    padding: 20px 20px;
    text-align: left;
    color: #fff;
    font-weight: bold;
    z-index: 9;
    width: 265px;
    transition:left 1.2s, right 1.2s;
    -webkit-transition:left 1.2s, right 1.2s;
}

.v-form-fixed-1 input.form-text {
    background: white;
    box-sizing:border-box;
    width:100%;
    border:0;
    padding: 10px 15px;
}

.v-form-fixed-1 .v-form-item{
    margin: 15px 0;
}

.v-form-fixed-1 .before {
    content: "+"; 
    position: absolute;
    width: 100px;
    height: 100px;
    text-align: center;
    line-height: 100px;
    top: -30px;
    left: -20px;
    font-size: 40px;
    -ms-transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    font-weight: normal;
    cursor: pointer;
}

.v-form-fixed-1 .v-form-title {
    margin: 15px 0;
    background: none;
    padding: 0;
    text-transform: initial;
    text-align: left;
}

.v-form-fixed-1 .v-form-item-title {
    display: none;
}

.v-form-fixed-1 input.form-submit {
    width: 100%;
    border: 1px solid #fff;
    padding: 8px 12px;
    background: #4268b1;
    font-weight: bold;
    color: #fff;
    cursor: pointer;
}

.v-form-fixed-1 input.form-submit:hover {
    background: #123884;
}

.v-form-fixed-1 .v-form-content {
    padding: 0;
}


.v-open-form-fixed-1 {
    position: fixed;
    transition: all 1.1s;
    -webkit-transition:all 1.1s;
    z-index: 9;
    background: rgba(96, 168, 204, 0.9);
    height: 50px;
    line-height: 50px;
    width: 50px;
    text-align: center;
    color: #fff;
    font-size: 28px;
    cursor: pointer;
}

.v-open-form-fixed-1:hover {
    background: #015ea7;
}


<?php 
    switch($default_value['form_position'])
    {
        case 'bottom_left' :
        {
            
            ?>
            .v-form-fixed-1 {
                left:-500px;
                bottom:<?php echo $default_value['bottom'] ?>px;
                 border-radius:0px 3px 3px 0px;
                
            }
            .v-form-fixed-1.active {
                left:<?php echo $default_value['left'] ?>px;
            }
            .v-open-form-fixed-1{
                left:-500px;
                bottom:<?php echo $default_value['bottom'] + 100 ?>px;
            }
            .v-open-form-fixed-1.active{
                left:0;
            }
            <?php
            break;
        }
        
        case 'top_right' :
        {
            ?>
            .v-form-fixed-1 {
                right: -500px;
                top: <?php echo $default_value['top'] ?>px;
            }
            .v-form-fixed-1.active {
                right:<?php echo $default_value['right'] ?>px;
            }
            
            .v-open-form-fixed-1{
                right: -500px;
                top: <?php echo $default_value['top'] ?>px;
                border-radius:3px 0px 0px 3px;
            }
            .v-open-form-fixed-1.active{
                right:0;
            }
            .v-open-form-fixed-1 i{
                -ms-transform: rotate(180deg); /* IE 9 */
                -webkit-transform: rotate(180deg); /* Chrome, Safari, Opera */
                transform: rotate(180deg);
            } 
            <?php
            break;
        }
        
        case 'bottom_right' :
        { 
            ?>
            .v-form-fixed-1 {
                right: -500px;
                bottom:<?php echo $default_value['bottom'] ?>px;
            }
            .v-form-fixed-1.active {
                right:<?php echo $default_value['right'] ?>px;
            }
            
            .v-open-form-fixed-1{
                right: -500px;
                bottom:<?php echo $default_value['bottom'] + 100 ?>px;
                border-radius:3px 0px 0px 3px;
            }
            .v-open-form-fixed-1.active{
                right:0;
            }
            .v-open-form-fixed-1 i{
                -ms-transform: rotate(180deg); /* IE 9 */
                -webkit-transform: rotate(180deg); /* Chrome, Safari, Opera */
                transform: rotate(180deg);
            }
            <?php
            break;
        }
        
        case 'top_left' :
        {
            ?>
            .v-form-fixed-1 {
                top: <?php echo $default_value['top'] ?>px;;
                left:-500px;
            }
            .v-form-fixed-1.active {
                left:<?php echo $default_value['left'] ?>px;
            }
            .v-open-form-fixed-1{
                top: <?php echo $default_value['top'] ?>px;;
                left:-500px;
                border-radius:0px 3px 3px 0px;
            }
            .v-open-form-fixed-1.active{
                left:0;
            }
            
            <?php
            break;
        }
    }
?>
</style>

