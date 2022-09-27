<?php
class models_HandleAction extends models_query
{
    public static function delete_post($post_id, $post_type_id)
    {
        
        $suffix = $post_type_id . URL_SUFFIX_SEPARATE . $post_id;
        
        /**
         * Xoa trong bang post type
         */
        $query_string = 'DELETE FROM '. POST_TYPE_TABLE . '_' . $post_type_id . ' WHERE id = ' . $post_id;
        $result1 = self::query_string($query_string);
        
        if($result1)
        {
            /**
             * Xoa trong bang all post
             */      
            $query_string = 'DELETE FROM all_post WHERE suffix=\''. $suffix .'\'';
            $result2 = self::query_string($query_string);
            return '1';
        }
         
        
        else return '0';
    }
    
    public static function delete_term($term_id)
    {
        $query_string = 'DELETE FROM ' . TERM_TABLE . ' WHERE id = ' . $term_id;
        $result1 = self::query_string($query_string);
        
        //echo $query_string;
        
        //$query_string = 'DELETE FROM all_post WHERE term_id = ' . $term_id;
        //$result2 = self::query_string($query_string);
        return  $result1;
    }
    
    public static function delete_block_area($block_area_id)
    {
        $query_string = 'DELETE FROM ' . BLOCK_AREA_TABLE . ' WHERE id = ' . $block_area_id;
        return  self::query_string($query_string);
    }
    
    
}