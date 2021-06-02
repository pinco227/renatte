<?php
include('header.php');
if (!isset($_SESSION['logat'])) $_SESSION['logat'] = 'Nu';

if ($_SESSION['logat'] == 'Da') {

	echo '
			<table width="405" align="center">
				<tr>
					<td align="center">
						<strong>NU UITA SA DAI LOGOUT !!</strong>
					</td>
				</tr>
				<tr>
					<td align="center">
						<br />
						<a href="admin.php?action=add">Adauga imagine</a> | <a href="admin.php?action=lista">Lista imagini</a> | <a href="admin.php?action=add2">Adauga in galerie</a> | <a href="admin.php?action=lista2">Galerie</a> <br /> 
						<a href="admin.php?action=add3">Adauga Admini</a> | <a href="admin.php?action=lista3">Lista Admini</a> | <a href="admin.php?action=logoff">LogOut [' . $_SESSION['username'] . ']</a>
						<br /><br /><br />
					</td>
				</tr>
			</table>
		';
	if (isset($_GET['action'])) {
		///////////////////////////////////////////////////////////////////////////////
		//  ADAUGA PORTOFOLIU   ///////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		if ($_GET['action'] == 'add') {
			if (isset($_POST['add'])) {
				$_SESSION['nume'] = $_POST['nume'];
				$_SESSION['cat'] = $_POST['cat'];

				if (($_SESSION['nume'] == '') || ($_SESSION['cat'] == '')) {
					echo '<table width="405" cellspacing="0" cellpading="5" align="center"><tr><td align="center"><b>ERROR !</b></td></tr>';
					if ($_SESSION['nume'] == '') echo '<tr><td align="center">Introdu numele produsului !</td></tr>';
					if ($_SESSION['cat'] == '') echo '<tr><td align="center">Alege categoria din care face parte produsul !</td></tr>';
					echo '</table>';
				} else {

					$uploadpath = $_SESSION['cat'] . "/";
					$file = $_SESSION['nume'] . '.jpg';
					$uploadpath = $uploadpath . basename($file);
					if (!move_uploaded_file($_FILES["poza"]["tmp_name"], $uploadpath))
						die("There was an error uploading the file, please try again!");

					$image_name = $_SESSION['cat'] . "/" . $file;
					$nume_nou = $_SESSION['nume'] . ".jpg";
					list($width, $height) = getimagesize($image_name);
					$new_image_name = $_SESSION['cat'] . "/thumb_" . $_SESSION['nume'] . ".jpg";
					$ratio = ($width / 130);
					$ratio2 = ($height / 150);
					if (($height / $ratio) <= 150) {
						$new_width = 130;
						$new_height = ($height / $ratio);
					} else {
						$new_height = 150;
						$new_width = ($width / $ratio2);
					}
					$image_p = imagecreatetruecolor($new_width, $new_height);
					$image = imagecreatefromjpeg($image_name);
					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					imagejpeg($image_p, $new_image_name, 100);


					$cerereSQL = "INSERT INTO `portofoliu` ( `nume`, `poza`, `cat`) 
											VALUES ( '" . htmlentities($_SESSION['nume'], ENT_QUOTES) . "', 
													 '" . htmlentities($nume_nou, ENT_QUOTES) . "',
													 '" . htmlentities($_SESSION['cat'], ENT_QUOTES) . "')";
					mysqli_query($conexiune, $cerereSQL) or die("<center><b><font color='red'>Adaugarea nu a putut fi realizata !</font></b></center>");
					echo '<font color="green"><center><b>Produsul s-a adaugat cu succes !</b></center></font><br>';
					//	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=add">';

				}

				$_SESSION['nume'] = '';
				$_SESSION['cat'] = '';
			} else {
				echo '';
			}

			echo '<form name="add" action="admin.php?action=add" method="post" enctype="multipart/form-data">
					<table border="0" align="center" width="400" cellspacing="5" cellpadding="5">
						<tr>
							<td align="right"><b>Nume:</b></td>
							<td align="left"><input type="text" size="30" name="nume"></td>   
						</tr>
						<tr>
							<td align="right"><b>Categorie:</b></td>
							<td align="left">
								<select name="cat" size="1">
									<option value="porti">Porti</option>
									<option value="garduri">Garduri</option>
									<option value="balustrade">Balustrade</option>
									<option value="balcoane">Balcoane</option>
									<option value="dopertine">Copertine</option>
									<option value="diverse">Diverse</option>
								</select>
							</td>   
						</tr>
						<tr>
							<td align="right"><b>Imagine:</b></td>
							<td align="left"><input name="poza" id="poza" size="17" type="file"></td>
						</tr>
						<tr>
							<td align="center" colspan="2"><input name="add" type="submit" value="Adauga" id="add"></td>
						</tr>
					</table>
				  </form>';
		}
		//  END  //////////////////////////////////////////////////////////////////////

		///////////////////////////////////////////////////////////////////////////////
		//  ADAUGA GALERIE   //////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////		
		elseif ($_GET['action'] == 'add2') {
			if (isset($_POST['add2'])) {
				$_SESSION['nume'] = $_POST['nume'];

				if ($_SESSION['nume'] == '') {
					echo '
					<table width="405" cellspacing="0" cellpading="5" align="center">
						<tr>
							<td align="center"><b>ERROR !</b>
							</td>
						</tr>
						<tr>
							<td align="center">Introdu numele produsului !
							</td>
						</tr>
					</table>';
				} else {

					$uploadpath = "art/";
					$file = $_SESSION['nume'] . '.jpg';
					$uploadpath = $uploadpath . basename($file);
					if (!move_uploaded_file($_FILES["poza"]["tmp_name"], $uploadpath))
						die("There was an error uploading the file, please try again!");

					$image_name = "art/" . $file;
					$nume_nou = $_SESSION['nume'] . ".jpg";
					list($width, $height) = getimagesize($image_name);
					$new_image_name = "art/thumb_" . $_SESSION['nume'] . ".jpg";
					$ratio = ($width / 130);
					$ratio2 = ($height / 150);
					if (($height / $ratio) <= 150) {
						$new_width = 130;
						$new_height = ($height / $ratio);
					} else {
						$new_height = 150;
						$new_width = ($width / $ratio2);
					}
					$image_p = imagecreatetruecolor($new_width, $new_height);
					$image = imagecreatefromjpeg($image_name);
					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					imagejpeg($image_p, $new_image_name, 100);


					$cerereSQL = "INSERT INTO `art` ( `nume`, `poza`) 
											VALUES ( '" . htmlentities($_SESSION['nume'], ENT_QUOTES) . "', 
													 '" . htmlentities($nume_nou, ENT_QUOTES) . "')";
					mysqli_query($conexiune, $cerereSQL) or die("<center><b><font color='red'>Adaugarea nu a putut fi realizata !</font></b></center>");
					echo '<font color="green"><center><b>Imaginea s-a adaugat cu succes !</b></center></font><br>';
					//			echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=add2">';

				}

				$_SESSION['nume'] = '';
			} else {
				echo '';
			}

			echo '<form name="add2" action="admin.php?action=add2" method="post" enctype="multipart/form-data">
					<table border="0" align="center" width="400" cellspacing="5" cellpadding="5">
						<tr>
							<td align="right"><b>Nume:</b></td>
							<td align="left"><input type="text" size="30" name="nume"></td>   
						</tr>
						<tr>
							<td align="right"><b>Imagine:</b></td>
							<td align="left"><input name="poza" id="poza" size="17" type="file"></td>
						</tr>
						<tr>
							<td align="center" colspan="2"><input name="add2" type="submit" value="Adauga" id="add2"></td>
						</tr>
					</table>
				  </form>';
		}
		//  END  //////////////////////////////////////////////////////////////////////

		///////////////////////////////////////////////////////////////////////////////
		//  ADAUGA ADMINI   ///////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////		
		elseif ($_GET['action'] == 'add3') {
			if (isset($_POST['add3'])) {
				$_SESSION['nume'] = $_POST['nume'];
				$_SESSION['parola'] = $_POST['parola'];

				if (($_SESSION['nume'] == '') || ($_SESSION['parola'] == '')) {
					echo '<table width="405" cellspacing="5" cellpading="5" align="center">
							<tr>
								<td align="center">
									<b>ERROR !</b>
								</td>
							</tr>';
					if ($_SESSION['nume'] == '') echo '<tr><td align="center">Introduceti numele !</td></tr>';
					if ($_SESSION['parola'] == '') echo '<tr><td align="center">Introduceti parola !</td></tr>';
					echo '</table>';
				} else {
					$cerereSQL = "INSERT INTO `admin` ( `user`, `pass` ) 
											VALUES ( '" . htmlentities($_SESSION['nume'], ENT_QUOTES) . "', '" . md5($_SESSION['parola']) . "' )";
					mysqli_query($conexiune, $cerereSQL) or die("<center><b><font color='red'>Adaugarea nu a putut fi realizata !</font></b></center>");
					echo '<font color="green"><center><b>Adminul a fost adaugat cu succes !</b></center></font><br>';
					echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista3">';
				}
				$_SESSION['nume'] = '';
				$_SESSION['parola'] = '';
			} else {
				echo '';
			}
			echo '<form name="add3" action="admin.php?action=add3" method="post" enctype="multipart/form-data">
					<table border="0" align="center" width="405" cellspacing="" cellpadding="5">
						<tr>
							<td align="right" width="35%"><b>Nume:</b></td>
							<td align="left" width="65%"><input type="text" name="nume"></td>   
						</tr>
						<tr>
							<td align="right"><b>Parola:</b></td>
							<td align="left"><input type="text" name="parola"></td>   
						</tr>
						<tr>
							<td align="center" colspan="2"><input name="add3" type="submit" value="Adauga" id="add"></td>
						</tr>
					</table>
				  </form>';
		}
		//  END  //////////////////////////////////////////////////////////////////////

		///////////////////////////////////////////////////////////////////////////////
		//  LISTA PORTOFOLIU   ////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////

		elseif ($_GET['action'] == 'lista') {
			$rezultate_maxime = 21;
			$intrari_totale = mysqli_num_rows(mysqli_query($conexiune, 'SELECT `id` as Num FROM `portofoliu`'));
			if (!isset($_GET['page'])) $pagina = 1;
			else $pagina = $_GET['page'];
			$nr = 0;
			$from = (($pagina * $rezultate_maxime) - $rezultate_maxime);
			$cerereSQL = 'SELECT * FROM `portofoliu` ORDER BY `id` DESC LIMIT ' . $from . ', ' . $rezultate_maxime . '';
			$rezultat = mysqli_query($conexiune, $cerereSQL);

			$pagini_totale = ceil($intrari_totale / $rezultate_maxime);

			if ($pagina > $pagini_totale) echo 'Pagina nu exista !';
			else {
				if ($pagini_totale > 0) {
					echo '<table width="690" cellspacing="10" cellpadding="0" border="0" align="center"><tr>';

					while ($rand = mysqli_fetch_assoc($rezultat)) {
						$nr++;
						$imgsrc = $rand['cat'] . '/thumb_' . $rand['poza'] . '';
						echo '										
										<td align="center" width="130" height="190">
											<table width="130" border="1" cellspacing="0" cellpadding="0">
												<tr>
													<td width="130" align="center" valign="middle">
														<img src="' . $imgsrc . '" alt="' . $rand['nume'] . '" />
													</td>
												</tr>
												<tr>
													<td width="130" align="center">
														' . $rand['nume'] . '<br />
														Categorie : <b>' . $rand['cat'] . '</b><br />
														<a href="admin.php?action=edit&id=' . $rand['id'] . '">EDITEAZA</a> | <a href="admin.php?action=delete&id=' . $rand['id'] . '">STERGE</a>
													</td>
												</tr>
											</table>
										</td>
										';
						if ($nr % 5 == 0) echo '</tr><tr>';
					}
					echo '</tr></table>';

					if ($pagini_totale == 1) echo '<div align=left> </div>';
					else {

						echo '<div align="center">';

						for ($pagini = 1; $pagini <= $pagini_totale; $pagini++) {
							if (($pagina) == $pagini) echo '<strong><font color="#f4c27b" style="font-size: 16px;	font-weight: bold;">' . $pagini . '</font></strong>&nbsp;';
							else echo '<a href="admin.php?action=lista&page=' . $pagini . '">' . $pagini . '</a>&nbsp;';
						}
						echo '</div>';
						echo '<table width="405" cellpadding="0"><tr>
							<td align="right" width="203">';
						if ($pagina > 1) {
							$inapoi = ($pagina - 1);
							echo '<a href="admin.php?action=lista&page=' . $inapoi . '"><img src="images/anterioara.gif" width="99" height="18" /></a>';
						}
						echo '</td>
										<td align="right">';
						if ($pagina < $pagini_totale) {
							$inainte = ($pagina + 1);
							echo '<a href="admin.php?action=lista&page=' . $inainte . '"><img src="images/urmatoare.gif" width="99" height="18" /></a>';
						}
						echo '</td>
								  	</tr>
								  </table>';
					}
				}
			}
		}

		//  END  //////////////////////////////////////////////////////////////////////

		///////////////////////////////////////////////////////////////////////////////
		//  LISTA ART   ///////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////

		elseif ($_GET['action'] == 'lista2') {
			$rezultate_maxime = 21;
			$intrari_totale = mysqli_num_rows(mysqli_query($conexiune, 'SELECT `id` as Num FROM `art`'));
			if (!isset($_GET['page'])) $pagina = 1;
			else $pagina = $_GET['page'];
			$nr = 0;
			$from = (($pagina * $rezultate_maxime) - $rezultate_maxime);
			$cerereSQL = 'SELECT * FROM `art` ORDER BY `id` DESC LIMIT ' . $from . ', ' . $rezultate_maxime . '';
			$rezultat = mysqli_query($conexiune, $cerereSQL);

			$pagini_totale = ceil($intrari_totale / $rezultate_maxime);

			if ($pagina > $pagini_totale) echo 'Pagina nu exista !';
			else {
				if ($pagini_totale > 0) {
					echo '<table width="690" cellspacing="10" cellpadding="0" border="0" align="center"><tr>';

					while ($rand = mysqli_fetch_assoc($rezultat)) {
						$nr++;
						$imgsrc = 'art/thumb_' . $rand['poza'] . '';
						echo '										
										<td align="center" width="130" height="190">
											<table width="130" border="1" cellspacing="0" cellpadding="0">
												<tr>
													<td width="130" align="center" valign="middle">
														<img src="' . $imgsrc . '" alt="' . $rand['nume'] . '" />
													</td>
												</tr>
												<tr>
													<td width="130" align="center">
														' . $rand['nume'] . '<br />
														<a href="admin.php?action=delete2&id=' . $rand['id'] . '">STERGE</a>
													</td>
												</tr>
											</table>
										</td>
										';
						if ($nr % 5 == 0) echo '</tr><tr>';
					}
					echo '</tr></table>';

					if ($pagini_totale == 1) echo '<div align=left> </div>';
					else {

						echo '<div align="center">';

						for ($pagini = 1; $pagini <= $pagini_totale; $pagini++) {
							if (($pagina) == $pagini) echo '<strong><font color="#f4c27b" style="font-size: 16px;	font-weight: bold;">' . $pagini . '</font></strong>&nbsp;';
							else echo '<a href="admin.php?action=lista2&page=' . $pagini . '">' . $pagini . '</a>&nbsp;';
						}
						echo '</div>';
						echo '<table width="405" cellpadding="0"><tr>
							<td align="right" width="203">';
						if ($pagina > 1) {
							$inapoi = ($pagina - 1);
							echo '<a href="admin.php?action=lista2&page=' . $inapoi . '"><img src="images/anterioara.gif" width="99" height="18" /></a>';
						}
						echo '</td>
										<td align="right">';
						if ($pagina < $pagini_totale) {
							$inainte = ($pagina + 1);
							echo '<a href="admin.php?action=lista2&page=' . $inainte . '"><img src="images/urmatoare.gif" width="99" height="18" /></a>';
						}
						echo '</td>
								  	</tr>
								  </table>';
					}
				}
			}
		}

		//  END  //////////////////////////////////////////////////////////////////////

		///////////////////////////////////////////////////////////////////////////////
		//  LISTA ADMINI   ////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////

		elseif ($_GET['action'] == 'lista3') {
			$cerereSQL = 'SELECT * FROM `admin` ORDER BY `id`';
			$rezultat = mysqli_query($conexiune, $cerereSQL);

			echo '<table border="1" align="center" width="405" cellspacing="5" cellpadding="5">
					<tr>
						<td align="center"><b>Nume</b></td>
						<td align="center" width="40"><b>Sterge</b></td>
					</tr>';

			while ($rand = mysqli_fetch_assoc($rezultat)) {
				echo '<tr>';
				if ($rand['user'] == '' . $_SESSION['username'] . '') {
					echo '<td align="center">' . $_SESSION['username'] . '</td>
										  <td align="center"><font color="lightgrey"><strong>[x]</strong></font></td>';
				} else {
					echo '<td>' . $rand['user'] . '</td>
										  <td align="center"><a href="admin.php?action=delete3&id=' . $rand['id'] . '"><font color="red">[x]</font></a></td>';
				}
				echo '</tr>';
			}
			echo '</table>';
		}

		//  END  //////////////////////////////////////////////////////////////////////

		///////////////////////////////////////////////////////////////////////////////
		//  EDITEAZA PRODUS   /////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		elseif ($_GET['action'] == 'edit') {
			if (isset($_POST['edit'])) {
				$_SESSION['nume'] = $_POST['nume'];
				$_SESSION['cat'] = $_POST['cat'];

				if ($_SESSION['nume'] == '') {
					echo '
						<table width="405" cellspacing="5" cellpading="5" align="center" bgcolor="#1e040a">
							<tr>
								<td align="center">
									<b>ERROR !</b>
								</td>
							</tr>
							<tr>
								<td align="center">Introdu numele produsului !</td>
							</tr>
						</table>';
				} else {

					$cerereDel = "SELECT * FROM `portofoliu` WHERE `id`='" . htmlentities($_GET['id'], ENT_QUOTES) . "'";
					$rezultatDel = mysqli_query($conexiune, $cerereDel);
					while ($rand = mysqli_fetch_assoc($rezultatDel)) {
						rename($rand['cat'] . '/' . $rand['poza'], $_SESSION['cat'] . '/' . $rand['poza'] . '');
						rename($rand['cat'] . '/thumb_' . $rand['poza'], $_SESSION['cat'] . '/thumb_' . $rand['poza'] . '');
					}

					$cerereSQL = "UPDATE `portofoliu` SET `nume`='" . $_SESSION['nume'] . "', `cat`='" . $_SESSION['cat'] . "' WHERE `id`='" . $_GET['id'] . "'";
					mysqli_query($conexiune, $cerereSQL);

					echo '<br /><center><font color="darkgreen"><b>Produsul a fost modificat cu succes !</b></font></center><br />';

					$_SESSION['nume'] = '';
					$_SESSION['cat'] = '';

					//	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista">';
				}
			} else {
				echo '';
			}

			$cerereSQL = "SELECT * FROM `portofoliu` WHERE `id`='" . $_GET['id'] . "'";
			$rezultat = mysqli_query($conexiune, $cerereSQL);
			while ($rand = mysqli_fetch_assoc($rezultat)) {
				echo '<form name="edit" action="admin.php?action=edit&id=' . $rand['id'] . '" method="post" enctype="multipart/form-data">
						<table border="0" align="center" width="400" cellspacing="5" cellpadding="5" bgcolor="#1e040a">
							<tr>
								<td align="right">
									<b>Nume:</b>
								</td>
								<td>
									<input type="text" size="30" name="nume" value="' . $rand['nume'] . '">
								</td>   
							</tr>
							<tr>
								<td align="right">
									<b>Categorie:</b>
								</td>
								<td>
									<select name="cat" size="1">
										<option selected value="' . $rand['cat'] . '">' . $rand['cat'] . '</option>
										<option value="porti">Porti</option>
										<option value="garduri">Garduri</option>
										<option value="balustrade">Balustrade</option>
										<option value="balcoane">Balcoane</option>
										<option value="dopertine">Copertine</option>
										<option value="diverse">Diverse</option>
									</select>
								</td>   
							</tr>
							<tr>
								<td align="center" colspan="2">
									<input name="edit" type="submit" value="Editeaza">
								</td>
							</tr>
						</table>
					</form><br><br>
				';
			}
		}
		//  END  //////////////////////////////////////////////////////////////////////

		///////////////////////////////////////////////////////////////////////////////
		//  STERGE PORTOFOLIU   ///////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////

		elseif ($_GET['action'] == 'delete') {

			$cerereDel = "SELECT * FROM `portofoliu` WHERE `id`='" . htmlentities($_GET['id'], ENT_QUOTES) . "'";
			$rezultatDel = mysqli_query($conexiune, $cerereDel);
			while ($rand = mysqli_fetch_assoc($rezultatDel)) {
				if (file_exists($rand['cat'] . "/" . $rand['poza'] . "")) {

					@unlink($rand['cat'] . "/" . $rand['poza'] . "");
				} elseif (file_exists($rand['cat'] . "/thumb_" . $rand['poza'] . "")) {

					@unlink($rand['cat'] . "/thumb_" . $rand['poza'] . "");
				}
			}
			$cerereSQL = "DELETE FROM `portofoliu` WHERE `id`='" . htmlentities($_GET['id'], ENT_QUOTES) . "'";
			$rezultat = mysqli_query($conexiune, $cerereSQL);
			echo '<br><br><br><center><font color="red"><b>Produsul a fost sters din baza de date !</b></font></center><br><br><br>';
			echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista">';
		}

		//  END  //////////////////////////////////////////////////////////////////////

		///////////////////////////////////////////////////////////////////////////////
		//  STERGE ART   //////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////

		elseif ($_GET['action'] == 'delete2') {

			$cerereDel = "SELECT * FROM `art` WHERE `id`='" . htmlentities($_GET['id'], ENT_QUOTES) . "'";
			$rezultatDel = mysqli_query($conexiune, $cerereDel);
			while ($rand = mysqli_fetch_assoc($rezultatDel)) {
				if (file_exists("art/" . $rand['poza'] . "")) {

					@unlink("art/" . $rand['poza'] . "");
				} elseif (file_exists("art/thumb_" . $rand['poza'] . "")) {

					@unlink("art/thumb_" . $rand['poza'] . "");
				}
			}
			$cerereSQL = "DELETE FROM `art` WHERE `id`='" . htmlentities($_GET['id'], ENT_QUOTES) . "'";
			$rezultat = mysqli_query($conexiune, $cerereSQL);
			echo '<br><br><br><center><font color="red"><b>Imaginea a fost stearsa din baza de date !</b></font></center><br><br><br>';
			echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista2">';
		}

		//  END  //////////////////////////////////////////////////////////////////////

		///////////////////////////////////////////////////////////////////////////////
		//  STERGE ADMIN   ////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////

		elseif ($_GET['action'] == 'delete3') {

			$cerereSQL = "DELETE FROM `admin` WHERE `id`='" . htmlentities($_GET['id'], ENT_QUOTES) . "'";
			$rezultat = mysqli_query($conexiune, $cerereSQL);
			echo '<br><br><br><center><font color="red"><b>Adminul a fost sters din baza de date !</b></font></center><br><br><br>';
			echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php?action=lista3">';
		}

		//  END  //////////////////////////////////////////////////////////////////////

		///////////////////////////////////////////////////////////////////////////////
		//  LOGOUT   //////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////

		elseif ($_GET['action'] == 'logoff') {
			$_SESSION['logat'] = 'Nu';
			echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=admin.php">';
		}

		//  END  //////////////////////////////////////////////////////////////////////
		else {
			echo '';
		}
	} else {
		echo '';
	}
} else {
	if (isset($_POST['login'])) {
		$admin = $_POST['admin'];
		$pass = $_POST['pass'];
		$admin = stripslashes($admin);
		$pass = stripslashes($pass);
		$admin = mysqli_real_escape_string($conexiune, $admin);
		$pass = mysqli_real_escape_string($conexiune, $pass);

		$_SESSION['username'] = $admin;

		$cerereSQL = "SELECT * FROM `admin` WHERE `user`='" . htmlentities($admin) . "' AND `pass`='" . md5($pass) . "'";
		$rezultat = mysqli_query($conexiune, $cerereSQL);
		if (mysqli_num_rows($rezultat) == 1) {
			while ($rand = mysqli_fetch_assoc($rezultat)) {
				$_SESSION['logat'] = 'Da';
				echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=' . $_SERVER['PHP_SELF'] . '">';
			}
		} else {
			echo '<br><center><font color="red"><b>Userul si parola nu corespund ! Incercati din nou !</b></font></center>';
		}
	} else {

		echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
					<table width="405" cellspacing="0" cellpading="5" align="center">
							<tr>
								<td colspan="2">
									&nbsp;
								</td>
							</tr>
							<tr>
								<td align="right" width="35%">
									Nume:
								</td>
								<td align="left" width="65%">
									<input type="text" name="admin" value="" size="18">
								</td>
							</tr>
							<tr>
								<td align="right">
									Parola:
								</td>
								<td align="left">
									<input type="password" name="pass" value="" size="18">
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center">
									<input type="submit" name="login" value="Login" class="button">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									&nbsp;
								</td>
							</tr>
					</table>
			  </form>';
	}
}
include('footer.php');
