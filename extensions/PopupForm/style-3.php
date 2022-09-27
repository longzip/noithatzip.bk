<style>
.v-form-fixed-3 {
    position: fixed;
    background: #015ea7;
    text-align: left;
    color: #fff;
    z-index: 9;
    width: 530px;
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
    height: 50px;
    line-height: 50px;
    width: 50px;
    text-align: center;
    color: #fff;
    font-size: 20px;
    cursor: pointer;
}

.v-open-form-fixed-3:hover {
    background: #015ea7;
}
.v-show-form-fixed{
    cursor:pointer;
}

<?php 
    switch($default_value['form_position'])
    {
        case 'bottom_left' :
        {
            
            ?>
            .v-form-fixed-3 {
                left:-700px;
                bottom:<?php echo $default_value['bottom'] ?>px;
                 border-radius:0px 3px 3px 0px;
                
            }
            .v-form-fixed-3.active {
                left:<?php echo $default_value['left'] ?>px;
            }
            .v-open-form-fixed-3{
                left:-700px;
                bottom:<?php echo $default_value['bottom'] + 100 ?>px;
            }
            .v-open-form-fixed-3.active{
                left:0;
            }
            <?php
            break;
        }
        
        case 'top_right' :
        {
            ?>
            .v-form-fixed-3 {
                right: -700px;
                top: <?php echo $default_value['top'] ?>px;
            }
            .v-form-fixed-3.active {
                right:<?php echo $default_value['right'] ?>px;
            }
            
            .v-open-form-fixed-3{
                right: -700px;
                top: <?php echo $default_value['top'] ?>px;
                border-radius:3px 0px 0px 3px;
            }
            .v-open-form-fixed-3.active{
                right:0;
            }
            .v-open-form-fixed-3 i{
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
            .v-form-fixed-3 {
                right: -700px;
                bottom:<?php echo $default_value['bottom'] ?>px;
            }
            .v-form-fixed-3.active {
                right:<?php echo $default_value['right'] ?>px;
            }
            
            .v-open-form-fixed-3{
                right: -700px;
                bottom:<?php echo $default_value['bottom'] + 100 ?>px;
                border-radius:3px 0px 0px 3px;
            }
            .v-open-form-fixed-3.active{
                right:0;
            }
            .v-open-form-fixed-3 i{
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
            .v-form-fixed-3 {
                top: <?php echo $default_value['top'] ?>px;;
                left:-500px;
            }
            .v-form-fixed-3.active {
                left:<?php echo $default_value['left'] ?>px;
            }
            .v-open-form-fixed-3{
                top: <?php echo $default_value['top'] ?>px;;
                left:-500px;
                border-radius:0px 3px 3px 0px;
            }
            .v-open-form-fixed-3.active{
                left:0;
            }
            
            <?php
            break;
        }
    }
?>
</style>

