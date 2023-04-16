
<?php




// Récupération des données des joueurs à partir du fichier CSV
$joueurs = array_map('str_getcsv', file('joueurs.csv'));

// Initialisation du tableau des grilles gagnantes
$grilles_gagnantes = array();

// Tirage des numéros gagnants
$numeros_gagnants = array();
$numero_chance_gagnant = rand(1, 10); // Tirage du numéro chance
while (count($numeros_gagnants) < 7) { // Tirage des 7 numéros gagnants
    $numero = rand(1, 49);
    if (!in_array($numero, $numeros_gagnants)) {
        $numeros_gagnants[] = $numero;
    }
}
sort($numeros_gagnants); 


// Parcours des grilles de chaque joueur pour trouver les gagnants
foreach ($joueurs as $joueur) {
    $grilles_joueur = array_slice($joueur, 1); // Les grilles du joueur commencent à l'index 1
    foreach ($grilles_joueur as $grille) {
        $numeros_joueur = array_slice(explode(' ', $grille), 0, 7); // Les numéros de la grille commencent jusqu'à l'index 6
        $numero_chance_joueur = end(explode(' ', $grille)); // Le dernier numéro de la grille est le numéro chance
        
        $numeros_gagnants_sans_chance = array_slice($numeros_gagnants, 0, 5); // Les 5 premiers numéros sont ceux qui définissent le rang 1 et 2
        
        // Vérification du rang
        $rang = 6;
        if ($numeros_joueur === $numeros_gagnants) {
            $rang = ($numero_chance_joueur == $numero_chance_gagnant) ? 1 : 2;
        } elseif ($numeros_joueur === $numeros_gagnants_sans_chance) {
            $rang = ($numero_chance_joueur == $numero_chance_gagnant) ? 3 : 4;
        } elseif (count(array_intersect($numeros_joueur, $numeros_gagnants)) == 3) {
            $rang = ($numero_chance_joueur == $numero_chance_gagnant) ? 4 : 5;
        } elseif (count(array_intersect($numeros_joueur, $numeros_gagnants)) == 2 and $numero_chance_joueur == $numero_chance_gagnant) {
            $rang = 5;
        } elseif ($numero_chance_joueur == $numero_chance_gagnant) {
            $rang = 6;
        }
        
        // Ajout de la grille gagnante au tableau des grilles gagnantes si le rang est 1, 2 ou 3
        if ($rang <= 3) {
            $grilles_gagnantes[] = array(
                'joueur' => $joueur[0], // Le nom du joueur est en première colonne
                'grille' => $grille,
                'rang' => $rang
            );
        }
    }
}

// Tri des grilles gagnantes en fonction du rang (du plus petit au plus grand)
usort($grilles_gagnantes, function($a, $b) {
   
