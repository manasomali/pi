<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8"/>
	<title>PI - Preço de Indiferença</title>
	<link rel='stylesheet' id='dslc-fontawesome-css'  href='https://gese.florianopolis.ifsc.edu.br/wp-content/plugins/live-composer-page-builder/css/font-awesome.css?ver=1.3.5' type='text/css' media='all' />
	<link rel='stylesheet' id='dslc-main-css-css'  href='https://gese.florianopolis.ifsc.edu.br/wp-content/plugins/live-composer-page-builder/css/frontend/main.css?ver=1.3.5' type='text/css' media='all' />
	<link rel='stylesheet' id='dslc-modules-css-css'  href='https://gese.florianopolis.ifsc.edu.br/wp-content/plugins/live-composer-page-builder/css/frontend/modules.css?ver=1.3.5' type='text/css' media='all' />
	<link rel='stylesheet' id='dslc-plugins-css-css'  href='https://gese.florianopolis.ifsc.edu.br/wp-content/plugins/live-composer-page-builder/css/frontend/plugins.css?ver=1.3.5' type='text/css' media='all' />
	<link rel='stylesheet' id='pirate_forms_front_styles-css'  href='https://gese.florianopolis.ifsc.edu.br/wp-content/plugins/pirate-forms/public/css/front.css?ver=2.1.0' type='text/css' media='all' />
	<link rel='stylesheet' id='zerif_font-css'  href='//fonts.googleapis.com/css?family=Lato%3A300%2C400%2C700%2C400italic%7CMontserrat%3A400%2C700%7CHomemade+Apple&#038;subset=latin%2Clatin-ext' type='text/css' media='all' />
	<link rel='stylesheet' id='zerif_font_all-css'  href='//fonts.googleapis.com/css?family=Open+Sans%3A300%2C300italic%2C400%2C400italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic&#038;subset=latin&#038;ver=4.8.2' type='text/css' media='all' />
	<link rel='stylesheet' id='zerif_bootstrap_style-css'  href='https://gese.florianopolis.ifsc.edu.br/wp-content/themes/zerif-lite/css/bootstrap.css?ver=4.8.2' type='text/css' media='all' />
	<link rel='stylesheet' id='zerif_fontawesome-css'  href='https://gese.florianopolis.ifsc.edu.br/wp-content/themes/zerif-lite/css/font-awesome.min.css?ver=v1' type='text/css' media='all' />
	<link rel='stylesheet' id='zerif_style-css'  href='https://gese.florianopolis.ifsc.edu.br/wp-content/themes/zerif-lite/style.css?ver=v1' type='text/css' media='all' />
	<link rel='stylesheet' id='zerif_responsive_style-css'  href='https://gese.florianopolis.ifsc.edu.br/wp-content/themes/zerif-lite/css/responsive.css?ver=v1' type='text/css' media='all' />


	<link rel="stylesheet" href="css/style.css">

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.12.4.js"></script>
	<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>


<body>

	<header id="home" class="header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
		<div id="main-nav" class="navbar navbar-inverse bs-docs-nav" role="banner">
			<div class="container">
				<div class="navbar-header responsive-logo">
					<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="navbar-brand" itemscope itemtype="http://schema.org/Organization">
						<a href="https://gese.florianopolis.ifsc.edu.br/" class="custom-logo-link" rel="home" itemprop="url"><img width="411" height="205" src="https://gese.florianopolis.ifsc.edu.br/wp-content/uploads/2017/09/cropped-logo_gese.jpg" class="custom-logo" alt="GESE" itemprop="logo" srcset="https://gese.florianopolis.ifsc.edu.br/wp-content/uploads/2017/09/cropped-logo_gese.jpg 411w, https://gese.florianopolis.ifsc.edu.br/wp-content/uploads/2017/09/cropped-logo_gese-300x150.jpg 300w, https://gese.florianopolis.ifsc.edu.br/wp-content/uploads/2017/09/cropped-logo_gese-400x200.jpg 400w" sizes="(max-width: 411px) 100vw, 411px" /></a>
					</div> <!-- /.navbar-brand -->
				</div> <!-- /.navbar-header -->
				<nav class="navbar-collapse bs-navbar-collapse collapse" id="site-navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
					<a class="screen-reader-text skip-link" href="#content">Skip to content</a>
					<ul id="menu-primary-menu" class="nav navbar-nav navbar-right responsive-nav main-nav-list"><li id="menu-item-12" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-12"><a href="https://gese.florianopolis.ifsc.edu.br/">Home</a></li>
						<li id="menu-item-72" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-72"><a href="https://gese.florianopolis.ifsc.edu.br/producoes/">Produções</a></li>
						<li id="menu-item-73" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-73"><a href="https://gese.florianopolis.ifsc.edu.br/projetos/">Projetos</a></li>
						<li id="menu-item-74" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-74"><a href="https://gese.florianopolis.ifsc.edu.br/discentes/">Discentes</a></li>
					</ul>	</nav>
				</div> <!-- /.container -->
			</div> <!-- /#main-nav -->
			<!-- / END TOP BAR -->
			<div class="clear"></div>
		</header>

		<h1 class="vi">Preço de Indiferença</h1>

		<div id="cal" style="overflow: hidden; text-align:center;">

			<?php
			$arqSize = $_FILES['Arquivo']['size'];
			$tamanhoPermitido = 1024 * 500; // 500 Kb
			$arqError = $_FILES['Arquivo']['error'];
			$nome=$_FILES['Arquivo']["name"];
			$tipo=$_FILES['Arquivo']['type'];
			if ($arqError == 0) 
			{
				if ($arqSize > $tamanhoPermitido) 
				{
					echo 'Arquivo muito grande. ';
					?><br/><br><a class="bt" href="index.php">Voltar</a><br/><br/><?php
				}
				else if ($nome != "Consumidor.csv")
				{
					echo "Nome do arquivo invalido ";
					?><br/><br><a class="bt" href="index.php">Voltar</a><br/><br/><?php
				}
				else
				{
					$nome_temporario=$_FILES["Arquivo"]["tmp_name"]; 
					$nome_real=$_FILES["Arquivo"]["name"];
					//copy($nome_temporario,$nome_real);

					if (copy($_FILES['Arquivo']['tmp_name'], 'upload/'.$_FILES["Arquivo"]["name"])) {
						include("calculo.php");
						?><br/><a class="bt" href="index.php">Voltar</a><?php
					} 
					else 
					{
						echo "Failure.\n";
						?><br/><a class="bt" href="index.php">Voltar</a><?php
					}
					//print_r($_FILES);


				
				}
			}
			else
			{
				echo "Erro ";
				?><br/><br><a class="bt" href="index.php">Voltar</a><br/><br/><?php
			}
			?>

	</div>

</body>
</html>
