<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container"> 
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button>
            <a href="index.php" class="navbar-brand">La Redonda Emoci&oacute;n</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Inicio</a></li>       
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <?php 

                    if(isset($_SESSION['rut']))
                    {
                        echo '
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <strong>'.$_SESSION['rut'].'-'.$_SESSION['dv'].'</strong>
                                <span class="glyphicon glyphicon-chevron-down"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="navbar-login">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <p class="text-center">';
                                                    if($_SESSION['tipo']==2)
                                                    {
                                                        echo '<img width="100" height="100" src="img/perfiles/user/'.$_SESSION['rut'].'/perfil.png" alt="perfil">';
                                                    }
                                                    else
                                                    {
                                                        echo '<img width="100" height="100" src="img/perfiles/admin/'.$_SESSION['rut'].'/perfil.png" alt="perfil">';
                                                    }
                                                
                                                echo '</p>
                                            </div>
                                            <div class="col-lg-8">
                                                <p class="text-left"><strong>'.$_SESSION['nombre'].'</strong></p>
                                                <p class="text-left small">'.$_SESSION['email'].'</p>
                                                <p class="text-left">';
                                                    if($_SESSION['tipo'] == 2)
                                                    {
                                                        echo '<a href="perfil_arrendatario.php" class="btn btn-primary btn-block btn-sm">Ir al perfil</a>';
                                                    }
                                                    else
                                                    {
                                                        echo '<a href="perfil_administrador.php" class="btn btn-primary btn-block btn-sm">Ir al perfil</a>';
                                                    }
                                                    echo '
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="navbar-login navbar-login-session">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p>
                                                    <a href="logout.php" class="btn btn-danger btn-block">Cerrar Sesion</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>';
                    }
                    else
                    {
                        echo '
                            <li class="active"><a href="ingreso.php">Iniciar Sesi&oacute;n</a></li>
                        ';
                    }
                ?>
            </ul>
        </div>
    </div>
</div>