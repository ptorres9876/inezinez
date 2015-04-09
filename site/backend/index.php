<!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="css/kickstart.css" media="all" />
<link rel="stylesheet" type="text/css" href="style.css" media="all" /> 
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/kickstart.js"></script>
<!-- KICKSTART -->
    
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>Home</title>
		<meta name="description" content="Item Transition Inspiration | Demo 2: Full Width" />
		<meta name="keywords" content="item transition, css animation, inspiration, web design, demo" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/fxfullwidth.css" />
		<script src="js/modernizr.custom.js"></script>
</head>

<body>
<div class="container demo-2">
    <header class="codrops-header">
        <h1>Item Transition Inspiration</h1>	
        <nav class="codrops-demos">
            <a href="index.html">Small Component</a>
            <a class="current-demo" href="index2.html">Full Width</a>
            <a href="index3.html">Transparent</a>
        </nav>
        <div class="custom-select">
            <select id="fxselect" name="fxselect">
                <option value="-1" selected>Choose an effect...</option>
                <option value="fxPressAway">Press away</option>
            </select>
        </div>
    </header>
    <section>
        <div id="component" class="component component-fullwidth">
            <ul class="itemwrap">
                <li class="current"><img src="img/6.jpg" alt="img06"/></li>
                <li><img src="img/7.jpg" alt="img07"/></li>
                <li><img src="img/8.jpg" alt="img08"/></li>
            </ul>
            <nav>
                <a class="prev" href="#">Previous item</a>
                <a class="next" href="#">Next item</a>
            </nav>
        </div>
    </section>
    <section class="dummy">
        
    </section>
</div>
<!-- End container -->
<script src="js/classie.js"></script>
<script src="js/main.js"></script>
</body>

</html>
