<?php

if(!defined('SECURE_CHECK')) die('Invalid to include');

	$current_url = get_current_url();
?>

<aside id="sidebar" class="fl col-2-6">
    <div class="inner">
        
         
        <ul>
            <?php 
                $this_url = SITE_URL . '/admin/';
            ?>
            <li class="home">
                <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                <span class="menu-icon"><i class="fa fa-desktop fa-lg"></i></span>
                <span class="text">Home</span>
                </a>
            </li>
        </ul>
        
        <?php 
            if(user_can('general'))
            {
        ?>
        
        <ul>
            <?php 
                $this_url = SITE_URL . '/admin/?page_type=general';
            ?>
            <li class="general">
                <a class="" href="<?php echo $this_url ?>">
                <span class="menu-icon"><i class="fa fa-info fa-lg"></i></span>
                <span class="text">Cài đặt tổng quan</span>
                </a>
                
                <ul class="sub-menu none">
                    <?php 
                        $this_url = SITE_URL . '/admin/?page_type=general';
                    ?>
                    <li class="manager-forums">
                        <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                        <span class="menu-icon"><i class="fa  fa-caret-right fa-lg"></i></span>
                        <span class="text">General Settings</span>
                        </a>
                    </li>
                    
                    <?php 
                        $this_url = SITE_URL . '/admin/?page_type=new-option';
                    ?>
                    <li class="new-forum  ">
                        <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                        <span class="menu-icon"><i class="fa fa-caret-right fa-lg"></i></span>
                        <span class="text">New option</span>
                        </a>
                    </li>
                </ul>
                
            </li>
        </ul>
		
        <?php 
            }
        ?>
        
        <?php 
            if(user_can('posts'))
            {
        ?>
        
		<?php 
            $post_types = get_post_types();
             
            foreach($post_types as $post_type)
            {
                ?>
                <ul>
                    <?php 
                        $this_url = SITE_URL . '/admin/?page_type=posts&post_type_id='.$post_type['id'];
                    ?>
                    <li class="posts">
                        <a class="" href="<?php echo $this_url ?>">
                            <span class="menu-icon"><i class="fa fa-yelp fa-lg"></i></span>
                            <span class="text"><?php echo $post_type['name'] ?></span>
                        </a>
                        <ul class="sub-menu">
                            <?php 
                                $this_url = SITE_URL . '/admin/?page_type=posts&post_type_id='.$post_type['id'];
                            ?>
                            <li class="manager-post">
                                <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                                <span class="menu-icon"><i class="fa  fa-caret-right fa-lg"></i></span>
                                <span class="text">Quản lý <span class="post-type-name">"<?php echo $post_type['name'] ?>"</span></span>
                                </a>
                            </li>
                            
                            <?php 
                                $this_url = SITE_URL . '/admin/?page_type=new-post&post_type_id='.$post_type['id'];
                            ?>
                            <li class="new-posts">
                                <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                                <span class="menu-icon"><i class="fa fa-caret-right fa-lg"></i></span>
                                <span class="text">Thêm <span class="post-type-name">"<?php echo $post_type['name'] ?>"</span></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    
                </ul>
                <?php
            }
        ?>
		
        <?php 
            }
        ?>
        
        <?php 
            if(user_can('categories'))
            {
        ?>
        
        <ul>
            <?php 
                $this_url = SITE_URL . '/admin/?page_type=categories';
            ?>
            <li class="forum">
                <a class="" href="<?php echo $this_url ?>">
                    <span class="menu-icon"><i class="fa fa-yelp fa-lg"></i></span>
                    <span class="text">Chuyên mục</span>
                </a>
                <ul class="sub-menu">
                    <?php 
                        $this_url = SITE_URL . '/admin/?page_type=categories';
                    ?>
                    <li class="manager-forums">
                        <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                        <span class="menu-icon"><i class="fa  fa-caret-right fa-lg"></i></span>
                        <span class="text">Danh sách chuyên mục</span>
                        </a>
                    </li>
                    
                    
                    <?php 
                        $this_url = SITE_URL . '/admin/?page_type=new-category';
                    ?>
                    <li class="new-forum">
                        <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                        <span class="menu-icon"><i class="fa fa-caret-right fa-lg"></i></span>
                        <span class="text">Thêm chuyên mục</span>
                        </a>
                    </li>
                    
                    
                    <?php 
                        $this_url = SITE_URL . '/admin/?page_type=manager-post-type-field&post_type_id=0&page_type_field=category';
                    ?>
                    <li class="new-forum none">
                        <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                        <span class="menu-icon"><i class="fa fa-caret-right fa-lg"></i></span>
                        <span class="text">Manager field</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
		
        
        
        
        <ul>
            <?php 
                $this_url = SITE_URL . '/admin/?page_type=tags';
            ?>
            <li class="forum">
                <a class="" href="<?php echo $this_url ?>">
                    <span class="menu-icon"><i class="fa fa-yelp fa-lg"></i></span>
                    <span class="text">Tags</span>
                </a>
                <ul class="sub-menu">
                    <?php 
                        $this_url = SITE_URL . '/admin/?page_type=tags';
                    ?>
                    <li class="manager-forums">
                        <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                        <span class="menu-icon"><i class="fa  fa-caret-right fa-lg"></i></span>
                        <span class="text">Danh sách Tags</span>
                        </a>
                    </li>
                    
                    <?php 
                        $this_url = SITE_URL . '/admin/?page_type=new-tag';
                    ?>
                    <li class="new-forum">
                        <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                        <span class="menu-icon"><i class="fa fa-caret-right fa-lg"></i></span>
                        <span class="text">Thêm tag</span>
                        </a>
                    </li>
                    
                    <?php 
                        $this_url = SITE_URL . '/admin/?page_type=manager-post-type-field&post_type_id=0&page_type_field=tag';
                    ?>
                    <li class="new-forum none">
                        <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                        <span class="menu-icon"><i class="fa fa-caret-right fa-lg"></i></span>
                        <span class="text">Manager field</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        
        <?php 
            }
        ?>
        
         <?php 
            if(user_can('post-type'))
            {
        ?>
        
        <ul class="none">
            <?php 
                $this_url = SITE_URL . '/admin/?page_type=post-type';
            ?>
            <li class="post-type">
                <a class="" href="<?php echo $this_url ?>">
                    <span class="menu-icon"><i class="fa fa-tasks fa-lg"></i></span>
                    <span class="text">Post type</span>
                </a>
                <ul class="sub-menu">
                    <?php 
                        $this_url = SITE_URL . '/admin/?page_type=post-type';
                    ?>
                    <li class="manager-post-type">
                        <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                        <span class="menu-icon"><i class="fa  fa-caret-right fa-lg"></i></span>
                        <span class="text">All Post type</span>
                        </a>
                    </li>
                    
                    <?php 
                        $this_url = SITE_URL . '/admin/?page_type=new-post-type';
                    ?>
                    <li class="new-post-type">
                        <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                        <span class="menu-icon"><i class="fa fa-caret-right fa-lg"></i></span>
                        <span class="text">New Post type</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
		
		
		<ul class="none">
            <?php 
                $this_url = SITE_URL . '/admin/?page_type=block-area';
            ?>
            <li class="block-area">
                <a class="" href="<?php echo $this_url ?>">
                    <span class="menu-icon"><i class="fa fa-area-chart fa-lg"></i></span>
                    <span class="text">Block area</span>
                </a>
                <ul class="sub-menu">
                    <?php 
                        $this_url = SITE_URL . '/admin/?page_type=block-area';
                    ?>
                    <li class="manager-block-area">
                        <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                        <span class="menu-icon"><i class="fa  fa-caret-right fa-lg"></i></span>
                        <span class="text">All Block area</span>
                        </a>
                    </li>
                    
                    <?php 
                        $this_url = SITE_URL . '/admin/?page_type=new-block-area';
                    ?>
                    <li class="new-block-area">
                        <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                        <span class="menu-icon"><i class="fa fa-caret-right fa-lg"></i></span>
                        <span class="text">New Block area</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        
        <ul class="none">
            <?php 
                $this_url = SITE_URL . '/admin/?page_type=template';
            ?>
            <li class="template">
                <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                <span class="menu-icon"><i class="fa fa-file-image-o fa-lg"></i></span>
                <span class="text">Template</span>
                </a>
            </li>
        </ul>
        
        <ul class="none">
            <?php 
                $this_url = SITE_URL . '/admin/?page_type=editor';
            ?>
            <li class="Editor">
                <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                <span class="menu-icon"><i class="fa fa-file-image-o fa-lg"></i></span>
                <span class="text">Editor</span>
                </a>
            </li>
        </ul>
        
        <ul>
            <?php 
                $this_url = SITE_URL . '/admin/?page_type=user';
            ?>
            <li class="user">
                <a class="" href="<?php echo $this_url ?>">
                <span class="menu-icon"><i class="fa fa-users fa-lg"></i></span>
                <span class="text">User</span>
                </a>
            </li>
            
            
            <ul class="sub-menu">
                    <?php 
                        $this_url = SITE_URL . '/admin/?page_type=user';
                    ?>
                    <li class="user">
                        <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                        <span class="menu-icon"><i class="fa fa-users fa-lg"></i></span>
                        <span class="text">User</span>
                        </a>
                    </li>
                    
                     <?php 
                        $this_url = SITE_URL . '/admin/?page_type=new-user';
                    ?>
                    <li class="user">
                        <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                        <span class="menu-icon"><i class="fa fa-bolt fa-lg"></i></span>
                        <span class="text">New user</span>
                        </a>
                    </li>
                </ul>
        </ul>
        
        
        <ul>
            <?php 
                $this_url = SITE_URL . '/admin/?page_type=form';
            ?>
            <li class="user">
                <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                <span class="menu-icon"><i class="fa fa-bolt fa-lg"></i></span>
                <span class="text">Form</span>
                </a>
            </li>
        </ul>
        
        <ul>
            <?php 
                $this_url = SITE_URL . '/admin/?page_type=ecommerce';
            ?>
            <li class="user">
                <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                <span class="menu-icon"><i class="fa fa-bolt fa-lg"></i></span>
                <span class="text">Quản trị đăng tin</span>
                </a>
            </li>
        </ul>
        
        <?php 
            }
        ?>
        
        
        <ul>
            <?php 
                $this_url = SITE_URL . '/admin/?page_type=tpl';
            ?>
            <li class="user">
                <a class="<?php if($current_url == $this_url) echo 'active' ?>" href="<?php echo $this_url ?>">
                <span class="menu-icon"><i class="fa fa-code fa-lg"></i></span>
                <span class="text">Chỉnh sửa giao diện</span>
                </a>
            </li>
        </ul>
        
    </div>
</aside>
