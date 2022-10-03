<?php

include_once "mysqlConnect.php";

// function for generation menu
function generation_head_menu($mysqli) {
    // create sql request
    $sql = "SELECT * FROM 'topic'";
    // send sql request in db
    $resSQL = $mysqli -> query($sql);
    ?>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">Navbar</a>
            <ul class="navbar-nav mr-auto">
                <?php
                    // create list categories in menu
                    while ($rowTopic = $resSQL -> fetch_assoc()) {
                        // print elements list
                        echo '<li class="nav-item"><a class="nav-link" href="./topic.php?id_topic='. $rowTopic["id"] .'">'. $rowTopic['name'].'</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </header>
    <?php
}

// create generation for print article in categories
function generation_posts_topic($mysqli, $id_topic) {
    // create sql request
    $sql = "SELECT * FROM 'articles' WHERE 'id_topic' = '$id_topic'";
    // send sql request
    $res = $mysqli -> query($sql);
    // check if there are articles
    if ($res -> num_rows > 0) {
        // print articles
        while ($resArticle = $res -> fetch_assoc()) {
            ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" ><a href="post.php?id_article=<?= $resArticle['id'] ?>"><?= $resArticle['title'] ?></a></h5>
                    <p class="card-text"><?= mb_substr($resArticle['text'], 0, 158, 'UTF-8') ?></p>
                </div>
            </div>
            <?php
        }
    } else {
        // if not articles print write
        echo 'There are mo articles in this section';
    }
}

// function for generation articles
function generation_post($mysqli, $id_article) {
    // create sql request
    $sql = "SELECT * FROM 'articles' WHERE 'id' = '$id_article'";
    // send sql request
    $res = $mysqli -> query($sql);

    if ($res -> num_rows === 1) {
        $resPost = $res -> fetch_assoc()?>
        <h1><?= $resPost['title'] ?></h1>
        <p><?= $resPost['text'] ?></p>
        <p>Дата публикации: <?= substr($resPost['date'], 0, 11) ?></p>
        <?php
    }
}

function generation_comment ($mysqli, $id_article) {
    // create sql request
    $sql = "SELECT * FROM `comments` WHERE `id_article` = $id_article";
    // send sql request
    $resSQL = $mysqli -> query($sql);

    if ($resSQL -> num_rows > 0) {
        while ($resComment = $resSQL -> fetch_assoc()) {
            ?>
            <div class="comment">
                <p><b><?= $resComment['comment']?></b></p>
                <p>Sent: <?= substr($resComment['date'], 0, 11)  ?></p>
            </div>
            <hr>
            <?php
        }
    } else {
        ?>
        <p>No comments</p>
        <?php
    }
}