<style>
    #add_post_type_form{
        box-shadow: 0px -2px 17px 1px #dfdfdf;
        -webkit-box-shadow: 0 -2px 17px 1px;
        background:#fff;
        padding:10px;
        margin-left: 20px;
        width:400px;
        float:left;
        text-align:left;
    }
    
    .bg-warning{
        padding: 5px;background: #F16666;color:#fff;
    }
</style>

<form style="margin-top: 10px;" id="add_post_type_form" class="" action="" method="POST">
<h1 class="title">
<?php 
    if($global_current_row['action'] == 'edit_post_type')
    {
        ?>
        Edit post type : <?php echo $global_current_row['post_type_name'] ?>
        <?php
    }
    else
    {
        ?>
        Add new post type
        <?php
    }
?>
</h1>
<?php 

if(!empty($error)) :
?>
<div style="" class="bg-warning"><?php  echo $error; ?></div><br />
<?php endif; ?>

<?php 

if(!empty($success)) :
?>
<div class="bg-success" style="padding: 5px;"><?php  echo $success; ?></div><br />
<?php endif; ?>

<?php if(isset($_COOKIE['success_notification'])) : ?>
<div class="bg-success" style="padding: 5px;"><?php  echo $_COOKIE['success_notification']; ?></div><br />
<?php endif;  ?>



    <label>Post type url : </label><br />
    <input class="form-control" type="text" value="<?php echo $global_current_content['url'] ?>" name="post_type_name" /><br /><br />
    
    <label>Post type Title : </label><br />
    <input class="form-control" type="text" value="<?php echo $global_current_content['name'] ?>" name="post_type_title" /><br />
    
    
    
    <label>After add new post :</label>
    <select name="after_add_post">
    
    
    <?php 
        foreach($after_add_post as $k_after_add_post=>$v_after_add_post)
        {
            ?>
            <option <?php if($global_current_content['after_add_post'] == $k_after_add_post ) echo 'selected' ?>  value="<?php echo $k_after_add_post ?>"><?php echo $v_after_add_post ?></option>
            <?php
        }
    ?>
    </select><br /><br />
    <input type="submit" class="btn btn-info" value="Add" name="submit" />
</form>