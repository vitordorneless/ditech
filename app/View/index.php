<?php
session_start();
if ($_SESSION["user_id"] == NULL) {
    session_destroy();
    header("Location:../../index.html");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Desafio Técnico <?php echo date('Y'); ?> - Vítor Dorneles</title>   
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />        
        <meta name="description" content="Demandas">
        <meta name="author" content="Grupo TI - AMA">
        <link href="../../corporate/assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/fontello/css/fontello.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/animate-css/animate.min.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/nifty-modal/css/component.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" /> 
        <link href="../../corporate/assets/libs/ios7-switch/ios7-switch.css" rel="stylesheet" /> 
        <link href="../../corporate/assets/libs/pace/pace.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/jquery-icheck/skins/all.css" rel="stylesheet" />        
        <link href="../../corporate/assets/libs/prettify/github.css" rel="stylesheet" />
        <link href="../../corporate/assets/libs/rickshaw/rickshaw.min.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/libs/morrischart/morris.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/libs/jquery-jvectormap/css/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/libs/jquery-clock/clock.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/libs/bootstrap-calendar/css/bic_calendar.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/libs/jquery-weather/simpleweather.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/libs/bootstrap-xeditable/css/bootstrap-editable.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/css/style.css" rel="stylesheet" type="text/css" />
        <link href="../../corporate/assets/css/style-responsive.css" rel="stylesheet" />        
        <link href="../../corporate/assets/libs/summernote/summernote.css" rel="stylesheet" type="text/css" />
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script><![endif]-->
        <link rel="shortcut icon" href="../../corporate/assets/img/favicon.ico">
        <link rel="apple-touch-icon" href="../../corporate/assets/img/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="../../corporate/assets/img/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="../../corporate/assets/img/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="../../corporate/assets/img/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="../../corporate/assets/img/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="../../corporate/assets/img/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="../../corporate/assets/img/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="../../corporate/assets/img/apple-touch-icon-152x152.png" />
        <script src="../../corporate/assets/libs/jquery/jquery-1.11.1.min.js"></script>
        <script src="../js/menu.js"></script>
        <script>var resizefunc = [];</script>        
        <script src="../../corporate/assets/libs/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../corporate/assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
        <script src="../../corporate/assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js"></script>
        <script src="../../corporate/assets/libs/jquery-detectmobile/detect.js"></script>
        <script src="../../corporate/assets/libs/jquery-animate-numbers/jquery.animateNumbers.js"></script>
        <script src="../../corporate/assets/libs/ios7-switch/ios7.switch.js"></script>
        <script src="../../corporate/assets/libs/fastclick/fastclick.js"></script>
        <script src="../../corporate/assets/libs/jquery-blockui/jquery.blockUI.js"></script>
        <script src="../../corporate/assets/libs/bootstrap-bootbox/bootbox.min.js"></script>
        <script src="../../corporate/assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="../../corporate/assets/libs/jquery-sparkline/jquery-sparkline.js"></script>
        <script src="../../corporate/assets/libs/nifty-modal/js/classie.js"></script>
        <script src="../../corporate/assets/libs/nifty-modal/js/modalEffects.js"></script>
        <script src="../../corporate/assets/libs/sortable/sortable.min.js"></script>
        <script src="../../corporate/assets/libs/bootstrap-fileinput/bootstrap.file-input.js"></script>
        <script src="../../corporate/assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script> 
        <script src="../../corporate/assets/libs/pace/pace.min.js"></script>        
        <script src="../../corporate/assets/libs/prettify/prettify.js"></script>
        <script src="../../corporate/assets/js/init.js"></script>
        <script src="../../corporate/assets/libs/summernote/summernote.js"></script>
        <script src="../js/justGage.1.0.1/resources/js/raphael.2.1.0.min.js"></script>
        <script src="../js/justGage.1.0.1/resources/js/justgage.1.0.1.min.js"></script>	
    </head>
    <body class="fixed-left">
        <div id="wrapper">
            <div class="topbar">
                <div class="topbar-left">                    
                    <button class="button-menu-mobile open-left">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="navbar-collapse2">                            
                            <ul class="nav navbar-nav navbar-right top-navbar">
                                <li class="dropdown iconify hide-phone"><a href="#" onclick="javascript:toggle_fullscreen()"><i class="icon-resize-full-2"></i></a></li>
                            </ul>                            
                        </div>                        
                    </div>
                </div>
            </div>            
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">                                        
                    <div class="form-group"></div>                    
                    <div class="clearfix"></div>                    
                    <div class="profile-info">                        
                        <div class="col-xs-8">                            
                            <div class="profile-text"><?php echo $_SESSION['nome_extenso']; ?></div>
                            <div class="profile-buttons">                                
                                <a href="../Controller/sair.php" title="Sair"><i class="fa fa-power-off text-red-1"></i></a>
                            </div>
                        </div>
                    </div>                    
                    <div class="clearfix"></div>
                    <hr class="divider" />
                    <div class="clearfix"></div>                    
                    <div id="sidebar-menu">
                        <ul>
                            <li>
                                <a href='index.php'>
                                    <i class='icon-desktop'></i>
                                    <span>Meu Dashboard</span>                                     
                                </a>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'>
                                    <i class='icon-briefcase'></i>
                                    <span>Admin</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li>
                                        <a tabindex="-1" href='#' id="usuarios">
                                            <i class='icon-tags'></i>
                                            <span>Usuários</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href='#' id="salas">
                                            <i class='icon-tags'></i>
                                            <span>Salas</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class='has_sub'>
                                <a href='javascript:void(0);'>
                                    <i class='icon-briefcase'></i>
                                    <span>Reuniões</span> 
                                    <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                                </a>
                                <ul>
                                    <li>
                                        <a tabindex="-1"  href='#' id="reservar_sala">
                                            <i class='icon-tags'></i>
                                            <span>Reservar Sala</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1"  href='#' id="listar_reunioes">
                                            <i class='icon-tags'></i>
                                            <span>Ver Salas Reservadas</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a tabindex="-1"  href='#' id="cancelar_sala">
                                            <i class='icon-tags'></i>
                                            <span>Cancelar Sala</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>                    
                    <div class="clearfix"></div><br><br><br>
                </div>                
            </div>            
            <div class="content-page">                
                <div class="content">
                    <div class="col-md-12">
                        <div class="page-heading" id="titulo_grafico"><h1><i class='icon-desktop'></i>Meu Dashboard</h1></div>
                        <div class="row">                        
                            <div class="col-lg-12 portlets" id="conteudo_exclusivo"></div>
                        </div>
                    </div>
                </div> 
            </div> 
        </div>
        <div class="md-overlay"></div>        
    </body>    
</html>