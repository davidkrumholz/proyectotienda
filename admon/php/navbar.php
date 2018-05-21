<?php

			//Valida si hay sesion
			if(isset($_SESSION['admon'])) {
				print '<li><a href="../logout.php"><span class = "glyphicon glyphicon-log-out"></span>Logout</a></li>';
			}else{
				header("location:index.php");
			}
			?>