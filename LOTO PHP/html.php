<!DOCTYPE html>
<html>
<head>
	<title>Tirage du Loto</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<h1>Tirage du Loto</h1>
	</header>
	<main>
		<form method="post" action="tirage.php">
			<label for="csv_file">Importer le fichier CSV des joueurs :</label>
			<input type="file" name="csv_file" id="csv_file"><br><br>
			<input type="submit" value="Tirer les numéros">
		</form>
	</main>
</body>
</html>
