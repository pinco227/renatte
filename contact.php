<?php
include('header.php');

if((isset($_POST['mail'])) || (isset($_POST['nume'])))
{
	if(($_POST['nume'] == '') || ($_POST['mesaj'] == ''))
	{
		echo '
			<table align="center" cellspacing="0" cellpadding="5" border="1">
				<tr>
					<td align="center">
						<b>EROARE !</b>
					</td>
				</tr>';
		if($_POST['nume'] == '') echo '<tr><td align="center">Introduceti va rog numele dumneavoastra !</td></tr>';
		else echo '';
		if($_POST['mesaj'] == '') echo '<tr><td align="center">Nu ati scris nici un mesaj !</td></tr>';
		else echo '';
		echo '</table>';
	}
	else
	{
		$catre = 'renatte.iasi@gmail.com';
		$data_trimitere = date('d-m-Y H:i:s');
		$subiect = 'Mail contact - Renatte.Ro';
		$mesaj = '
		<html>
		<head>
		<title>Contact de pe Renatte !</title>
		</head>
		<body>
		Data trimiterii : '.$data_trimitere.' <br />
		Nume : <b>'.$_POST['nume'].'</b> <br />
		Email: <b>'.$_POST['email'].'</b> <br />
		Mesaj : <br />
		'.$_POST['mesaj'].'<br />
		</body></html>';
		$headere = "MIME-Version: 1.0\r\n";
		$headere .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headere .= "From: ".$_POST['nume']." <Renatte.Ro>\r\n";
		
		mail($catre, $subiect, $mesaj, $headere);
		echo '
		<table border="1" cellspacing="0" cellpadding="8" align="center">
			<tr>
				<td align="center">
					<b><font>Mesajul a fost trimis cu succes! Va multumim!</font></b>
				</td>
			</tr>	
		</table>	
		';
	}
}


echo '
	<table width="786" border="0" cellpadding="10" cellspacing="0">
		<tr>
			<td colspan="2" align="center">
				<strong>CONTACT</strong><br />
			</td>
		</tr>
		<tr>
			<td align="right" valign="middle">
				Tel: +40722 680 678<br />
				Tel: +40724 020 389<br />
				Fax: +40332 443 278<br />
				email: <strong>renatte.iasi@gmail.com<br />
				florinmorun2005@yahoo.com</strong><br />
				Adresa postala: <strong>Iasi, str. V. Alecsandri<br />
				nr. 9, bl. I3, ap. 3</strong>
			</td>
			<td align="left" valign="middle">
			  <form name="mail" method="post" action="contact.php">
				Nume:<br />
				<input type="text" name="nume" width="25" /><br />
				Email:<br />
				<input type="text" name="email" width="25" /><br />
				Mesaj:<br />
				<textarea cols="30" rows="5" name="mesaj"></textarea><br />
				<input type="submit" name="submit" />
			  </form>
			</td>
		</tr>
	</table>
';
include('footer.php');
?>