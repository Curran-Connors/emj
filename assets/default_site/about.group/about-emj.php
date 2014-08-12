<?php require_once('includes/initialize.php'); ?>
<?php $L1 = TRUE; $A1 = TRUE;?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>About EMJ | EMJ</title>
<meta name="description" content="">

<?php include('layouts/header_assets.php'); ?>
</head>

<body class="<?php echo $body_class; ?>">

<?php preload(array('img/dropdown-arrow-active.png', 'img/dropdown-arrow.png')); ?>

<?php include('layouts/header.php') ?>

<section class="mainContent secondLevel">
	<div class="container">

<?php include('layouts/about_nav.php'); ?>

        <article class="col-sm-12 content">
            
            <div class="col-sm-4 left">
            	<img src="images/reference-book.png" class="img-responsive">
            </div><!-- END .col-sm-3 -->
            
            <div class="col-sm-8 right">
            	<div class="pageTitle">
					<h1>About Earle M. Jorgensen Company</h1>
                </div><!-- END .pageTitle -->
                <h4 class="highlight">Introduction to the About EMJ section. Consectetur adicing elit. Quisque non purus massa, a molestie nisl. Quisque ut sem.</h4>
                <p>In hac habitasse platea dictumst. Vestibulum ac scelerisque mi. Suspendisse a felis at augue euismod dictum. Etiam id lectus erat. Fusce metus nibh, ullamcorper sit amet molestie in, tristique vitae ante. Donec volutpat mattis euismod. Sed laoreet, lectus dignissim laoreet ornare, nibh augue adipiscing augue, vitae placerat tortor sapien at enim. In dapibus est eget sem congue dapibus. Donec at faucibus enim. Morbi non bibendum massa. Quisque sit amet sapien felis, id fermentum lectus.
				<br><br>
				Vestibulum ac scelerisque mi. Suspendisse a felis at augue euismod dictum. Etiam id lectus erat. Fusugue, vitae placerat tortor sapien at enim. In dapibus est eget sem congue dapibus. Donec at faucibus enim. Morbi non bibendum massa. Quisque sit amet sapien felis, id fermentum lectus.</p>
            </div><!-- END .col-sm-3 -->
            
        </article><!-- END article.content -->
        
        <article class="col-sm-12 subContent">
        	<div class="col-sm-3 widget cta">
            	<img src="img/icon-industry.png" class="img-responsive icon">
                <h4>What We Do:</h4>
                <h3>Industries Served</h3>
                <p>We are a metals distribution company, serving many industries and carrying a wide range of products across the country.</p>
                <a href="#">Learn More</a>
            </div><!-- END .col-sm-3 -->
            <div class="col-sm-3 widget cta">
            	<img src="img/icon-advantage.png" class="img-responsive icon">
                <h4>How We Do It:</h4>
                <h3>Our Advantage</h3>
                <p>This is a brief introduction into the advantages of working with EMJ Metals, such as ontime or free, quality, daily deliveries etc..</p>
                <a href="#">Learn More</a>
            </div><!-- END .col-sm-3 -->
            <div class="col-sm-3 widget cta">
            	<img src="img/icon-management.png" class="img-responsive icon">
                <h4>Who We Are:</h4>
                <h3>Management</h3>
                <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in rehenfderit, doloadfsfre aliqussa.</p>
                <a href="#">Learn More</a>
            </div><!-- END .col-sm-3 -->
            <div class="col-sm-3 widget cta last">
            	<img src="img/icon-location.png" class="img-responsive icon">
                <h4>Where We Are:</h4>
                <h3>Locations &amp; Contacts</h3>
                <p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in rehenfderit, doloadfsfre aliqussa.</p>
                <a href="#">Learn More</a>
            </div><!-- END .col-sm-3 -->
        </article><!-- END article.subContent -->
    </div><!-- END .container -->
</section><!-- END section.slider -->

<?php include('layouts/footer.php') ?>

</body>
<?php include('layouts/footer_assets.php'); ?>

<script type="text/javascript">
$(function(){
	
})
</script>
</html>