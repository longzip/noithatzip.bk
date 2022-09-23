<?php
function validate_value($name, $title, $regular_expression = FALSE, $rule = array('min_lenght' => 0, 'max_lenght' => -1, 'type' => 'all'))
{
    global $g_form_error_noti;
    
    if(isset($_POST[$name]))
    {
        if($regular_expression) if(!preg_match($regular_expression, $_POST[$name])) $g_form_error_noti[] = '<span class="error-noti-item-name">' . $title . '</span> không hợp lệ';
        
        if(isset($rule['min_lenght']) && is_numeric($rule['min_lenght']) && ($rule['min_lenght'] > 0)) if($rule['min_lenght'] > strlen(strip_tags($_POST[$name]))) $g_form_error_noti[] = '<span class="error-noti-item-name">' . $title . '</span> phải chứa tối thiểu ' . $rule['min_lenght'] . ' ký tự';
        if(isset($rule['max_lenght']) && is_numeric($rule['max_lenght']) && ($rule['max_lenght'] > 0)) if($rule['max_lenght'] < strlen(strip_tags($_POST[$name]))) $g_form_error_noti[] = '<span class="error-noti-item-name">' . $title . '</span> chỉ được chứa tối đa ' . $rule['max_lenght'] . ' ký tự';
        
              
        if(isset($rule['type']))
        {
            switch($rule['type'])
            {
                case 'user_name' :
                {
                    if(!preg_match('/^[a-zA-Z0-9_]{3,31}$/', $_POST[$name])) $g_form_error_noti[] = '<span class="error-noti-item-name">' . $title . '</span> chỉ được chứa chữ cái, chữ số, dấu gạch dưới và phải có từ 3 -> 31 ký tự';
                
                }
                break;
                
                case 'password' :
                {
                    //if(!preg_match('/[A-Z]/', $_POST[$name])) $g_form_error_noti[] = '<span class="error-noti-item-name">' . $title . '</span> phải có ít nhất một ký tự viết hoa.';
                    //if(!preg_match('/[~`!@#$%^&*()]/', $_POST[$name])) $g_form_error_noti[] = '<span class="error-noti-item-name">' . $title . '</span> phải có ít nhất một ký tự đặc biệt.';
                    //if(!preg_match('/[0-9]/', $_POST[$name])) $g_form_error_noti[] = '<span class="error-noti-item-name">' . $title . '</span> phải có ít nhất một chữ số.';
                    if(!preg_match('/^[a-zA-Z0-9_!@#$%^&*()\.]{8,31}$/', $_POST[$name])) $g_form_error_noti[] = '<span class="error-noti-item-name">' . $title . '</span> phải có từ 8 -> 31 ký tự và không được chứa khoảng trắng';
                }
                break;
                
                case 'email' :
                {
                    if(!preg_match('/^[a-zA-Z0-9_\.+-]+@[a-zA-Z0-9_\.-]+\.[a-zA-Z0-9]+$/', $_POST[$name])) $g_form_error_noti[] = '<span class="error-noti-item-name">' . $title . '</span>  không đúng định dạng';
                    
                } 
                break;
                
                case 'number' :
                {
                    if(!preg_match('/^-{0,1}[0-9]+$/', $_POST[$name])) $g_form_error_noti[] = '<span class="error-noti-item-name">' . $title . '</span> không đúng định dạng';
                    
                } 
                
                break;
                case 'url' :
                {
                    if(!preg_match('/^(http|https){1}:\/\/[a-zA-Z0-9_.+-\/]+$/', $_POST[$name])) $g_form_error_noti[] = '<span class="error-noti-item-name">' . $title . '</span> không đúng định dạng';
                } 
                break;
            }
        }
        
    }
    
}

function return_value($name, $default = '', $html = FALSE, $htmlspecialchars = TRUE, $key = '')
{
    //h($name);return ;
    
    
    if(isset($_POST[$name]))
    {
        if($key != '')
        {
            $output = $_POST[$name][$key];
            if($html == FALSE)
            {
                $output = strip_tags($output);
            }
            else
            {
                if($html != 'all')
                { 
                    $output = strip_tags($output, $html);
                }
            }
            
            
            if(!$htmlspecialchars)
            {
                $output = htmlspecialchars($output);
            }
            
            echo $output;
        }
        else
        {
            
            
            $output = $_POST[$name];
             
            if($html == FALSE)
            {
                $output = strip_tags($output);
            }
            else
            {
                if($html != 'all')
                { 
                    $output = strip_tags($output, $html);
                }
            }
            
            
            if(!$htmlspecialchars)
            {
                $output = htmlspecialchars($output);
            }
            
            echo $output;
            
             
        }
        
        
    }
    else echo $default;
        
}

function check_select($name, $default_value, $value)
{
    if(isset($_POST[$name]))
    {
        if($value == $_POST[$name]) echo 'selected';
    }
    else
    {
        if($value == $default_value) echo 'selected';
    }
}

function check_checkbox($name, $default_value=array(), $value)
{
    if(isset($_POST[$name]))
    {
        if(in_array($value, $_POST[$name])) echo 'checked';
    }
    else
    {
        if(in_array($value, $default_value)) echo 'checked';
    }
}

function show_form_error()
{
    global $g_form_error_noti;
    if(!empty($g_form_error_noti))
    {
    ?>
    <div class="error-noti">
        <ul>
        <?php 
            foreach($g_form_error_noti as $value)
            {
                ?>
                <li><?php echo $value ?></li>
                <?php
            }
        ?>
        </ul>
    </div>
    <?php
    }
}

function show_form_success()
{
    global $g_form_success;
    if(!empty($g_form_success))
    {
    ?>
    <div class="success-noti">
        <?php echo $g_form_success; ?>
    </div>
    <?php
    }
}

function form_validation()
{
    global $g_form_error_noti;
    if(empty($g_form_error_noti)) return TRUE;
    else return FALSE;
}