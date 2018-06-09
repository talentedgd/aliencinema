<?php require_once ROOT . "/views/layouts/header.php"; ?>

    <!-- Список фильмов -->

    <div class="container">
        <div class="col">
            <div class="three"><h1>Новые поступления</h1></div>
        </div>
        <div class="row">
            <?php foreach ($films as $filmItem): ?>
                <div class="col-lg-3 col-md-6 grow">
                    <a href="/films/<?php echo $filmItem['id']; ?>" style="text-decoration: none; color: black;">
                        <div class="card" style="width: 15rem;">
                            <img class="card-img-top" height="360"
                                 src="<?php echo $filmItem['image'][0]; ?>"
                                 alt="Card image cap">
                            <img id="future" src="/template/img/soon.png" height="40px" width="40px" alt="">
                            <div class="card-body" id="description">
                                <h5><?php echo $filmItem['name']; ?></h5>
                                <h6><?php echo $filmItem['rating']; ?></h6>
                                <h6>Жанр: ужасы</h6>
                                <h6>Возраст: +<?php echo $filmItem['age']; ?></h6>
                                <button type="button" class="btn btn-outline-secondary btn-block">Забронировать
                                </button>
                                <button type="button" class="btn btn-outline-primary btn-block">Добавить</button>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php require_once ROOT . "/views/layouts/footer.php"; ?>