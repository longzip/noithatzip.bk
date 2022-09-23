<?php

if(!defined('SECURE_CHECK')) die('Invalid to include');

 
 

if(!defined('SITE_URL')) define('SITE_URL', $_POST['site_url']);
if(!defined('URL_SUFFIX')) define('URL_SUFFIX',  $_POST['url_suffix']);
if(!defined('ROUTER_TYPE')) define('ROUTER_TYPE', '');
if(!defined('CURRENT_URL')) define('CURRENT_URL', '');
if(!defined('MAX_ATTACHMENT_PER_FOLDER')) define('MAX_ATTACHMENT_PER_FOLDER',  $_POST['attachment_per_folder']);
if(!defined('TEMPLATE')) define('TEMPLATE', '');
if(!defined('TEMPLATE_URL')) define('TEMPLATE_URL', SITE_URL . '/tpl/' . TEMPLATE);
if(!defined('TEMPLATE_PATH')) define('TEMPLATE_PATH', '');


/**
 * Create .htaccess file
 */
$htaccess = fopen(dirname(dirname(__FILE__)) . '/.htaccess', 'w');
$txt_htaccess = 'RewriteEngine On' . "\n";    
$txt_htaccess .= 'RewriteBase /' . "\n";
$txt_htaccess .= 'RewriteRule ^index\.php$ - [L]' . "\n";
$txt_htaccess .= 'RewriteCond %{REQUEST_FILENAME} !-f' . "\n";
$txt_htaccess .= 'RewriteCond %{REQUEST_FILENAME} !-d' . "\n";
$txt_htaccess .= 'RewriteRule . index.php ' . "\n";
fwrite($htaccess, $txt_htaccess);
fclose($htaccess);


 

/**
 * Alter config file
 */
$file_config = fopen(dirname(dirname(__FILE__)) . '/config.php', 'a');

 
$txt = 'define(\'TABLE_PREFIX\', \'' . $_POST['table_prefix'] . '\');' . "\n\n"; 
$txt .= 'define(\'PATH_ROOT\', dirname(__FILE__));' . "\n \n";    
//$txt .= 'define(\'SITE_URL\', \'' . $_POST['site_url'] . '\');' . "\n\n";

//$txt .= 'define(\'MAX_ATTACHMENT_PER_FOLDER\', \'' . $_POST['attachment_per_folder'] . '\');' . "\n\n";

//$txt .= 'define(\'URL_SUFFIX\', \'.html\');' . "\n\n";

$txt .= 'include dirname(__FILE__).\'/other.php\';';
fwrite($file_config, $txt);
fclose($file_config);

include dirname(dirname(__FILE__)) . '/config.php';

$db = new models_DB;

 

$default_table_param = ' DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_general_ci ';

/**
 * #1 Create user table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . USER_TABLE . '(id INT(10) UNSIGNED AUTO_INCREMENT , user_name VARCHAR(255), password TEXT, image VARCHAR(255), secure_key TEXT,  email TEXT, point BIGINT(20), time_create VARCHAR(255), permission VARCHAR(255), PRIMARY KEY(id), INDEX(user_name)) ' . $default_table_param;

 

$global_sqli->query($temp);

$secure_key = random_string();

$insert_content = array(
    'user_name'           => $_POST['user_name'],
    'password'            => md5($_POST['password'] . $secure_key),
    'secure_key'          => $secure_key, 
    'email'               => $_POST['email'],
    'time_create'         => time(),
    'permission'          => 'admin'
);

models_DB::insert($insert_content, TABLE_PREFIX . 'user');

 



/**
 * #2 Create option table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . OPTION_TABLE . '(id INT(10) UNSIGNED AUTO_INCREMENT , name VARCHAR(255), value TEXT, is_default VARCHAR(1), is_actived VARCHAR(1), extension_pos VARCHAR(255),  display VARCHAR(1), attributes TEXT, PRIMARY KEY(id), INDEX(name))'  . $default_table_param;
 

$global_sqli->query($temp);

$insert_content = array(
    'name'  => 'site_name',
    'value' => $_POST['site_name'],
    'attributes'    => json_encode(array('title'=>'Site name', 'type'=>'text')),
    'is_default'   => 1,
    'display'      => 1
);
models_DB::insert($insert_content, TABLE_PREFIX . 'option');

$insert_content = array(
    'name'  => 'site_description',
    'value' => $_POST['description'],
    'attributes'    => json_encode(array('title'=>'Site description', 'type'=>'textarea')),
    'is_default'   => 1,
    'display'      => 1
);
models_DB::insert($insert_content, TABLE_PREFIX . 'option');
 
$insert_content = array(
    'name'  => 'template',
    'value' => 'default',
    'attributes'    => json_encode(array('title'=>'Template', 'type'=>'template')),
    'is_default'   => 1,
    'display'      => 1
);
models_DB::insert($insert_content, TABLE_PREFIX . 'option');


$insert_content = array(
    'name'  => 'home_template',
    'value' => 'default',
    'attributes'    => json_encode(array('title'=>'Home Template', 'type'=>'home-template')),
    'is_default'   => 1,
    'display'      => 1
);
models_DB::insert($insert_content, TABLE_PREFIX . 'option');

$insert_content = array(
    'name'  => 'favicon',
    'value' => SITE_URL . '/tpl/default/images/favicon.ico',
    'attributes'    => json_encode(array('title'=>'Favicon', 'type'=>'image')),
    'is_default'   => 1,
    'display'      => 1
);
models_DB::insert($insert_content, TABLE_PREFIX . 'option');

 

$insert_content = array(
    'name'  => 'posts_per_page',
    'value' => 10,
    'attributes'    => json_encode(array('title'=>'Max post per page', 'type'=>'number')),
    'is_default'   => 1,
    'display'      => 1
);
models_DB::insert($insert_content, TABLE_PREFIX . 'option');


$insert_content = array(
    'name'  => 'site_url',
    'value' => SITE_URL,
    'attributes'    => json_encode(array('title'=>'Site URL', 'type'=>'text')),
    'is_default'   => 1,
    'display'      => 1
);
models_DB::insert($insert_content, TABLE_PREFIX . 'option');

$insert_content = array(
    'name'  => 'max_attachment_per_folder',
    'value' => MAX_ATTACHMENT_PER_FOLDER,
    'attributes'    => json_encode(array('title'=>'Max attachment per folder', 'type'=>'text')),
    'is_default'   => 1,
    'display'      => 1
);
models_DB::insert($insert_content, TABLE_PREFIX . 'option');

$insert_content = array(
    'name'  => 'url_suffix',
    'value' => URL_SUFFIX,
    'attributes'    => json_encode(array('title'=>'URL Suffix', 'type'=>'text')),
    'is_default'   => 1,
    'display'      => 1
);
models_DB::insert($insert_content, TABLE_PREFIX . 'option');


$insert_content = array(
    'name'  => 'file_upload_format',
    'value' => 'image/gif image/jpeg image/jpg image/png image/pjpeg image/x-png application/x-shockwave-flash',
    'attributes'    => json_encode(array('title'=>'Định dạng file cho phép upload ( Mỗi định dạng cách nhau 1 khoẳng trắng )', 'type'=>'textarea')),
    'is_default'   => 1,
    'display'      => 1
);
models_DB::insert($insert_content, TABLE_PREFIX . 'option');

$insert_content = array(
    'name'  => 'permalink_setting',
    'value' => '0',
    'attributes'    => json_encode(array('title'=>'Permalink', 'type'=>'permalink')),
    'is_default'   => 1,
    'display'      => 1
);
models_DB::insert($insert_content, TABLE_PREFIX . 'option');


$insert_content = array(
    'name'  => 'robots_index',
    'value' => '1',
    'attributes'    => json_encode(array('title'=>'Search Engine index', 'type'=>'robots_index')),
    'is_default'   => 1,
    'display'      => 1
);
models_DB::insert($insert_content, TABLE_PREFIX . 'option');





/**
 * #3 Create config table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . CONFIG_TABLE . '(id INT(10) UNSIGNED AUTO_INCREMENT , name VARCHAR(255), value TEXT, other1 VARCHAR(255),  other2 VARCHAR(255), PRIMARY KEY(id), INDEX(name))'  . $default_table_param;
$global_sqli->query($temp);

$insert_content = array(
    'name'  => 'current_upload_folder',
    'value' => '1'
);
models_DB::insert($insert_content, TABLE_PREFIX . 'config');

/**
 * #14 Create field table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . FIELD_TABLE . '(id INT(10) UNSIGNED AUTO_INCREMENT , post_type VARCHAR(255), attribute TEXT, stt INT(3), init VARCHAR(1), page_type VARCHAR(20), the_status VARCHAR(20), tab_display VARCHAR(20), PRIMARY KEY(id))' . $default_table_param;
$global_sqli->query($temp);
$default_fields = array(
    array(
        'field_type'          => 'text',
        'name'          => 'title',
        'title'         => 'Tiêu đề',
        'min_lenght'    => '0',
        'max_lenght'    => '-1',
        'require'       => '1',
        'default'       => ''
    ),
    array(
        'field_type'          => 'slug',
        'name'          => 'url',
        'title'         => 'URL',
        'min_lenght'    => '0',
        'max_lenght'    => '-1',
        'require'       => '0',
        'default'       => '',
        'ref'           => 1
    ),
    array(
        'field_type'          => 'image',
        'name'          => 'image',
        'title'         => 'Ảnh đại diện',
        'min_lenght'    => '0',
        'max_lenght'    => '-1',
        'require'       => '0',
        'default'       => ''
    ),
    array(
        'field_type'          => 'html',
        'name'          => 'description',
        'title'         => 'Miêu tả ngắn gọn',
        'min_lenght'    => '0',
        'max_lenght'    => '-1',
        'require'       => '0',
        'default'       => ''
    ),
    array(
        'field_type'          => 'select',
        'name'          => 'the_status',
        'title'         => 'Trạng thái',
        'value'         => json_encode(array('publish', 'pending')),
        'value_display' => json_encode(array('Xuất bản', 'Nháp')),
        'default'       => 'publish'
    ),
    array(
        'field_type'          => 'template',
        'name'          => 'template',
        'title'         => 'Giao diện',
        'default'       => 'default'
    )
);

foreach($default_fields as $k=>$v)
{
    $insert_content = array(
        'attribute'     => json_encode($v),
        'init'          => '1',
        'stt'           => $k,
        'post_type'     => 0,
        'tab_display'   => 'general',
        'page_type'     => 'all',
        'the_status'    => 'publish' 
    );
    
    models_DB::insert($insert_content, FIELD_TABLE);
}
$temp_array = array(
        'field_type'    => 'seo',
        'name'          => 'seo',
        'title'         => 'SEO',
        'default'       => json_encode(array('title'=>'', 'description'=>'', 'index'=>'index', 'follow'=>'follow', 'canonical'=>'', '301'=>'', 'keywords'=>''))
    );
$insert_content = array(
        'attribute'     => json_encode($temp_array),
        'init'          => '1',
        'stt'           => 0,
        'post_type'     => 0,
        'tab_display'   => 'seo',
        'page_type'     => 'all',
        'the_status'    => 'publish' 
    );
    
models_DB::insert($insert_content, FIELD_TABLE);

$temp_array = array(
        'field_type'    => 'CheckboxCategory',
        'name'          => 'categories',
        'title'         => 'Chuyên mục',
        'require'       =>  '0',
        'default'       => ''
    );
$insert_content = array(
        'attribute'     => json_encode($temp_array),
        'init'          => '1',
        'stt'           => 7,
        'post_type'     => 0,
        'tab_display'   => 'general',
        'page_type'     => 'post',
        'the_status'    => 'publish' 
    );
    
models_DB::insert($insert_content, FIELD_TABLE);

$temp_array = array(
        'field_type'    => 'CheckboxTag',
        'name'          => 'tags',
        'title'         => 'TAGS',
        'require'       =>  '0',
        'default'       => ''
    );
$insert_content = array(
        'attribute'     => json_encode($temp_array),
        'init'          => '1',
        'stt'           => 8,
        'post_type'     => 0,
        'tab_display'   => 'general',
        'page_type'     => 'post',
        'the_status'    => 'publish' 
    );
    
models_DB::insert($insert_content, FIELD_TABLE);
 
 
/**
 * #5 Create post table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . TABLE_PREFIX . 'post(id BIGINT(20) UNSIGNED AUTO_INCREMENT , title TEXT, url VARCHAR(70), post_type INT(3), categories VARCHAR(70), tags VARCHAR(70), template VARCHAR(255), view_count BIGINT(20), comment_count VARCHAR(255), secure_key TEXT, description TEXT, seo TEXT,  content LONGTEXT, image TEXT, the_status VARCHAR(70), thanks_count VARCHAR(255), thanks_user TEXT,  time_create VARCHAR(255), time_update VARCHAR(255), user_id VARCHAR(2), PRIMARY KEY(id), INDEX(url, the_status, categories, tags))'  . $default_table_param;

 
$global_sqli->query($temp);

$insert_content = array(
    'title'           => 'Hello Admin',
    'content'         => 'I\'m example post, delete me if you want',
    'categories'           => 1,
    'user_id'         => 1,
    'secure_key'      => random_string(),
    'the_status'          => 'publish',
    'time_create'     => hcv_time(),
    'time_update'     => hcv_time(),
    'view_count'      => 0,
    'comment_count'     => 0,
    'thanks_count'      => 0,
    'post_type'         => 1,
    'url'               => 'hello-admin',
    'seo'               => json_encode(array('title'=>'', 'description'=>'', 'index'=>'index', 'follow'=>'follow', 'keywords'=> '', 'canonical'=>'', '301'=>''))
);
models_DB::insert($insert_content, TABLE_PREFIX . 'post');

 
    

$temp_array = array(
        'field_type'          => 'html',
        'name'          => 'content',
        'title'         => 'Nội dung',
        'min_lenght'    => '0',
        'max_lenght'    => '-1',
        'require'       => '0',
        'default'       => ''
    );

$insert_content = array(
    'attribute'     => json_encode($temp_array),
    'init'          => '1',
    'stt'           => 1,
    'post_type'     => 0,
    'tab_display'   => 'general',
    'page_type'     => 'post',
    'the_status'    => 'publish'   
);

models_DB::insert($insert_content, FIELD_TABLE);

/**
 * #6 Create comment table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . TABLE_PREFIX . 'comment(id BIGINT(20) UNSIGNED AUTO_INCREMENT , title VARCHAR(255), name VARCHAR(255), email VARCHAR(255), content TEXT, post_id INT(10), user_id INT(10), parent BIGINT(20), time_create VARCHAR(255), PRIMARY KEY(id), INDEX(user_id, post_id))'  . $default_table_param;
$global_sqli->query($temp);

$insert_content = array(
    'title'           => 'Comment example',
    'content'         => 'I\'m example comment',
    'post_id'         => 1,
    'user_id'         => 1,
    'parent'         => 0,
    'time_create'     => hcv_time()
);
models_DB::insert($insert_content, TABLE_PREFIX . 'comment');



/**
 * #7 Create category table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . CATEGORY_TABLE . '(id INT(10) UNSIGNED AUTO_INCREMENT , title VARCHAR(255), url VARCHAR(255), stt INT(3), description TEXT, seo TEXT, content TEXT, the_status VARCHAR(20), image TEXT, template VARCHAR(255), parent INT(10), time_create VARCHAR(255),time_update VARCHAR(255), view_count VARCHAR(255), PRIMARY KEY(id), INDEX(url))'  . $default_table_param;
 
 
$global_sqli->query($temp);

$insert_content = array(
    'title'              => 'Example category',
    'description'        => 'I\'m example category, delete me if you want',
    'parent'             => 0,
    'stt'                => 1, 
    'view_count'         => 1,
    'url'                => 'example-category',
    'the_status'         => 'publish',
    'seo'               => json_encode(array('title'=>'', 'description'=>'', 'index'=>'index', 'follow'=>'follow', 'keywords'=> '', 'canonical'=>'', '301'=>''))

);
models_DB::insert($insert_content, CATEGORY_TABLE);


$temp_array = array(
    'field_type'          => 'number',
    'name'          => 'stt',
    'title'         => 'Số thứ tự',
    'min_lenght'    => '0',
    'max_lenght'    => '-1',
    'require'       => '1',
    'default'       => 0
);

$insert_content = array(
    'attribute'     => json_encode($temp_array),
    'init'          => '1',
    'stt'           => 2,
    'post_type'     => 0,
    'tab_display'   => 'general',
    'page_type'     => 'category',
    'the_status'    => 'publish'   
);

models_DB::insert($insert_content, FIELD_TABLE);

$temp_array = array(
    'field_type'    => 'SelectCategory',
    'name'          => 'parent',
    'title'         => 'Chuyên mục cha',
    'min_lenght'    => '0',
    'max_lenght'    => '-1',
    'require'       => '1',
    'default'       => 0
);

$insert_content = array(
    'attribute'     => json_encode($temp_array),
    'init'          => '1',
    'stt'           => 1,
    'post_type'     => 0,
    'tab_display'   => 'general',
    'page_type'     => 'category',
    'the_status'    => 'publish'   
);

models_DB::insert($insert_content, FIELD_TABLE);

/**
 * #7 Create tag table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . TAG_TABLE . '(id INT(10) UNSIGNED AUTO_INCREMENT , title  TEXT, url  VARCHAR(255), description TEXT, seo TEXT,   the_status VARCHAR(20),image TEXT, template VARCHAR(255),view_count VARCHAR(255), time_create VARCHAR(255),time_update VARCHAR(255), PRIMARY KEY(id), INDEX(url))' . $default_table_param;
$global_sqli->query($temp);


/**
 * Create post type table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . POST_TYPE_TABLE . '(id INT(3) UNSIGNED AUTO_INCREMENT , name VARCHAR(255), default_field VARCHAR(1), default_template VARCHAR(255), image TEXT, PRIMARY KEY(id))'  . $default_table_param;
$global_sqli->query($temp);

$insert_content = array(
    'name'              => 'Example post type',
    'default_field'     => 1,
    'default_template'  => 'default',
    'image'             => SITE_URL . '/inc/images/post-type-news.png'  
);
models_DB::insert($insert_content, POST_TYPE_TABLE);







/**
 * #10 Create admin notification table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . NOTIFICATION_TABLE . '(id BIGINT(20) UNSIGNED AUTO_INCREMENT , content TEXT, user_id INT(10), time_create VARCHAR(255), already_read TINYINT(1), PRIMARY KEY(id))' . $default_table_param;
$global_sqli->query($temp);



/**
 * #11 Create attachment table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . ATTACHMENT_TABLE . '(id BIGINT(20) UNSIGNED AUTO_INCREMENT ,user_id INT(10), url TEXT, title VARCHAR(255), alt VARCHAR(255), description TEXT, align VARCHAR(10), attributes TEXT, PRIMARY KEY(id))' . $default_table_param;
$global_sqli->query($temp);


/**
 * #12 Create block table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . BLOCK_TABLE . '(id INT(10) UNSIGNED AUTO_INCREMENT , name TEXT, url TEXT, parameter TEXT, PRIMARY KEY(id))' . $default_table_param;
$global_sqli->query($temp);

$insert_content = array(
    'id'         => 1,
    'name'       => 'image',
    'parameter'  => json_encode(array('title'=>'','title_link'=>'','src'=>SITE_URL . '/tpl/default/images/logo.png'))
    
);
models_DB::insert($insert_content, BLOCK_TABLE);

$insert_content = array(
    'id'         => 2,
    'name'       => 'html',
    'parameter'  => json_encode(array('title'=>'','title_link'=>'', 'content'=>'<p><img title="Banner" src="'. SITE_URL .'/tpl/default/images/ex-banner.jpg" alt="Banner" /></p>'))
    
);
models_DB::insert($insert_content, BLOCK_TABLE);

$insert_content = array(
    'id'         => 3,
    'name'       => 'menu',
    'parameter'  => json_encode(array(
        'title'         => '',
        'title_link'=>'', 
        array(
            'link'      => SITE_URL . '/example-category',
            'anchor'    => 'Uncategory',
            'depth'     => 0
        ),
        array(
            'link'      => '#',
            'anchor'    => 'Sub #3',
            'depth'     => 1
        ),
        array(
            'link'      => '#',
            'anchor'    => 'Sub #2',
            'depth'     => 1
        ),
        array(
            'link'      => '#',
            'anchor'    => 'Sub #1',
            'depth'     => 1
        ),
        array(
            'link'      => 'http://google.com.vn',
            'anchor'    => 'Google',
            'depth'     => 0
        ),
        array(
            'link'      => 'http://facebook.com',
            'anchor'    => 'Facebook',
            'depth'     => 0
        )        
    ))
    
);
models_DB::insert($insert_content, BLOCK_TABLE);


$insert_content = array(
    'id'         => 4,
    'name'       => 'fb',
    'parameter'  => json_encode(array(
        'title'         => 'Facebook',
        'title_link'=>'',        
        'link'          => 'https://www.facebook.com/congdonghandmade.net',
        'height'        => 400,
        'width'         => 240,
        'colorscheme'   => 'light'
    ))
    
);
models_DB::insert($insert_content, BLOCK_TABLE);


 

 

$insert_content = array(
    'id'         => 6,
    'name'       => 'html',
    'parameter'  => json_encode(array('title'=>'','title_link'=>'', 'content'=>'<p>NETBIT Joint Stock Company</p><p>Address : 15A, Tran Quy Kien Street, Cau Giay, Ha Noi, VietNam</p><p>Tel : 0972.743.623</p><p>E-mail : netbitmedia@gmail.com</p>
'))
    
);
models_DB::insert($insert_content, BLOCK_TABLE);



/**
 * #13 Create block area table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . BLOCK_AREA_TABLE . '(id INT(10) UNSIGNED AUTO_INCREMENT , name TEXT, url TEXT, secure_key VARCHAR(255), description VARCHAR(255), content TEXT, PRIMARY KEY(id))' . $default_table_param;
$global_sqli->query($temp);

$insert_content = array(
    'name'      => 'Logo',
    'url'       => 'logo',
    'content'   => '1'
    
);
models_DB::insert($insert_content, BLOCK_AREA_TABLE);

$insert_content = array(
    'name'      => 'Top banner',
    'url'       => 'top-banner',
    'content'   => '2'
    
);
models_DB::insert($insert_content, BLOCK_AREA_TABLE);

$insert_content = array(
    'name'      => 'Main menu',
    'url'       => 'main-menu',
    'content'   => '3'
    
);
models_DB::insert($insert_content, BLOCK_AREA_TABLE);

$insert_content = array(
    'name'      => 'Sidebar',
    'url'       => 'sidebar',
    'content'   => '4'
    
);
models_DB::insert($insert_content, BLOCK_AREA_TABLE);

$insert_content = array(
    'name'      => 'Footer',
    'url'       => 'footer',
    'content'   => '6'
    
);
models_DB::insert($insert_content, BLOCK_AREA_TABLE);




/**
 * Create order table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . ORDER_TABLE . '(id INT(10) UNSIGNED AUTO_INCREMENT , name VARCHAR(255), phone VARCHAR(255), place TEXT, email VARCHAR(255), ip_address VARCHAR(255), total_cost VARCHAR(255), the_status VARCHAR(255), other TEXT, time_create VARCHAR(255), content TEXT, PRIMARY KEY(id))' . $default_table_param;
$global_sqli->query($temp);


/**
 * #8 Create chat table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . CHAT_TABLE . '(id INT(10) UNSIGNED AUTO_INCREMENT , content TEXT, user_id INT(10), time_create VARCHAR(255), PRIMARY KEY(id))' . $default_table_param;
$global_sqli->query($temp);


/**
 * Create form table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . TABLE_PREFIX . 'form (id INT(10) UNSIGNED AUTO_INCREMENT , the_type VARCHAR(255),  name VARCHAR(255), mail_to VARCHAR(255), field_form INT(10), field_name VARCHAR(255), field_stt INT(10), field_slug VARCHAR(255), field_parent INT(10), field_type VARCHAR(255), field_attribute TEXT, text_after_submit TEXT, field_require INT(1), order_content TEXT, other1 TEXT, other2 TEXT, time_create VARCHAR(255), PRIMARY KEY(id))' . $default_table_param;
$global_sqli->query($temp);


/**
 * #2 Create extension table
 */
$temp = 'CREATE TABLE IF NOT EXISTS ' . TABLE_PREFIX . 'extension(id INT(10) UNSIGNED AUTO_INCREMENT , name VARCHAR(255),  display_position VARCHAR(255), is_actived VARCHAR(1), attributes TEXT, PRIMARY KEY(id), INDEX(name, display_position))'  . $default_table_param;
 

$global_sqli->query($temp);
 