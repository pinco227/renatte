<?php
include('header.php');

if (isset($_GET['cat'])) {
	$cat = $_GET['cat'];
	$cat = stripslashes($cat);
	$cat = mysqli_real_escape_string($conexiune, $cat);
	$rezultate_maxime = 10;
	$intrari_totale = mysqli_num_rows(mysqli_query($conexiune, 'SELECT `id` as Num FROM `portofoliu` WHERE `cat`="' . $cat . '"'));

	if ($intrari_totale == 0) {
		echo '<br><center><font color="darkred"><b>Nu exista inca nici un produs in baza de date !</b></font></center>';
	} else {
		if (!isset($_GET['page'])) $pagina = 1;
		else $pagina = $_GET['page'];
		$nr = 0;
		$from = (($pagina * $rezultate_maxime) - $rezultate_maxime);
		$cerereSQL = 'SELECT * FROM `portofoliu` WHERE `cat`="' . $cat . '" ORDER BY `id` DESC LIMIT ' . $from . ', ' . $rezultate_maxime . '';
		$rezultat = mysqli_query($conexiune, $cerereSQL);
		$pagini_totale = ceil($intrari_totale / $rezultate_maxime);

		if ($pagina > $pagini_totale) echo 'Pagina nu exista !';
		else {
			if ($pagini_totale > 0) {
				echo '<table width="785" cellspacing="10" cellpadding="0" border="0"><tr>';

				while ($rand = mysqli_fetch_assoc($rezultat)) {
					$nr++;
					$poza = $rand['cat'] . '/thumb_' . $rand['poza'];
					list($width, $height) = getimagesize($poza);
					$height = $height - 13;
					$width2 = $width + 10;
					$width3 = $width - 13;
					echo
					'<td align="center" width="153">
								<table border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td rowspan="2" colspan="2">
											<a href="' . $rand['cat'] . '/' . $rand['poza'] . '" rel="lightbox[' . $cat . ']" title="' . $rand['nume'] . '"><img src="' . $rand['cat'] . '/thumb_' . $rand['poza'] . '" width="' . $width . '" alt=""></a>
										</td>
										<td width="10" height="13"><img width="10" height="13" src="images/umbra1.gif" alt="fier forjat ' . $rand['nume'] . '" /></td>
									</tr>
									<tr height="100%">
										<td width="10" height="100%"><img width="10" height="' . $height . '" src="images/umbra2.gif" alt="fier forjat ' . $rand['nume'] . '" /></td>
									</tr>
									<tr>
										<td width="13" height="9" align="right"><img width="13" height="9" src="images/umbra3.gif" alt="fier forjat ' . $rand['nume'] . '" /></td>
										<td width="' . $width3 . '" height="9"><img width="' . $width3 . '" height="9" src="images/umbra4.gif" alt="fier forjat ' . $rand['nume'] . '" /></td>
										<td width="10" height="9"><img width="10" height="9" src="images/umbra5.gif" alt="fier forjat ' . $rand['nume'] . '" /></td>
									</tr>
								</table>
							</td>';
					if ($nr % 5 == 0) echo '</tr><tr>';
				}
				echo '</tr></table>';

				if ($pagini_totale == 1) echo '<div align="left"> </div>';
				else {

					echo '<div align="center">';

					for ($pagini = 1; $pagini <= $pagini_totale; $pagini++) {
						if (($pagina) == $pagini) echo '<b><font color="#B98D26" style="font-size: 14px;	font-weight: bold; font-family: Arial, Helvetica, sans-serif;">' . $pagini . '</font></b>&nbsp;';
						else echo '<a href="portofoliu.php?cat=' . $_GET['cat'] . '&page=' . $pagini . '">' . $pagini . '</a>&nbsp;';
					}
					echo '</div>';
					echo '<table width="100%"><tr>
								<td align="left">';
					if ($pagina > 1) {
						$inapoi = ($pagina - 1);
						echo '<a href="portofoliu.php?cat=' . $_GET['cat'] . '&page=' . $inapoi . '"><img src="images/anterioara.gif" width="130" height="33"></a>';
					}
					echo '</td>
								<td align="right">';
					if ($pagina < $pagini_totale) {
						$inainte = ($pagina + 1);
						echo '<a href="portofoliu.php?cat=' . $_GET['cat'] . '&page=' . $inainte . '"><img src="images/urmatoare.gif" width="130" height="33"></a>';
					}
					echo '</td>
							  </tr></table>';
				}
			}
		}
	}
} else {
	echo '
		<table width="656" height="424" align="center" cellspacing="10" cellpadding="0">
			<tr>
				<td>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td rowspan="2" colspan="2">
								<a href="portofoliu.php?cat=balcoane"><img src="images/balcoane.jpg" width="212" height="207" alt="Fier Forjat - Balcoane" /></a>
							</td>
							<td width="10" height="13"><img width="10" height="13" src="images/umbra1.gif" alt="Fier Forjat - Balcoane" /></td>
						</tr>
						<tr height="100%">
							<td width="10" height="100%"><img width="10" height="194" src="images/umbra2.gif" alt="Fier Forjat - Balcoane" /></td>
						</tr>
						<tr>
							<td width="13" height="9" align="right"><img width="13" height="9" src="images/umbra3.gif" alt="Fier Forjat - Balcoane" /></td>
							<td width="199" height="9"><img width="199" height="9" src="images/umbra4.gif" alt="Fier Forjat - Balcoane" /></td>
							<td width="10" height="9"><img width="10" height="9" src="images/umbra5.gif" alt="Fier Forjat - Balcoane" /></td>
						</tr>
					</table>
				</td>
				<td>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td rowspan="2" colspan="2">
								<a href="portofoliu.php?cat=balustrade"><img src="images/balustrade.jpg" width="212" height="207" alt="Fier Forjat - Balustrade" /></a>
							</td>
							<td width="10" height="13"><img width="10" height="13" src="images/umbra1.gif" alt="Fier Forjat - Balustrade" /></td>
						</tr>
						<tr height="100%">
							<td width="10" height="100%"><img width="10" height="194" src="images/umbra2.gif" alt="Fier Forjat - Balustrade" /></td>
						</tr>
						<tr>
							<td width="13" height="9" align="right"><img width="13" height="9" src="images/umbra3.gif" alt="Fier Forjat - Balustrade" /></td>
							<td width="199" height="9"><img width="199" height="9" src="images/umbra4.gif" alt="Fier Forjat - Balustrade" /></td>
							<td width="10" height="9"><img width="10" height="9" src="images/umbra5.gif" alt="Fier Forjat - Balustrade" /></td>
						</tr>
					</table>
				</td>
				<td>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td rowspan="2" colspan="2">
								<a href="portofoliu.php?cat=copertine"><img src="images/copertine.jpg" width="212" height="207" alt="Fier Forjat - Copertine" /></a>
							</td>
							<td width="10" height="13"><img width="10" height="13" src="images/umbra1.gif" alt="Fier Forjat - Copertine" /></td>
						</tr>
						<tr height="100%">
							<td width="10" height="100%"><img width="10" height="194" src="images/umbra2.gif" alt="Fier Forjat - Copertine" /></td>
						</tr>
						<tr>
							<td width="13" height="9" align="right"><img width="13" height="9" src="images/umbra3.gif" alt="Fier Forjat - Copertine" /></td>
							<td width="199" height="9"><img width="199" height="9" src="images/umbra4.gif" alt="Fier Forjat - Copertine" /></td>
							<td width="10" height="9"><img width="10" height="9" src="images/umbra5.gif" alt="Fier Forjat - Copertine" /></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td rowspan="2" colspan="2">
								<a href="portofoliu.php?cat=garduri"><img src="images/garduri.jpg" width="212" height="207" alt="Fier Forjat - Garduri" /></a>
							</td>
							<td width="10" height="13"><img width="10" height="13" src="images/umbra1.gif" alt="Fier Forjat - Garduri" /></td>
						</tr>
						<tr height="100%">
							<td width="10" height="100%"><img width="10" height="194" src="images/umbra2.gif" alt="Fier Forjat - Garduri" /></td>
						</tr>
						<tr>
							<td width="13" height="9" align="right"><img width="13" height="9" src="images/umbra3.gif" alt="Fier Forjat - Garduri" /></td>
							<td width="199" height="9"><img width="199" height="9" src="images/umbra4.gif" alt="Fier Forjat - Garduri" /></td>
							<td width="10" height="9"><img width="10" height="9" src="images/umbra5.gif" alt="Fier Forjat - Garduri" /></td>
						</tr>
					</table>
				</td>
				<td>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td rowspan="2" colspan="2">
								<a href="portofoliu.php?cat=porti"><img src="images/porti.jpg" width="212" height="207" alt="Fier Forjat - Porti" /></a>
							</td>
							<td width="10" height="13"><img width="10" height="13" src="images/umbra1.gif" alt="Fier Forjat - Porti" /></td>
						</tr>
						<tr height="100%">
							<td width="10" height="100%"><img width="10" height="194" src="images/umbra2.gif" alt="Fier Forjat - Porti" /></td>
						</tr>
						<tr>
							<td width="13" height="9" align="right"><img width="13" height="9" src="images/umbra3.gif" alt="Fier Forjat - Porti" /></td>
							<td width="199" height="9"><img width="199" height="9" src="images/umbra4.gif" alt="Fier Forjat - Porti" /></td>
							<td width="10" height="9"><img width="10" height="9" src="images/umbra5.gif" alt="Fier Forjat - Porti" /></td>
						</tr>
					</table>
				</td>
				<td>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td rowspan="2" colspan="2">
								<a href="portofoliu.php?cat=diverse"><img src="images/diverse.jpg" width="212" height="207" alt="Fier Forjat - Diverse" /></a>
							</td>
							<td width="10" height="13"><img width="10" height="13" src="images/umbra1.gif" alt="Fier Forjat - Diverse" /></td>
						</tr>
						<tr height="100%">
							<td width="10" height="100%"><img width="10" height="194" src="images/umbra2.gif" alt="Fier Forjat - Diverse" /></td>
						</tr>
						<tr>
							<td width="13" height="9" align="right"><img width="13" height="9" src="images/umbra3.gif" alt="Fier Forjat - Diverse" /></td>
							<td width="199" height="9"><img width="199" height="9" src="images/umbra4.gif" alt="Fier Forjat - Diverse" /></td>
							<td width="10" height="9"><img width="10" height="9" src="images/umbra5.gif" alt="Fier Forjat - Diverse" /></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	';
}
include('footer.php');
