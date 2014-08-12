<div id="top">
    <div class="container">
    	<div class="topWrapper col-sm-12 text-right">
            <nav class="topNav">
                <ul class="list-inline">
                       {exp:channel:entries 
                                channel="menu_items"
                                orderby="link_weight"
                                sort="asc"
                                search:nav_language = "<?php echo $language;?>"
                                search:associated_menu = "Mobile Links"
                        }
                            {if link_weight == '3'}
                                <li><a href="{nav_link_path}" target="_blank" >{title}</a>
                            {if:else}   
                                <li><a href="{path='{nav_link_path}'}">{title}</a>
                            {/if}
                       {/exp:channel:entries}  
                    <li>
						<div class="quicklinksNav btn-group btn-input clearfix">
							<button type="button" class="QL_switch btn btn-default dropdown-toggle form-control" data-toggle="dropdown">Quick Reference <span class="caret"></span></button> 
                  			<ul class="dropdown-menu " role="menu">
                                   {exp:channel:entries 
                                            channel="menu_items"
                                            orderby="link_weight"
                                            sort="asc"
                                            search:nav_language = "<?php echo $language;?>"
                                            search:associated_menu = "Quick Reference"
                                    }
                                    	{if link_weight == '3'}
                                            <li><a href="{nav_link_path}" target="_blank" >{title}</a>
                                        {if:else}   
                                            <li><a href="{path='{nav_link_path}'}">{title}</a>
                                        {/if}
                                   {/exp:channel:entries}  
                         	</ul>
                        </div>                    
                    </li>
              
                    <li class="shortSpace">
						<div class="languageNav btn-group btn-input clearfix">
							<button type="button" class="lang_switch btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
								<span class="selected-lan" data-bind="label"><img src="{site_url}images/flag_icons/icon-flag-<?php echo $language; ?>.png" /></span> <span class="caret"></span>
							</button> 
                  			<ul class="dropdown-menu " role="menu">
                            {exp:channel:entries channel="site_languages" search:language_name="not <?php echo $language; ?>"}
                            	{if two_letter_abbreviation == 'en' }
                            		<li id=""><a href="{site_url}" data-language="{title}"><img src="{flag_icon}" /> {title}</a></li>      
                               	{if:else}
                                	<li id=""><a href="{site_url}{two_letter_abbreviation}" data-language="{title}"><img src="{flag_icon}" /> {title}</a></li>      
								{/if}
                            {/exp:channel:entries}                          
                         	</ul>
                        </div>
                    </li>
                    <li class="shortSpace">
                        <input type="search" class="searchButton" value="Search">
                    </li>
                    <li class="contactButton shortSpace">
                        <a href="{path='site/contact'}">Contact Us</a>
                    </li>
                </ul>
            </nav>
        </div><!-- .topWrapper -->
    </div><!-- END .container -->
</div><!-- END #top -->
<header>
	<div class="container">
    	<div class="logo col-sm-3">
        	<a href="{path=''}"><img class="img-responsive" src="{site_url}img/logo.png"></a>
            <div class="mobileNavWrapper">
                <a href="#" id="openMobile"><img class="img-responsive" src="{site_url}img/icon-mobile-menu.png"></a>
                <div class="mobileWrap">
                    <nav class="mobileNav">
                        <ul>
                          
                            {exp:channel:entries 
                            		channel="menu_items"
                                    orderby="link_weight"
                                    sort="asc"
                                    search:nav_language = "<?php echo $language;?>"
                                    search:associated_menu = "Header Menu"
                            }
                                {if link_weight == '1'}
                                    <li id="head" class="first"><a href="#">{title}</a>
                                    	{embed="assets/about_nav" language="<?php echo $language;?>" associated_menu="{associated_menu}"}
                                    </li>
                                {if:elseif link_weight == '5' }
                                    <li class="last"><a href="{nav_link_path}" target="_blank">{title}</a></li>
                                {if:else}
                                    <li class=""><a href="{path='{nav_link_path}'}">{title}</a></li>
                                {/if}
             		       {/exp:channel:entries}      
                        </ul>
                        <input type="search" class="searchButton">
                    </nav>
                    <nav class="mobileSubNavWrap group">
                        <div class="col-xs-6 mobileSubNav">
                            <nav>
                                <ul>
                                    {exp:channel:entries 
                                            channel="menu_items"
                                            orderby="link_weight"
                                            sort="asc"
                                            search:nav_language = "<?php echo $language;?>"
                                            search:associated_menu = "Mobile Links"
                                    }
                                    	{if link_weight == '3'}
                                            <li><a href="{nav_link_path}">{title}</a>
                                        {if:else}   
                                            <li><a href="{path='{nav_link_path}'}">{title}</a>
                                        {/if}
                                   {/exp:channel:entries}                                     
                                </ul>
                            </nav><!-- END .nav.footerMenu -->
                        
                        </div><!-- END mobileSubNav -->
                        
                        <div class="col-xs-6 mobileSubNav last">                    
                           <nav>
                                <ul>
                                    <li>
                                    	<div class="quicklinksNav btn-group btn-input clearfix">
                                            <button type="button" class="QL_switch btn btn-default dropdown-toggle form-control" data-toggle="dropdown">Quick Reference <span class="caret"></span></button> 
                                            <ul class="dropdown-menu " role="menu">
                                               {exp:channel:entries 
                                                        channel="menu_items"
                                                        orderby="link_weight"
                                                        sort="asc"
                                                        search:nav_language = "<?php echo $language;?>"
                                                        search:associated_menu = "Quick Reference"
                                                }
                                                    {if link_weight == '3'}
                                                        <li><a href="{nav_link_path}" target="_blank" >{title}</a>
                                                    {if:else}   
                                                        <li><a href="{path='{nav_link_path}'}">{title}</a>
                                                    {/if}
                                               {/exp:channel:entries}  
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="">
                                        <div class="languageNav btn-group btn-input clearfix">
                                            <button type="button" class="lang_switch btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
                                                <span class="selected-lan" data-bind="label"><img src="{site_url}images/flag_icons/icon-flag-<?php echo $language; ?>.png" /></span> <span class="caret"></span>
                                            </button> 
                                            <ul class="dropdown-menu " role="menu">
                                                {exp:channel:entries channel="site_languages" search:language_name="not <?php echo $language; ?>"}
                                                    {if two_letter_abbreviation == 'en' }
                                                        <li id=""><a href="{site_url}" data-language="{title}"><img src="{flag_icon}" /> {title}</a></li>      
                                                    {if:else}
                                                        <li id=""><a href="{site_url}{two_letter_abbreviation}" data-language="{title}"><img src="{flag_icon}" /> {title}</a></li>      
                                                    {/if}
                                                {/exp:channel:entries}                                            
                                        	</ul>
                                        </div>
                                    </li>
                                    <li class="contactButton last"><a href="{path='site/contact'}">Contact Us</a></li>
                                </ul>
                            </nav><!-- END .nav.footerMenu -->
                            
                        </div><!-- END footerWidget1 -->    
                     </nav><!-- END .mobileSubNavWrap -->
            	</div><!-- END .mobileWrap -->
        	</div><!-- END .mobileNavWrapper -->
        </div><!-- END .logo -->
        <div class="navWrapper col-sm-9 text-right">
        	<nav class="mainNav">
                <ul class="list-inline">
                	{exp:channel:entries 
                            channel="menu_items" 
                            orderby="link_weight" 
                            sort="asc" 
                            search:nav_language = "<?php echo $language;?>"
                            search:associated_menu = "Header Menu"
                    }
                        {if link_weight == '0'}
                            <li id="head" class="first"><a href="{path='{nav_link_path}'}">{title}</a></li>
                        {if:elseif link_weight == '5' }
                            <li class="last"><a href="{nav_link_path}" target="_blank">{title}</a></li>
                        {if:else}
                            <li class=""><a href="{path='{nav_link_path}'}">{title}</a></li>
                        {/if}
                    {/exp:channel:entries}                
            	</ul>
            </nav>
        </div><!-- END .logo -->
    </div><!-- END .container -->
</header><!-- END header -->