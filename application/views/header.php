<!DOCTYPE HTML>
<!-- BEGIN html -->
<html lang = "en">
	<!-- BEGIN head -->
	<head>
		<div id="fb-root"></div>
		
		<title>NOVOMAG | Homepage</title>

		<!-- Meta Tags -->
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

		<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

		<!-- Stylesheets -->
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>resources/css/reset.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>resources/css/main-stylesheet.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>resources/css/font-awesome.min.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>resources/css/lightbox.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>resources/css/shortcodes.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>resources/css/custom-fonts.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>resources/css/custom-colors.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>resources/css/responsive.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>resources/css/jquery_popup.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>resources/css/featherlight.min.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>resources/css/featherlight.gallery.min.css" />
		<!--[if lte IE 8]>
		<link type="text/css" rel="stylesheet" href="css/ie-ancient.css" />
		<![endif]-->

		
		<script type="text/javascript" src="<?php echo base_url(); ?>resources/jscript/nicEdit-latest.js"></script> <script type="text/javascript">

		//<![CDATA[
		  bkLib.onDomLoaded(function() {
		        new nicEditor({maxHeight : 200}).panelInstance('content_area');
		  });
		  //]]>
		</script>
		<script src="<?php echo base_url(); ?>resources/jscript/jquery-latest.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>resources/jscript/featherlight.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>resources/jscript/featherlight.gallery.min.js"></script>

	<!-- END head -->
	</head>

	<!-- BEGIN body -->
	<body>

		<!-- BEGIN .boxed -->
		<div class="boxed active">
			
			<!-- BEGIN .header -->
			<header class="header">

				<div class="header-topmenu">
					
					<!-- BEGIN .wrapper -->
					<div class="wrapper">

						<ul class="le-first">
							<li><a href="#"><i class="fa fa-facebook-official"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
							<li><a href="#"><i class="fa fa-youtube-square"></i></a></li>
							<li><a href="#"><i class="fa fa-rss-square"></i></a></li>
						</ul>

						<?php if(!$user) { ?>
							<div class="login-register">
								<span><a class="login-btn">Logheaza-te</a></span>
								<span><a class="register-btn">Inregistreaza-te</a></span>
							</div>
						<?php } else { ?>
							<div class="top-user-details">
							<span><img src="<?php echo base_url(); ?>resources/images/avatars/thumbnails/<?php echo ($getUser->avatar); ?>" alt="<?php echo $user['name']; ?>" /></span>
							<span class="hello-user">
								Salut <?php echo $user['name']; ?>! | 
								<a href="#" data-id="<?php echo $user['id']; ?>" class="user-id">&nbsp;Profilul meu</a> |
								<?php if($user['class'] >= 80) : ?>
								 	<a href="#" class="controlpanel-link">&nbsp;Control Panel</a> |
							 	<?php endif; ?>
								<a href="<?php echo base_url(); ?>logout">&nbsp;Iesire</a>
							</span>
							</div>
						<?php } ?>
						
					<!-- END .wrapper -->
					</div>

				</div>
				
				<!-- BEGIN .wrapper -->
				<div class="wrapper">
					
					<div class="header-block">
						<div class="header-logo">
							<a href="<?php echo site_url(''); ?>"><img src="<?php echo base_url(); ?>resources/images/header-logo.png" alt="" /></a>
							<!-- <h1><a href="index.html">NOVOMag</a></h1> -->
						</div>
						<div class="header-banner">
							<a href="#" target="_blank"><img src="<?php echo base_url(); ?>resources/images/no-banner-728x90.jpg" alt="" /></a>
						</div>
					</div>
					
				<!-- END .wrapper -->
				</div>


				<nav class="main-menu">
					
					<!-- BEGIN .wrapper -->
					<div class="wrapper">
						
						<ul class="menu">
							<li><a href="<?php echo site_url(''); ?>">Pagina Principala</a></li>
							<li><a href="<?php echo site_url('noutati/pag/1'); ?>">Noutati</a></li>
							<li><a href="<?php echo site_url('fanpage'); ?>">Fan Club</a></li>
							<li><a href="<?php echo site_url('echipa'); ?>">Echipa</a></li>
							<li><a href="<?php echo site_url('sezon1415'); ?>">Sezon 2014/2015</a></li>
							<li><a href="<?php echo site_url('exclusiv'); ?>">Exclusiv</a></li>
							<li><a href="<?php echo site_url('munich'); ?>">6 Feb 1958</a></li>
						</ul>

						<div class="search-block">
							<form action="blog.html">
								<input type="text" class="search-value" value="" />
								<input type="submit" class="search-button" value="&#xf002;" />
							</form>
						</div>

					<!-- END .wrapper -->
					</div>

				</nav>
				
			<!-- END .header -->
			</header>
			
			<!-- BEGIN .content -->
			<section class="content has-sidebar">
				
				<!-- BEGIN .wrapper -->
				<div class="wrapper">

					<!-- BEGIN .breaking-news -->
					<div class="breaking-news">
						<div class="breaking-title">
							<h3>Breaking News</h3>
							<i></i>
						</div>
						<div class="breaking-block">
							<marquee behavior="scroll" direction="left" scrollamount="3">
								<ul>
									<li><h4><a href="post.html">Albucius moderatius contentiones pri in, ei tota brute eam</a></h4><i class="fa fa-exclamation"></i></li>
									<li><h4><a href="post.html">Albucius moderatius contentiones pri in, ei tota brute eam</a></h4><i class="fa fa-exclamation"></i></li>
									<li><h4><a href="post.html">Albucius moderatius contentiones pri in, ei tota brute eam</a></h4><i class="fa fa-exclamation"></i></li>
								</ul>
							</marquee>
						</div>
					<!-- END .breaking-news -->
					</div>

				<!-- END .wrapper -->
				</div>

				<div class="my-profile-block">
					<div class="my-profile">
						<img src="<?php echo base_url(); ?>resources/images/button_cancel.png" class="close-my-profile"/>
						<a class="a-edit-profile" href="<?php echo base_url(); ?>users/edit_details"><img src="<?php echo base_url(); ?>resources/images/edit_button.png" class="edit-profile" title="Editeaza-ti profilul" /></a>	
						<div class="clear-float"></div>
						<div class="my-profile-avatar">
							<img class="avatar" src="<?php echo base_url(); ?>resources/images/avatars/default-avatar.png" title="nume" />
						</div>
						<h2 class="username">username</h2>
						<table>
							<tr><td class="first-td">Data nasterii:</td><td class="second-td dob">data nasterii</td></tr>
							<tr><td class="first-td">Email:</td><td class="second-td email">email</td></tr>
							<tr><td class="first-td">Locuieste:</td><td class="second-td living">locul de trai</td></tr>
							<tr><td class="first-td">Clasa:</td><td class="second-td userClass">clasa</td></tr>
						</table>
						<div style="height:20px"></div>
					</div>
				</div>

				<div id="logindiv">
					<form class="form" id="login-box" enctype="multipart/form-data" action="<?php echo base_url(); ?>verifylogin" method="post">
					<div class="wrong-psw">
						<div class="wron-psw-text">
							<p>Ati introdus datele gresit. Verificati inca odata datele introduse.</p>
						</div>
					</div>
					<img src="<?php echo base_url(); ?>resources/images/button_cancel.png" class="img" id="cancel-login"/>
					<h3>Logheaza-te</h3>
					<label>Email: <span>*</span></label>
					<input type="text" name="email" id="email" placeholder="office@redevils.md" /><br /><br />
					<label>Parola: <span>*</span></label>
					<input type="password" name="password" id="password" placeholder="********"/>
					<input type="hidden" name="current_url" class="current_url" value="<?php echo current_url(); ?>" />
					<input type="hidden" name="next_submit" class="next_submit" value="" />
					<input type="submit" name="login" id="login" value="Login"/>
					<input type="submit" name="cancel" id="cancel" value="Cancel"/>
					<br/>
					<a href="#" class="psw-recover">--> Am uitat parola</a>
					</form>
				</div>

				<div id="registerdiv">
					<form class="form" id="register-box" action="" method="post">
					<img src="<?php echo base_url(); ?>resources/images/button_cancel.png" class="img" id="cancel-register"/>
					<h3>Inregistreaza-te</h3>
					<label>Nume, Prenume: <span>*</span></label>
					<input type="text" name="name" id="name" placeholder="Grigore Dodon" value=""/>
					<label>Email: <span>*</span></label>
					<input type="text" name="email" id="email-user" placeholder="dodon_grig@yahoo.com" value=""/>
					<label>Parola: <span>*</span></label>
					<input type="password" name="password" id="password-user" placeholder="********" value=""/>
					<label>Repeta parola: <span>*</span></label>
					<input type="password" name="re-password" id="re-password-user" placeholder="********" value=""/>
					<label>Data nasterii: <span>*</span></label>
					<input type="text" name="dob" id="dob-user" placeholder="14.10.1994" value=""/><br /><br />
					<input type="checkbox" name="unitedfan" id="unitedfan" value="1"/> Sunt fan Manchester United<br />
					<input type="checkbox" name="rules" id="rules-user" value="1"/> Am citit <a href="<?php echo site_url('faq'); ?>" style="vertical-align: top; color: red;">regulile de utilizare</a><br />
					<input type="hidden" name="current_url" value="<?php echo current_url(); ?>" />
					<input type="submit" id="send" name="submit_registration" value="Send"/>
					<input type="submit" id="cancel-register" value="Cancel"/>
					<br/>
					</form>
				</div>

				<div id="success-message">
					<div class="success-message-box">
						<img src="<?php echo base_url(); ?>resources/images/button_cancel.png" class="img" id="cancel-success-msg"/>
						Te-ai inregistrat cu succes.<br />
						Logheaza-te acum pentru mai multe beneficii!
					</div>
				</div>

				<?php if($user['class']>=80) : ?>
					<div id="controlpanel">
						<div class="box">
							<img src="<?php echo base_url(); ?>resources/images/button_cancel.png" class="img" id="close-cp" />
							<div class="cp-btn orarul-meciurilor">Orarul meciurilor</div>
							<div class="cp-btn reset-scor">Reseteaza scorul la meciul curent</div>
							<div class="cp-btn reset-tabel">Reseteaza tabela</div>
							<div class="cp-btn creaza-sondaj">Creeaza un sondaj</div>
						</div>
					</div>

					<div id="fixtures">
						<div class="fx-box">
							<img src="<?php echo base_url(); ?>resources/images/button_cancel.png" class="img" id="close-fixtures" />
							<span class="fx-menu">
							[ <i class="fa fa-plus"></i> <span class="fx-menu-txt">Adauga Meci</span> ]
							</span>
							
							<form class="add-fixture" enctype="multipart/form-data" action="" method="post">
								<table style="width: 800px">
									<tr>
										<td style="width: 213px"><input type="text" name="echipa" placeholder="Echipa Adversara" style="width: 185px" /></td>
										<td style="width: 80px"><input type="text" name="data" placeholder="Data" style="width: 52px" /></td>
										<td style="width: 65px"><input type="text" name="ora" placeholder="Ora" style="width: 37px" /></td>
										<td style="width: 82px"><select name="type"><option value="Home">Home</option><option value="Away">Away</option><option value="Neutral">Neutral</option></select></td>
										<td style="width: 180px"><input type="text" name="cupa" placeholder="Campionatul" style="width: 152px" /></td>
										<td><input type="submit" name="submit_fixture" value="Adaugă" /></td>								
									</tr>
								</table>
							</form>

							<table>
								<tr>
									<th>Nr.</th>
									<th>Echipa adversara</th>
									<th>Data</th>
									<th>Ora</th>
									<th>Scor</th>
									<th>Locatie</th>
									<th>Campionatul</th>
									<th>Sterge</th>
								</tr>
								<?php foreach($fixtures as $key => $fixture) : ?>
									<tr class="fixt-tr" data-id="<?php echo $fixture->id; ?>">
										<td><?php echo $key=$key+1; ?></td>
										<td class="fxt-play-with"><?php echo $fixture->play_with; ?></td>
										<td class="fxt-date"><?php echo $fixture->date; ?></td>
										<td class="fxt-hr"><?php echo $fixture->hour; ?></td>
										<td class="fxt-scor"><?php echo $fixture->scor; ?></td>
										<td class="fxt-type"><?php echo $fixture->type; ?></td>
										<td class="fxt-cup"><?php echo $fixture->cup; ?></td>
										<td></td>
									</tr>
								<?php endforeach; ?>
							</table>
						</div>
					</div>
				<?php endif; ?>


