<?php
    require "../database.php";
    try{
    if(isset($_REQUEST["term"])){
        $sql = "SELECT * FROM games WHERE game_title LIKE :term";
        $stmt = $pdo->prepare($sql);
        $term = $_REQUEST["term"] . '%';
        $stmt->bindParam(":term", $term);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){?>
                <a href="game.php?code=<?=$row['code']?>"><p><?=$row['game_title']?></p></a>
           <?php }
        } else{
            echo "<p>No matches found</p>";
        }
    }  
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}