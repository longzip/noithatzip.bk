<?php
session_start();

if( isset($_POST['type']) && ($_POST['type'] == 'get-all-field-value') )
{
    $t = 'SELECT DISTINCT ' . $_POST['field'] . ' FROM '. POST_TABLE . ' WHERE ' . $_POST['field'] . ' LIKE \'%'. $_POST['keyword'] .'%\'';
    $lists = models_DB::get($t);
     
    foreach($lists as $list)
    {
        if(empty($list[$_POST['field']])) continue;
        ?>
        <div class="suggest-item" par="<?php echo $_POST['field'] ?>"><?php echo $list[$_POST['field']] ?></div>
        <?php
    }
}