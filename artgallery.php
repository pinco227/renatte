<?php
include('header.php');

$rezultate_maxime = 15;
$intrari_totale = mysqli_num_rows(mysqli_query($conexiune, 'SELECT `id` as Num FROM `art`'));

if ($intrari_totale == 0) {
	echo '<br><center><font color="darkred"><b>Nu exista inca nici un produs in baza de date !</b></font></center>';
} else {
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
			echo '<table width="785" cellspacing="5" cellpadding="0" border="0"><tr>';

			while ($rand = mysqli_fetch_assoc($rezultat)) {
				$nr++;
				$poza = 'art/thumb_' . $rand['poza'];
				list($width, $height) = getimagesize($poza);
				$height = $height - 13;
				$width2 = $width + 10;
				$width3 = $width - 13;
				echo
				'<td align="center" width="153">
								<table width="110" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td rowspan="2" colspan="2">
											<a href="art/' . $rand['poza'] . '" rel="lightbox[art]" title="' . $rand['nume'] . '"><img src="art/thumb_' . $rand['poza'] . '" width="' . $width . '" alt=""></a>
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

			if ($pagini_totale == 1) echo '<div align=left> </div>';
			else {

				echo '<div align="center">';

				for ($pagini = 1; $pagini <= $pagini_totale; $pagini++) {
					if (($pagina) == $pagini) echo '<b><font color="#B98D26" style="font-size: 14px;	font-weight: bold; font-family: Arial, Helvetica, sans-serif;">' . $pagini . '</font></b>&nbsp;';
					else echo '<a href="artgallery.php?page=' . $pagini . '">' . $pagini . '</a>&nbsp;';
				}
				echo '</div>';
				echo '<table width="100%"><tr>
								<td align="left">';
				if ($pagina > 1) {
					$inapoi = ($pagina - 1);
					echo '
									<a href="artgallery.php?page=' . $inapoi . '"><img src="images/anterioara.gif" width="130" height="33"></a>';
				}
				echo '</td>
								<td align="right">';
				if ($pagina < $pagini_totale) {
					$inainte = ($pagina + 1);
					echo '<a href="artgallery.php?page=' . $inainte . '"><img src="images/urmatoare.gif" width="130" height="33"></a>';
				}
				echo '</td>
							  </tr></table>';
			}
		}
	}
}
include('footer.php');
