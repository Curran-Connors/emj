<ul class="dropDown">
    <li class="back"><a href="#">Back</a></li>
	<?php
		// here is the about nav
		// must use php 
		
		// pull data from channel where language 
	
	$query = ee()->db->query("select * from emj_channel_data");
	
	 print_r( $query->result()); 
	
	?>
    {exp:channel:entries 
            channel="menu_items"
            orderby="link_weight"
            sort="asc"
            search:nav_language = "<?php echo $language;?>"
            search:associated_menu = "About Nav"
    }    
 	   <li><a href="{path='{link_path}'}">{title}</a></li>
	{/exp:channel:entries}      
    
</ul>