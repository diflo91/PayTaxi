
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php 
	if (session_status() == PHP_SESSION_NONE) {
		// Démarrer la session si aucune n'est active
		session_start();
	}
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Gentelella Alela! | </title>

	<!-- Bootstrap -->
	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
	<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<!-- bootstrap-wysiwyg -->
	<link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
	<!-- Select2 -->
	<link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
	<!-- Switchery -->
	<link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
	<!-- starrr -->
	<link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
	<!-- bootstrap-daterangepicker -->
	<link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	<link href="css/general.css" rel="stylesheet">
	<script src="js/collaborateur_form.js"></script>
	<script src="js/envoie_formulaire_collaborateur.js"></script>
	<script src="js/extension_cloudfire/crypto-js.min.js"></script>
    <script src="js/extension_cloudfire/forge.min.js"></script>
    <script src="js/extension_cloudfire/jsencrypt.min.js"></script>
	<!-- Custom Theme Style -->
	<link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
					</div>

					<div class="clearfix"></div>

					<!-- menu profile quick info -->
					<div class="profile clearfix">
						<div class="profile_pic">
							<img src="images/img.jpg" alt="..." class="img-circle profile_img">
						</div>
						<div class="profile_info">
							<span>Welcome,</span>
							<h2><?php if (isset($_SESSION["nom_utilisateur"])) { echo $_SESSION["nom_utilisateur"]."-".$_SESSION["prenom_utilisateur"]; } ?></h2>
						</div>
					</div>
					<!-- /menu profile quick info -->

					<br />

					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3>General</h3>
							<ul class="nav side-menu">
								<li><a><i class="fa fa-home"></i> GESTION GENERALE <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="index.php">Dashboard</a></li>
										<li><a href="index2.php">Dashboard2</a></li>
										<li><a href="index3.php">Dashboard3</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-edit"></i> ENREGISTREMENTS <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
									<li><a href="form_add_user.php">Ajouter Utilisateur</a></li>
										<li><a href="form.php">Ajouter collaborateur</a></li>
										<li><a href="form_advanced.php">Advanced Components</a></li>
										<li><a href="form_validation.php">Form Validation</a></li>
										<li><a href="form_wizards.php">Form Wizard</a></li>
										<li><a href="form_upload.php">Form Upload</a></li>
										<li><a href="form_buttons.php">Form Buttons</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="general_elements.php">General Elements</a></li>
										<li><a href="media_gallery.php">Media Gallery</a></li>
										<li><a href="typography.php">Typography</a></li>
										<li><a href="icons.php">Icons</a></li>
										<li><a href="glyphicons.php">Glyphicons</a></li>
										<li><a href="widgets.php">Widgets</a></li>
										<li><a href="invoice.php">Invoice</a></li>
										<li><a href="inbox.php">Inbox</a></li>
										<li><a href="calendar.php">Calendar</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="tables.php">Tables</a></li>
										<li><a href="tables_dynamic.php">Table Dynamic</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="chartjs.php">Chart JS</a></li>
										<li><a href="chartjs2.php">Chart JS2</a></li>
										<li><a href="morisjs.php">Moris JS</a></li>
										<li><a href="echarts.php">ECharts</a></li>
										<li><a href="other_charts.php">Other Charts</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="fixed_sidebar.php">Fixed Sidebar</a></li>
										<li><a href="fixed_footer.php">Fixed Footer</a></li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="menu_section">
							<h3>Live On</h3>
							<ul class="nav side-menu">
								<li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="e_commerce.php">E-commerce</a></li>
										<li><a href="projects.php">Projects</a></li>
										<li><a href="project_detail.php">Project Detail</a></li>
										<li><a href="contacts.php">Contacts</a></li>
										<li><a href="profile.php">Profile</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="page_403.php">403 Error</a></li>
										<li><a href="page_404.php">404 Error</a></li>
										<li><a href="page_500.php">500 Error</a></li>
										<li><a href="plain_page.php">Plain Page</a></li>
										<li><a href="login.php">Login Page</a></li>
										<li><a href="pricing_tables.php">Pricing Tables</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="#level1_1">Level One</a>
										<li><a>Level One<span class="fa fa-chevron-down"></span></a>
											<ul class="nav child_menu">
												<li class="sub_menu"><a href="level2.php">Level Two</a>
												</li>
												<li><a href="#level2_1">Level Two</a>
												</li>
												<li><a href="#level2_2">Level Two</a>
												</li>
											</ul>
										</li>
										<li><a href="#level1_2">Level One</a>
										</li>
									</ul>
								</li>
								<li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li>
							</ul>
						</div>

					</div>
					<!-- /sidebar menu -->

					<!-- /menu footer buttons -->
					<div class="sidebar-footer hidden-small">
						<a data-toggle="tooltip" data-placement="top" title="Settings">
							<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="FullScreen">
							<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Lock">
							<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Logout" href="login.php">
							<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
						</a>
					</div>
					<!-- /menu footer buttons -->
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
					</div>
					<nav class="nav navbar-nav">
						<ul class=" navbar-right">
							<li class="nav-item dropdown open" style="padding-left: 15px;">
								<a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
									<img src="images/img.jpg" alt=""><?php if (isset($_SESSION["nom_utilisateur"])) { echo $_SESSION["nom_utilisateur"]."-".$_SESSION["prenom_utilisateur"]; } ?>
								</a>
								<div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="javascript:;"> Profile</a>
									<a class="dropdown-item" href="javascript:;">
										<span class="badge bg-red pull-right">50%</span>
										<span>Settings</span>
									</a>
									<a class="dropdown-item" href="javascript:;">Help</a>
									<a class="dropdown-item" href="login.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
								</div>
							</li>

							<li role="presentation" class="nav-item dropdown open">
								<a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
									<i class="fa fa-envelope-o"></i>
									<span class="badge bg-green">6</span>
								</a>
								<ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
									<li class="nav-item">
										<a class="dropdown-item">
											<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
											<span>
												<span><?php if (isset($_SESSION["nom_utilisateur"])) { echo $_SESSION["nom_utilisateur"]."-".$_SESSION["prenom_utilisateur"]; } ?></span>
												<span class="time">3 mins ago</span>
											</span>
											<span class="message">
												Film festivals used to be do-or-die moments for movie makers. They were where...
											</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="dropdown-item">
											<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
											<span>
												<span><?php if (isset($_SESSION["nom_utilisateur"])) { echo $_SESSION["nom_utilisateur"]."-".$_SESSION["prenom_utilisateur"]; } ?></span>
												<span class="time">3 mins ago</span>
											</span>
											<span class="message">
												Film festivals used to be do-or-die moments for movie makers. They were where...
											</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="dropdown-item">
											<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
											<span>
												<span><?php if (isset($_SESSION["nom_utilisateur"])) { echo $_SESSION["nom_utilisateur"]."-".$_SESSION["prenom_utilisateur"]; } ?></span>
												<span class="time">3 mins ago</span>
											</span>
											<span class="message">
												Film festivals used to be do-or-die moments for movie makers. They were where...
											</span>
										</a>
									</li>
									<li class="nav-item">
										<a class="dropdown-item">
											<span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
											<span>
												<span><?php if (isset($_SESSION["nom_utilisateur"])) { echo $_SESSION["nom_utilisateur"]."-".$_SESSION["prenom_utilisateur"]; } ?></span>
												<span class="time">3 mins ago</span>
											</span>
											<span class="message">
												Film festivals used to be do-or-die moments for movie makers. They were where...
											</span>
										</a>
									</li>
									<li class="nav-item">
										<div class="text-center">
											<a class="dropdown-item">
												<strong>See All Alerts</strong>
												<i class="fa fa-angle-right"></i>
											</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>INFORMATION DE LA PERSONNE</h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5  form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Recherch...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div id="x_panel_refresh" class="x_panel">
								<div class="x_title">
									<h2 class="vert_titre">Identité<small></small></h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a class="dropdown-item" href="#">Settings 1</a>
												</li>
												<li><a class="dropdown-item" href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />


						



										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="nom">Nom <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="nom" required="required" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="prenom">Postnom <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="postnom" name="postnom" required="required" class="form-control">
											</div>
										</div>
										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Prénom <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="prenom" class="form-control" type="text" name="prenom">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Sexe *</label>
											<div class="col-md-1 col-sm-1 ">
											
												<select type="text" id="sexe" name="sexe" required="required" class="form-control ">
                                                    <option value="homme">Homme</option>
													<option value="femme">Femme</option>
												</select>
											
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Date de Naissance <span class="required">*</span>
											</label>
											<div class="col-md-2 col-sm-6 ">
												<input id="datedenaissance" name="datedenaissance" class="date-picker form-control" placeholder="Date de naissance"  required="required" type="date" >
												
											</div>
										</div>


										<h2 class="vert_titre">Contact<small></small></h2>
										<div class="ln_solid"></div>



										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="nom"><E-mail></E-mail> <span class="required">E-mail *</span>
											</label>
											<div class="col-md-2 col-sm-6 ">
												<input  type="text" id="email" name="email" required="required" class="form-control " autocomplete ="off">
											</div>
											<div class="repeat_email">
                                            @
                                            </div>
											<div class="col-md-2 col-sm-1 ">
											
												<select onchange="exist_email()" type="text" id="provider" name="provider" required="required" class="form-control ">
												    <option value=""></option>
                                                    <option value="gmail.com">gmail.com</option>
													<option value="yahoo.com">yahoo.com</option>
													<option value="yahoo.fr">yahoo.fr</option>
													<option value="gmx.fr">gmx.fr</option>
												</select>
											
											</div>
											<div class="repeat_email"><i onclick="exist_email()" class="fa fa-repeat"></i></div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="prenom">Téléphone <span class="required">*</span>
											</label>
											<div class="col-md-2 col-sm-6 ">
												<input onchange="exist_telephone()" type="text" id="telephone" name="telephone" required="required" class="form-control">
											</div>
										</div>

										<h2 class="vert_titre">Adresse<small></small></h2>
										<div class="ln_solid"></div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Avenue *</label>
											<div class="col-md-3 col-sm-6 ">
												<input id="avenue" class="form-control" type="text" name="avenue" required="required">
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Numero *</label>
											<div class="col-md-1 col-sm-6 ">
												<input id="numero" class="form-control" type="text" name="numero" required="required">
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Quartier *</label>
											<div class="col-md-3 col-sm-6 ">
												<input id="quartier" class="form-control" type="text" name="quartier" required="required">
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Commune *</label>
											<div class="col-md-3 col-sm-6 ">
												<input id="commune" class="form-control" type="text" name="commune" required="required">
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Ville *</label>
											<div class="col-md-3 col-sm-6 ">
												<input id="ville" class="form-control" type="text" name="ville" required="required">
											</div>
										</div>

										<div class="item form-group">
											<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Province *</label>
											<div class="col-md-3 col-sm-6 ">
												<input id="province" class="form-control" type="text" name="province" required="required">
											</div>
										</div>

   <br>
										<h2 class="vert_titre">Coordonées <small class="vert_titre">bancaire ( mobile money )</small></h2>
										<div class="ln_solid"></div>



                         <div class="centrer"> 


<div class="div_logo_pay">
	<img src="images/orange-money-logo.png" class="surround_logo_pay">
	<img src="images/M-pesa-logo.png" class="surround_logo_pay">
	<img src="images/airtel-money-logo.png" class="surround_logo_pay">
	

</div>


						<div class="col-md-7 ">
							<div class="x_panel " >
								<div class="x_content couleur">
									<br />
									
										<div class="col-md-6 col-sm-6  form-group has-feedback">
											<input type="text" class="form-control has-feedback-left" id="nom_pay" name="nom_pay" placeholder="Nom">
											<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
										</div>

										<div class="col-md-6 col-sm-6  form-group has-feedback">
											<input type="text" class="form-control" id="prenom_pay" name="prenom_pay" placeholder="Prénom">
											<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
										</div>

										<div class="col-md-6 col-sm-6  form-group has-feedback">
											<input type="email" class="form-control has-feedback-left" id="email_pay" name="email_pay" placeholder="Email">
											<span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
										</div>

										<div class="col-md-6 col-sm-6  form-group has-feedback">
											<input type="tel" class="form-control" id="phone_pay" name="phone_pay" placeholder="Phone">
											<span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
										</div>

										<div class=" row">
											<label class="col-form-label col-md-1 col-sm-2 "></label>
											<div class="col-md-1 col-sm-1 ">
												
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-form-label col-md-3 col-sm-3 ">Mobile money *</label>
											<div class="col-md-9 col-sm-9 ">
											   <select  id="provider_pay" name="provider_pay"  required="required" class="form-control">
											        <option value=""></option>
											        <option value="airtel">Airtel</option>
                                                    <option value="orange money">Orange money</option>
                                                    <option value="mpesa">M-pesa</option>
                                               </select>

											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-md-3 col-sm-3 ">Compte d'utilisation * </label>
											<div class="col-md-9 col-sm-9 ">
												<input onchange="exist_compte_utilisation()" type="text" id="compte_utilisation_pay" class="form-control"  name="compte_utilisation_pay" placeholder="Compte d'utilisation">
											</div>
										</div>
										
										
								</div>
							
</div>  


<br>
                                                 <div class="">
													<label>
														<input onchange="toggleButton_proprietaire_compte()" id="toggleButton_2" type="checkbox" class="js-switch" />&nbsp; * Vous êtes le proprietaire du compte d'utilisation ? 
													</label>
												</div> 

                                                  
<br>

										<div class="item form-group">
									
										<div class="ln_solid">e</div>
										
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button onclick="getLineNumber()" class="btn btn-danger" type="button">Annuler</button>
										
												<button onclick="openPopup()" class="btn btn-success" disabled id="btnEnregistrer">Enregistrer</button>
											</div>
										</div>

								
										
                                       <?php
										 if (isset($_SESSION['notification_db_connexion'])) {
											 echo "" . $_SESSION['notification_db_connexion'];
											           $_SESSION['notification_db_connexion'] = "";
										 }
										 if (isset($_SESSION['notification_db_connexion_collab'])) {
											echo "" . $_SESSION['notification_db_connexion_collab'];
													  $_SESSION['notification_db_connexion_collab'] = "";
										}
										if (isset($_SESSION['notification_db_connexion_valider'])) {
											echo "" . $_SESSION['notification_db_connexion_valider'];
													  $_SESSION['notification_db_connexion_valider'] = "";
										}
										if (isset($_SESSION['notification_db_connexion_valider_2'])) {
											echo "" . $_SESSION['notification_db_connexion_valider_2'];
													  $_SESSION['notification_db_connexion_valider_2'] = "";
										}
										if (isset($_SESSION['notification_db_connexion_valider_3'])) {
											echo "" . $_SESSION['notification_db_connexion_valider_3'];
													  $_SESSION['notification_db_connexion_valider_3'] = "";
										}
										if (isset($_SESSION['notification_db_connexion_erreur_1'])) {
											echo "" . $_SESSION['notification_db_connexion_erreur_1'];
													  $_SESSION['notification_db_connexion_erreur_1'] = "";
										}
										if (isset($_SESSION['notification_db_connexion_erreur_2'])) {
											echo "" . $_SESSION['notification_db_connexion_erreur_2'];
													  $_SESSION['notification_db_connexion_erreur_2'] = "";
										}
										if (isset($_SESSION['notification_db_connexion_erreur_3'])) {
											echo "" . $_SESSION['notification_db_connexion_erruer_3'];
													  $_SESSION['notification_db_connexion_erreur_3'] = "";
										}
										if (isset($_SESSION['notification_db_connexion_erreur_4'])) {
											echo "" . $_SESSION['notification_db_connexion_erreur_4'];
													  $_SESSION['notification_db_connexion_erreur_4'] = "";
										}
										if (isset($_SESSION['notification_db_connexion_erreur_5'])) {
											echo "" . $_SESSION['notification_db_connexion_erreur_5'];
													  $_SESSION['notification_db_connexion_erreur_5'] = "";
										}
										if (isset($_SESSION['notification_db_connexion_erreyr_6'])) {
											echo "" . $_SESSION['notification_db_connexion_erreur_6'];
													  $_SESSION['notification_db_connexion_erreur_6'] = "";
										}
										if (isset($_SESSION['notification_db_connexion_erreyr_7'])) {
											echo "" . $_SESSION['notification_db_connexion_erreur_7'];
													  $_SESSION['notification_db_connexion_erreur_7'] = "";
										}


									$_SESSION['net_activity'] ="Net activity.";
									require_once("server/net_activity.php");

                                      ?>
									  

								</div>
							
						





<!-- div popup secure--->

<div id="popup-sec" class="popup-sec">
<div class="popup-content-sec">
    <span id="close-sec" class="close-sec" onclick="closeBtn()">&times;</span>

<div class="body">
    <h1>Charte de Protection des Données Personnelles et de Confidentialité</h1>
    
    <h2>1. Introduction</h2>
    <p>La présente Charte de Protection des Données Personnelles et de Confidentialité ("la Charte") énonce les engagements de [Votre entreprise] ("la Société") envers ses clients en matière de protection des données personnelles et de confidentialité. Cette Charte s'applique à toutes les données personnelles collectées, traitées et stockées dans le cadre de nos relations commerciales avec nos clients.</p>

    <h2>2. Cryptage des Données Sensibles</h2>
    <p>La Société s'engage à crypter toutes les données à caractère sensible fournies par ses clients dans son système informatique. Ce cryptage vise à assurer que les données sensibles demeurent illisibles pour toute personne non autorisée.</p>

    <h2>3. Accès Restreint</h2>
    <p>La Société mettra en place des mesures de contrôle d'accès strictes afin de limiter l'accès aux données personnelles de ses clients uniquement aux employés nécessitant ces informations dans le cadre de leurs fonctions professionnelles.</p>

    <h2>4. Confidentialité Absolue</h2>
    <p>La Société s'engage à traiter les données personnelles de ses clients avec la plus grande confidentialité. Aucune information ne sera partagée, vendue ou divulguée à des tiers sans le consentement explicite du client, sauf si cela est requis par la loi.</p>

    <h2>5. Sécurité Informatique</h2>
    <p>La Société maintiendra son système informatique sécurisé en mettant en œuvre des technologies de pointe et en suivant les meilleures pratiques de sécurité pour protéger les données de ses clients contre les menaces potentielles.</p>

    <h2>6. Consentement et Transparence</h2>
    <p>La Société s'engage à obtenir le consentement éclairé de ses clients avant de collecter, traiter ou stocker leurs données personnelles. De plus, la Société fournira à ses clients toutes les informations nécessaires sur la manière dont leurs données sont utilisées et protégées.</p>

    <h2>7. Durée de la Charte</h2>
    <p>La présente Charte entre en vigueur à la date de sa publication et reste en vigueur pendant toute la durée de la relation commerciale entre la Société et ses clients.</p>

    <h2>8. Révision de la Charte</h2>
    <p>La Société se réserve le droit de modifier cette Charte à tout moment, sous réserve d'en informer ses clients de manière appropriée.</p>

    <p>En acceptant les termes de cette Charte, nos clients reconnaissent avoir pris connaissance de nos engagements en matière de protection des données personnelles et de confidentialité, et acceptent de s'y conformer.</p>

    <p>Fait à [lieu], le [date]</p>

    <p>[Signature et nom du représentant légal de la Société]</p>
	<br>
	<br>
	<div class="">
													<label>
														<input id="toggleButton" onchange="toggleButton_accepte_condition()" type="checkbox" class="js-switch" />&nbsp; <strong>* J'accepte les conditions et reglement  de la societé kaysoft</strong>
													</label>
												</div>  
									</div>



	
  </div>
  <div class="popup-content-column">
	<button onclick="btnAnnuler()" class="btn btn-danger" type="button" id="btnAnnuler-sec">Annuler</button>									
	<button onclick="envoyerFormulaire()" class="btn btn-success" id="btnValider-sec" disabled>Valider</button>
  </div>
</div>

								






							</div>
						</div>
						
					</div>

					
					</div>
				</div>
			</div>
			<!-- /page content -->

			<!-- footer content -->
			<footer>
				<div class="pull-right">
					Kaysoft <a href="https://www.kaysoft.com">Copyright</a>
				</div>
				<div class="clearfix"></div>
			</footer>
			<!-- /footer content -->
		</div>
	</div>

	<!-- jQuery -->
	<script src="../vendors/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<!-- FastClick -->
	<script src="../vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="../vendors/nprogress/nprogress.js"></script>
	<!-- bootstrap-progressbar -->
	<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
	<!-- iCheck -->
	<script src="../vendors/iCheck/icheck.min.js"></script>
	<!-- bootstrap-daterangepicker -->
	<script src="../vendors/moment/min/moment.min.js"></script>
	<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap-wysiwyg -->
	<script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
	<script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
	<script src="../vendors/google-code-prettify/src/prettify.js"></script>
	<!-- jQuery Tags Input -->
	<script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
	<!-- Switchery -->
	<script src="../vendors/switchery/dist/switchery.min.js"></script>
	<!-- Select2 -->
	<script src="../vendors/select2/dist/js/select2.full.min.js"></script>
	<!-- Parsley -->
	<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
	<!-- Autosize -->
	<script src="../vendors/autosize/dist/autosize.min.js"></script>
	<!-- jQuery autocomplete -->
	<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
	<!-- starrr -->
	<script src="../vendors/starrr/dist/starrr.js"></script>
	<!-- Custom Theme Scripts -->
	<script src="../build/js/custom.min.js"></script>

</body></html>
