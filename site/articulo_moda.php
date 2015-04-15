
<?php

//acceso a la base de datos
include_once("../cms/articles.php");

$db = openconn();
$data = new dataRecovery($db);
$data->setCategory("La moda que no incomoda");
//$data->setArticle(0);
//$data->article->writeTitle();
//closeconn($db);



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<title>Inez Inez</title>

<!-- Fonts -->
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Abril+Fatface" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Quicksand" />

<!-- Stylesheets -->
<link rel='stylesheet' href='css/site/flexslider.css' type='text/css' media='all' />
<link rel='stylesheet' href='css/site/jquery.fancybox-1.3.4.css' type='text/css' media='all' />
<link rel='stylesheet' href='css/site/style.css' type='text/css' media='all' />
<link rel='stylesheet' href='css/site/epicslider.css' type='text/css' media='all' />
<link rel='stylesheet' href='css/site/udt_shortcodes.css' type='text/css' media='all' />
<link rel='stylesheet' href='css/site/skin.css' type='text/css' media='all' />
<link rel='stylesheet' href='css/site/udt_media_queries.css' type='text/css' media='all' />
<link rel='stylesheet' href='css/arctext/style.css' type='text/css' media='all' />
<link rel='stylesheet' href='css/arctext/demo.css' type='text/css' media='all' />

<script type='text/javascript' src='js/site/jquery-1.11.0.min.js'></script>
<script type='text/javascript' src='js/site/jquery-migrate-1.2.1.min.js'></script>
    
<script type='text/javascript' src="js/sliders/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/sliders/jssor.js"></script>
<script type="text/javascript" src="js/sliders/jssor.slider.js"></script>
<script type="text/javascript" src="js/arctext/jquery.arctext.js"></script>

<script type="text/javascript">
	jQuery('head').append('<style>#wrapper, #footer{display:none;}</style>');
    jQuery(window).resize(function() {
        // This will execute whenever the window is resized
        var h = jQuery(window).height();
        var w = jQuery(window).width();
        var aspect = w/h;
        aspect = aspect * 70 * 0.5;
        jQuery('div.s1-caption').css({"top": aspect + "%"});
    });
    
</script>
    

</head>
<body class="home page">
    
<!-- Start Wrapper -->
<div id="wrapper">

	<!-- Start Header -->
	<div class="header header-main">
		<div class="inner">

			<!-- Logo -->
			<div class="logo-container">
				<div class="logo">
					<a class="navigateTo" href="index.html" >
						<img src="resources/Layout/puerco_header-07.png" />
					</a>
				</div>
			</div>

			<!-- MobileMenu Toggle -->
			<div class="mobileMenuToggle"><a href=""></a></div>

			<!-- Navigation -->
			<div class="menu">
				<ul id="menu-main-menu" class="menu">
                    <li class="menu-item current-menu-item current_page_item menu-item-home">
                    
                    </li>
					<li class="menu-item current-menu-item current_page_item menu-item-home"><a href="index.html#s0"><span style="color:black">LA MODA <br/>QUE NO<br/>INCOMODA</span></a></li>
                    <li class="menu-item current-menu-item current_page_item menu-item-home"><a href="index.html#s1"><span style="color:black">ARTY<br/>PARTY</span></a></li>
                    <li class="menu-item current-menu-item current_page_item menu-item-home"><a href="index.html#s2"><span style="color:black">YUMMY<br/>MUMMY</span></a></li>
                    <li class="menu-item current-menu-item current_page_item menu-item-home"><a href="index.html#s3"><span style="color:black">EL RINCÒN <br/>DE INEZ</span></a></li>
					
				</ul>
			</div>

		</div>
	</div>
	<!-- End Header -->

	
<div id="s" class="section odd">
    <div class="content clearfix">
        <center>
	   <div class="" style="position: relative; top: 0px; left: 0px; overflow: visible; width: 510px; height: 432px; display: block; background: url(http://blog-inez.u-bik.com/Desarrollo/home/resources/Layout/marco_cuadrado.png) no-repeat;">
           <span style="display: inline-block;
    height: 100%;
    vertical-align: middle;"></span> 
           <img style="vertical-align: middle;" src="resources/img/sonrisa.jpeg" />
        </div>
        </center>
        <div style="margin-top:2%" class="text_moda">
        <center><div class="inez-text">Loren ipsum</div></center>
                <br/>
                <div class="column_one_half_moda inez-text">
                Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. 
                    Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, 
                    cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una 
                    galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. 
                    No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos 
                    electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con 
                    la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más 
                    recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual 
                    incluye versiones de Lorem Ipsum.
                </div>
                <div class="column_one_half_moda inez-text">
                
                Es un hecho establecido hace demasiado tiempo que un lector se distraerá con el contenido 
                    del texto de un sitio mientras que mira su diseño. El punto de usar Lorem Ipsum es que
                    tiene una distribución más o menos normal de las letras, al contrario de usar textos 
                    como por ejemplo "Contenido aquí, contenido aquí". Estos textos hacen parecerlo un español
                    que se puede leer. Muchos paquetes de autoedición y editores de páginas web usan el Lorem
                    Ipsum como su texto por defecto, y al hacer una búsqueda de "Lorem Ipsum" va a dar por 
                    resultado muchos sitios web que usan este texto si se encuentran en estado de desarrollo. 
                    Muchas versiones han evolucionado a través de los años, algunas veces por accidente, otras 
                    veces a propósito (por ejemplo insertándole humor y cosas por el estilo).
                </div>
        </div>
    </div>
</div>
    
    

	<div class="clear" style="height:300px;"></div>

</div>        
<!--end wrapper--> 

<!--start footer-->
<div id="footer">
	
</div>

<!--end footer-->

<!-- Scripts -->
<!--<script type='text/javascript' src='js/site/jquery-ui-1.9.0.custom.min.js'></script>-->
<script type='text/javascript' src='js/site/jquery.mobile-touch-swipe-1.0.js'></script>
<script type='text/javascript' src='js/site/iOS-timer.js'></script>
<script type='text/javascript' src='js/site/jquery.easing.1.3.js'></script>
<script type='text/javascript' src='js/site/jquery.epicslider.js'></script>
<script type='text/javascript' src='js/site/jquery.flexslider-min-edited.js'></script>
<script type='text/javascript' src='js/site/waypoints.min.js'></script>
<script type='text/javascript' src='js/site/jquery.parallax-1.1.3.js'></script>
<!--<script type='text/javascript' src='js/site/jquery.ajaxloading.js'></script>-->
<script type='text/javascript' src='js/site/is-mobile.js'></script>
<script type='text/javascript' src='js/site/settings.js'></script>
<script type='text/javascript' src='js/site/onepage.js'></script>
<script type='text/javascript' src='js/site/jquery.fancybox-1.3.4.js'></script>
<script type='text/javascript' src='js/site/jquery.metadata.js'></script>
<!--<script type='text/javascript' src='js/site/common.js'></script>-->
<script type='text/javascript' src='js/site/udt_shortcodes.js'></script>
<script type='text/javascript' src='js/site/contact.js'></script>
<script type='text/javascript' src='http://maps.googleapis.com/maps/api/js?sensor=false'></script>
    

</body>
</html>