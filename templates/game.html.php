<?php
require "../database.php";
$games = $pdo->prepare("SELECT * FROM games WHERE code='" . $_GET["code"] . "'");
$games->execute();
?>
<div class="game-wrapper">
    <?php foreach ($games as $game) : ?>
        <div class="game-accordion">
            <h1><?= $game['game_title'] ?></h1>
            <div class="game-image">
                <img src="data:image/jpeg;base64,<?= base64_encode($game['game_image']) ?>" />
                                                </div>
                                                <div class="game-right">
                                                    <div class="game-text">
                                                        <p><?= $game['game_text'] ?></p>
                                                </div>
                                            </div>

                                            <button onclick="myFunction('More')" class="g-button block black">More</button>
                                            <div id="More" class="hide accordion-container">
                                                <div class="game-image">
                                                    <iframe id="ytplayer" type="text/html" width="640" height="360" src="https://www.youtube.com/embed/<?= $game['trailer_link'] ?>?autoplay=0" frameborder="0"></iframe>
                                                                                                                    </div>

                                                                                                                    <div class="game-right">
                                                                                                                        <div class="game-more">
                                                                                                                            <p><strong>Age: </strong><?= $game['age_rating'] ?></p>
                                                                                                                            <p><strong>Platform: </strong><?= $game['platform'] ?></p>
                                                                                                                            <p><strong>Release Date: </strong><?= $game['release_date'] ?></p>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>

                                            <button onclick="myFunction('Specifics')" class="g-button block black">Specifics</button>
                                            <div id="Specifics" class="hide accordion-container">
                                            <p><strong>Publisher: </strong><?= $game['publisher'] ?></p>   
                                            <p><strong>Publisher: </strong><?= $game['developer'] ?></p>                                                           
                                            </div>

                                             </div>
                                                                                                                                                                                                        <?php endforeach; ?>
</div>


<script>
    function myFunction(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("accordion-show") == -1) {
            x.className += " accordion-show";
            x.previousElementSibling.className =
                x.previousElementSibling.className.replace("black", "accordion-active");
        } else {
            x.className = x.className.replace(" accordion-show", "");
            x.previousElementSibling.className =
                x.previousElementSibling.className.replace("accordion-active", "black");
        }
    }
</script>