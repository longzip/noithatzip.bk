<?php
	/**
 * Default fields
 */
$title_attribute = array('field_name' => 'title', 'field_title'=>'Tiêu đề', 'require'=>1, 'maxlenght'=>255, 'description'=>'');
$default_fields['title'] = array('attribute' => serialize($title_attribute), 'field_type'=>'text');

$title_attribute = array('field_name' => 'url', 'field_title'=>'Url', 'require'=>0, 'maxlenght'=>255, 'description'=>'');
$default_fields['url'] = array('attribute' => serialize($title_attribute), 'field_type'=>'text');


$title_attribute = array('field_name' => 'content', 'field_title'=>'Nội dung', 'require'=>0, 'maxlenght'=>'-1', 'description'=>'');
$default_fields['content'] = array('attribute' => serialize($title_attribute), 'field_type'=>'Html');


$title_attribute = array('field_name' => 'term', 'field_title'=>'Chủ đề', 'require'=>1, 'maxlenght'=>255, 'description'=>'');
$default_fields['term'] = array('attribute' => serialize($title_attribute), 'field_type'=>'term');

$title_attribute = array('field_name' => 'image', 'field_title'=>'Ảnh đại diện', 'require'=>1, 'maxlenght'=>'-1', 'description'=>'');
$default_fields['image'] = array('attribute' => serialize($title_attribute), 'field_type'=>'image');


$title_attribute = array('field_name' => 'description', 'field_title'=>'Miêu tả', 'require'=>0, 'maxlenght'=>255, 'description'=>'');
$default_fields['description'] = array('attribute' => serialize($title_attribute), 'field_type'=>'textarea');

$title_attribute = array('field_name' => 'seo_title', 'field_title'=>'Tiêu đề SEO', 'require'=>0, 'maxlenght'=>255, 'description'=>'');
$default_fields['seo_title'] = array('attribute' => serialize($title_attribute), 'field_type'=>'textarea');

$title_attribute = array('field_name' => 'seo_description', 'field_title'=>'Miêu tả SEO', 'require'=>0, 'maxlenght'=>255, 'description'=>'');
$default_fields['seo_description'] = array('attribute' => serialize($title_attribute), 'field_type'=>'textarea');

