<?php 

 
header('Content-Type:text/xml'); 

?>
<?php echo '<?' ?>xml version="1.0" encoding="UTF-8"<?php echo '?>' ?><?php echo '<?' ?>xml-stylesheet type="text/xsl" href="<?php echo SITE_URL . '/inc/robots/sitemaps/sitemap.xsl' ?>"<?php echo '?>' ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<?php  
		$last = models_DB::get('SELECT time_update FROM ' . POST_TABLE . ' ORDER BY time_update DESC LIMIT 1'); 
        if(!empty($last))
        {
            ?>
            <sitemap>
        		<loc><?php echo SITE_URL ?>/post-sitemap.xml</loc>
        		<lastmod>
        		<?php
        					
        			 
        			$last = $last[0]['time_update'];
        			
        			$last = date('Y-m-d');
        			echo $last;
        		?>
        		</lastmod>
        	</sitemap>
            <?php
        }
    ?>
	<?php
		
		$last = models_DB::get('SELECT time_update FROM ' . CATEGORY_TABLE .' ORDER BY time_update DESC LIMIT 1'); 
	    if(!empty($last))
        {
            ?>
             <sitemap>
        		<loc><?php echo SITE_URL ?>/category-sitemap.xml</loc>
        		<lastmod>
        			<?php
        			
        			  
        			$last = $last[0]['time_update'];
        			
        			$last = date('Y-m-d', $last);
        			echo $last;
        			
        			 
        			?>
        		</lastmod>
        	</sitemap>
            <?php
        }
    ?>
	
    <?php
		$last = models_DB::get('SELECT time_update FROM ' . TAG_TABLE .' ORDER BY time_update DESC LIMIT 1'); 
		if(!empty($last))
        {
            ?>
             	<sitemap>
            		<loc><?php echo SITE_URL ?>/tag-sitemap.xml</loc>
            		<lastmod>
          			   <?php
            			$last = $last[0]['time_update'];
            			
            			 
            			echo date('Y-m-d', $last);
            			
            			 
            			?>
            		</lastmod>
            	</sitemap>
            <?php
        }	
    ?>

</sitemapindex>

<!-- XML Sitemap generated by Yoast Hoang Cong Vuong -->