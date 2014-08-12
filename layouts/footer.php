<footer>
	<div class="container">
    	<div class="col-sm-5 footerWidget widget1">
        	<a class="footerLogo" href="{path=''}"><img src="{site_url}img/footer-logo.png" class="img-responsive"></a>
            
            <p class="credits">&copy; <?php echo date('Y'); ?> Earle M. Jorgensen Company | <a href="{path='site/sitemap'}">Sitemap</a><br />
			<span class="cAndC"><a href="http://curran-connors.com" target="_blank">Website designed & developed by Curran & Connors</a></span></p>
        </div><!-- END footerWidget1 -->
        
        <div class="col-sm-3 footerWidget widget2">
        <!-- corporate headquarters channel call. -->
            {exp:channel:entries 
                        channel="locations" 
                        search:location_headquarters="Yes"
                        limit="1"
             }     
                <p><strong>{location_name}</strong><br>
               {location_address}<br>
               {location_city}, {location_state} {location_zip}<br><br>
                Corporate/General Inquiries<br>
                <strong>{location_phone_1}</strong><br><br>
                
                Sales & Material Requests<br>        
                <strong>{location_phone_2}</strong></p>
            {/exp:channel:entries}      

            
        </div><!-- END footerWidget1 -->
        
        <div class="col-sm-4 footerWidget widget3 last">
        	
        	<div class="col-xs-6 footerMenu">
        	
            	<nav class="footerNav">
                	<ul>
                         {exp:channel:entries 
                            		channel="menu_items"
                                    limit="3"
                                    orderby="link_weight"
                                    sort="asc"
                                    search:link_weight="1|2|3"
                                    search:nav_language = "<?php echo $language;?>"
                                    search:associated_menu = "Footer Menu"
                         }                         	
                         	{if {count} == {total_results}}
                          	  	<li class="last"><a href="{path='{nav_link_path}'}">{title}</a></li>
                            {if:else}
                            	<li><a href="{path='{nav_link_path}'}">{title}</a></li>
                            {/if}
        				{/exp:channel:entries}      
                    </ul>
                </nav><!-- END .nav.footerMenu -->
            
            </div><!-- END footerWidget1 -->
            <div class="col-xs-6 footerMenu last">
                
                <nav class="footerNav">
                	<ul>
                         {exp:channel:entries 
                            		channel="menu_items"
                                    limit="3"
                                    orderby="link_weight"
                                    sort="asc"
                                    search:link_weight="not 1|2|3"
                                    search:nav_language = "<?php echo $language;?>"
                                    search:associated_menu = "Footer Menu"
                         }                         	
                         	{if {count} == {total_results}}
                          	  	<li class="last"><a href="{path='{nav_link_path}'}">{title}</a></li>
                            {if:else}
                            	<li><a href="{path='{nav_link_path}'}">{title}</a></li>
                            {/if}
        				{/exp:channel:entries}    
                    </ul>
                </nav><!-- END .nav.footerMenu -->
            	
            </div><!-- END footerWidget1 -->    
        
         	<div class="clear"></div>
        </div><!-- END footerWidget1 -->
        
        <div class="col-sm-12 footerWidget mobileWidget">
        	<p class="credits">&copy; <?php echo date('Y'); ?> Earle M. Jorgensen Company | <a href="#">Sitemap</a><br />
			<span class="cAndC">Website designed & developed by <a href="http://curran-connors.com" target="_blank">Curran & Connors</a></span></p>
        </div><!-- END .mobileWidget -->
    </div><!-- END .container -->
</footer><!-- END footer -->
