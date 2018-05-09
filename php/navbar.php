<?php
			//Valida si hay sesion
			if(isset($_SESSION['usuario'])) {
				print '<li><a href="#">'.$nombre." ".$apellidoPaterno." ".$apellidoMaterno.'</a></li>';
				print '<li><a href="logout.php"><span class = "glyphicon glyphicon-log-out"></span>Logout</a></li>';
			}else{
				print '<li><a href="login.php"><span class = "glyphicon glyphicon-log-in"></span>Login</a></li>';
			}
			?>