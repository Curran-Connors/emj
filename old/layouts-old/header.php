<div id="top">
    <div class="container">
    	<div class="topWrapper col-sm-12 text-right">
            <nav class="topNav">
                <ul class="list-inline">
                    <li><a href="#">Locations</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Register Now</a></li>
                    <li><a href="#">Blue Book</a></li>
                    <li><a href="#">Quick Reference</a></li>
                    <li>
                        <select>
                            <option class="eng">English</option>
                            <option class="fre">French</option>
                            <option class="kli">Klingon</option>
                        </select>
                    </li>
                    <li>
                        <input type="search" class="searchButton">
                    </li>
                </ul>
            </nav>
        </div><!-- .topWrapper -->
    </div><!-- END .container -->
</div><!-- END #top -->

<header>
	<div class="container">
    	<div class="logo col-sm-3">
        	<a href="#"><img class="img-responsive" src="img/logo.png"></a>
        </div><!-- END .logo -->
        
        <div class="navWrapper col-sm-9 text-right">
        	<nav class="mainNav">
                <ul class="list-inline">
                    <li id="head" class="first <?php nav($L1); ?>">
                    	<a href="about-about-emj.php">About</a>
                    	<ul class="dropDown">
                       	  <li><a href="#">About EMJ</a></li>
                        	<li><a href="#">What We Do</a></li>
                        	<li><a href="#">How We Do It</a></li>
                        	<li><a href="#">Who We Are</a></li>
                        	<li><a href="#">Where We Are</a></li>
                        </ul>
                    </li>
                    <li <?php nav($L2); ?>><a href="#">Products</a></li>
                    <li <?php nav($L3); ?>><a href="#">Processing</a></li>
                    <li <?php nav($L4); ?>><a href="#">Order</a></li>
                    <li class="last <?php nav($L5); ?>"><a href="#">E-Metals&reg; Login</a></li>
                </ul>
            </nav>
        </div><!-- END .logo -->
    </div><!-- END .container -->
</header><!-- END header -->