<div class="searchWrapper">
    <div class="searchTop">
        <h1>PLATFORM </h1>
        <h1> SORT: </h1>
        <h1> PRICE </h1>
        <h1> RELEASE DATE </h1>
        <h1> OFFERS </h1>
    </div>
    <div class="searchLeft">
        <h1>LATEST OFFERS</h1>
    </div>
    <div class="searchRight">
        <div class="contentSearch">
            <?php
            require "../database.php";
            $search = str_replace(array('%', '_'), '', $_POST['term']);
            $sql = "SELECT * FROM games WHERE game_title LIKE :term";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':term', '%' . $search . '%', PDO::PARAM_STR);
            $stmt->execute();
            $results = $stmt->fetchAll();
            if ($stmt->rowCount() > 0) {
                foreach ($results as $game) : ?>

                    <div class="index_games_search">
                        <img src="data:image/jpeg;base64,<?= base64_encode($game['game_image']) ?>" width="200" height="200" alt="" class="logo" />
                                                    <h4><?= $game['game_title'] ?></h4>
                                                    <p><?= $game['game_description'] ?></p>
                                                    <a href="game.php?code=<?= $game['code'] ?>">More</a>
                                                    <form method="post" action="index.php?action=add&code=<?= $game['code'] ?>">
                                                                        <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" hidden /><input type="submit" value="Add to Cart" class="btnAddAction" />
                                                                        </div>
                                                                    </form>
                                                                </div>


                                                                                                            <?php endforeach;
                                                                } elseif ($stmt->rowCount() <= 0) {
                                                                    $games = $pdo->prepare('SELECT * FROM games');
                                                                    $games->execute();
                                                                    foreach ($games as $game) : ?>
                                                                        <div class="index_games_search">
                                                                            <img src="data:image/jpeg;base64,<?= base64_encode($game['game_image']) ?>" width="200" height="200" alt="" class="logo" />
                                                                        <h4><?= $game['game_title'] ?></h4>
                                                                        <p><?= $game['game_description'] ?></p>
                                                                        <a href="game.php?code=<?= $game['code'] ?>">More</a>
                                                                        <form method="post" action="index.php?action=add&code=<?= $game['code'] ?>">
                                                                        <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" hidden /><input type="submit" value="Add to Cart" class="btnAddAction" />
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                    <?php endforeach;
                                                                }
                                                                ?>
</div>
    </div>