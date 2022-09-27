<?php 
    $empty_row = array(
                'name'  => $extension_name,
                'attributes' => json_encode(array('list_url'=>'')),
                'display_position'  => '',
                'is_actived'        => '0'
            );


?>

<div class="wrap-setting-icon"><span>Cài đặt</span></div>
<div class="wrap-setting">
    <div class="wrap-add none"  ><span class="add"><i title="Thêm" class="fa fa-plus"></i></span></div>
    <div class="post-form-item clearfix" id="list-post-item" >        
        <?php 
            $list_rows = get_extension($_GET['extension']);
                    
            if(empty($list_rows)) $list_rows[0] = $empty_row;
            foreach($list_rows as $k=>$list_row)
            {
                $extension_info = get_extension_by_id($list_row['id']); // Info của 1 hàng
                $attributes = json_decode($extension_info['attributes'], TRUE);
                ?>
                <div class="new-thread-item box">
                    <span title="Xóa" class="delete-position none"><i class="fa fa-close"></i></span>
                    <div class="field-item clearfix none">
                        <div class="field-title">
                            <label class="label block">Vị trí hiển thị</label>
                        </div>
                             
                        <div class="field-content">
                            <select name="display_position[]">
                                <option <?php if($extension_info['display_position'] == 'after_open_head') echo 'selected' ?> value="after_open_head">Sau thẻ mở head &nbsp; &nbsp; ( &lt;head&gt; )</option>
                                <option <?php if($extension_info['display_position'] == 'before_close_head') echo 'selected' ?> value="before_close_head">Trước thẻ đóng head &nbsp; &nbsp; ( &lt;/head&gt; )</option>
                                <option <?php if($extension_info['display_position'] == 'after_open_body') echo 'selected' ?> value="after_open_body">Sau thẻ mở body &nbsp; &nbsp; ( &lt;body&gt; )</option>
                                <option  <?php if($extension_info['display_position'] == 'before_close_body') echo 'selected' ?> value="before_close_body">Trước thẻ đóng body &nbsp; &nbsp; ( &lt;/body&gt; )</option>
                            </select>
                        </div>
                    </div>
                
                    <div class="field-item clearfix">
                        <div class="field-title">
                            <label class="label block">Danh sách link chạy adword (<span style="font-size: 10px;text-tranform:auto">Mỗi link trên 1 dòng</span>)</label>
                        </div>
                    
                        <div class="field-content">    
                            <textarea  spellcheck="false" style="box-sizing: border-box;width:100%;height:150px" class="text" name="list_url[]"><?php echo $attributes['list_url'] ?></textarea>
                        </div>
                    </div>
                    
                </div>
                <?php 
            }
        ?>
         
    </div>
</div>

<div class="statistic">
    <?php 
        $lists = models_DB::get(' SELECT ip, COUNT(*) as total FROM ' . VISITOR_TABLE . '   GROUP BY ip ORDER BY COUNT(*) DESC');
        ?>
        
        <div class="field-filter-item">
            <label>Lọc theo đường dẫn</label>
            <select>
                <option value="0">-- Tất cả --</option>
                <?php 
                    $list_urls = explode(PHP_EOL, $attributes['list_url']);
                    foreach($list_urls as $list_url)
                    {
                        ?>
                        <option value="<?php echo $list_url ?>"><?php echo $list_url ?></option>
                        <?php
                    }
                ?>
            </select>
        </div>
        
        <table>
            <tr class="tr-first">
                <td class="stt">STT</td>
                <td class="ip">IP</td>
                <td class="so-lan-click">Số lần click</td>
            </tr>
        
        <?php
        
        foreach($lists as $k=>$list)
        {
            ?>
            <tr class="" >
                <td class="stt"><?php echo $k + 1 ?></td>
                <td class="ip"><?php echo $list['ip'] ?></td>
                <td class="so-lan-click"><?php echo $list['total'] ?></td> 
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    ?>
</div>

<br /><br />
 


<script>
    $("document").ready(function(){
        $(".wrap-setting-icon span").click(function(){
            $("#list-post-item").slideToggle();
        })
    });
</script>
<style> 
</style>