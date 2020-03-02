<?php

$dsn = "mysql:host=localhost;dbname=netland";
$user = "root";
$passwd = "";

$pdo = new PDO($dsn, $user, $passwd);
$result_series = "";
$result_films = "";
$changing_order = array(
    "title",
    "rating",
    "titel",
    "duur_in_min",
);
if(isset($_GET['sort']) && in_array($_GET['sort'],$changing_order)){
        if(isset($_GET['order1'])){
            if($_GET['order1'] == 'ASC'){
                $result_series = $pdo->query("SELECT id, title, rating FROM series ORDER BY title ASC");
            }
            else if($_GET['order1'] == 'DESC'){
                $result_series = $pdo->query("SELECT id, title, rating FROM series ORDER BY title DESC");
            }
        }
        if(isset($_GET['order2'])){
            if($_GET['order2'] == 'ASC'){
                $result_series = $pdo->query("SELECT id, title, rating FROM series ORDER BY rating ASC");
            }
            else if($_GET['order2'] == 'DESC'){
                $result_series = $pdo->query("SELECT id, title, rating FROM series ORDER BY rating DESC");
            }
        }
        if(isset($_GET['order3'])){
            if($_GET['order3'] == 'ASC'){
                $result_films = $pdo->query("SELECT volgnummer, titel, duur_in_min FROM films ORDER BY titel ASC");
            }
            else if($_GET['order3'] == 'DESC'){
                $result_films = $pdo->query("SELECT volgnummer, titel, duur_in_min FROM films ORDER BY titel DESC");
            }
        }
        if(isset($_GET['order4'])){
            if($_GET['order4'] == 'ASC'){
                $result_films = $pdo->query("SELECT volgnummer, titel, duur_in_min FROM films ORDER BY duur_in_min ASC");
            }
            else if($_GET['order4'] == 'DESC'){
                $result_films = $pdo->query("SELECT volgnummer, titel, duur_in_min FROM films ORDER BY duur_in_min DESC");
            }
        }
    }
if($result_series == ""){
    $result_series = $pdo->query("SELECT id, title, rating FROM series");
}
if($result_films == ""){
    $result_films = $pdo->query("SELECT volgnummer, titel, duur_in_min FROM films");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <main>
        <h1>Welkom op het netland beheerderspaneel</h1>
        <h2 >Series</h2>
        <table>
        <tr><th style='width:150px'><a href="index.php?sort=<?php echo $changing_order[0]; ?>&order1=<?php if(isset($_GET['order1'])){echo $_GET['order1'] === 'DESC' ? 'ASC' : 'DESC';}else{echo 'DESC';} ?>" >Title</a></th>
        <th style='width:150px'><a href="index.php?sort=<?php echo $changing_order[1]; ?>&order2=<?php if(isset($_GET['order2'])){echo $_GET['order2'] === 'DESC' ? 'ASC' : 'DESC';}else{echo 'DESC';} ?>">Rating</a></th></tr>
        <?php 
        while($row_series = $result_series->fetch()) {
            echo '<tr><td><a href="series.php?id='.$row_series['id'].'">';
            echo($row_series['title'] . '</a></td><td style="text-align:center;">' .  $row_series['rating']);
            echo '</td></tr>';
        }
        ?>
        </table>
        <h2>Films</h2>
        <table>
        <tr><th style='width:150px'><a href="index.php?sort=<?php echo $changing_order[2];?>&order3=<?php if(isset($_GET['order3'])){echo $_GET['order3'] === 'DESC' ? 'ASC' : 'DESC';}else{echo 'DESC';} ?>" >Title</a></th>
        <th style='width:150px'><a href="index.php?sort=<?php echo $changing_order[3];?>&order4=<?php if(isset($_GET['order4'])){echo $_GET['order4'] === 'DESC' ? 'ASC' : 'DESC';}else{echo 'DESC';} ?>" >Duration</a></th></tr>
        <?php 
        while($row_films = $result_films->fetch()) {
            echo '<tr><td><a href="films.php?id='.$row_films['volgnummer'].'">';
            echo($row_films['titel'] . '</td><td style="text-align:center;">' .  $row_films['duur_in_min']);
            echo '</td></tr>';
        }
        
        ?>    
        </table>
    </main>
</body>
</html>