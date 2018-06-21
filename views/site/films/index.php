<?php require_once ROOT . "/views/layouts/header.php"; ?>

    <!-- Список фильмов -->

    <div class="container">
        <div class="col">
            <div class="one"><h1>Новые поступления</h1></div>
        </div>
        <?php if ($films) { ?>
            <div class="row">
                <?php foreach ($films as $filmItem): ?>
                    <div class="col-lg-3 col-md-6 grow">
                        <a href="/films/<?php echo $filmItem['id']; ?>" style="text-decoration: none; color: black;">
                            <div class="card" style="width: 15rem;">
                                <img class="card-img-top" height="360"
                                     src="<?php echo $filmItem['image'][0]; ?>"
                                     alt="Card image cap">
                                <div class="card-body" id="description">
                                    <h5><?php echo $filmItem['name']; ?></h5>
                                    <h6><?php echo $filmItem['rating']; ?></h6>
                                    <h6>Жанр: <?php echo $filmItem['genres']; ?></h6>
                                    <h6>Возраст: +<?php echo $filmItem['age']; ?></h6>
                                    <?php if (!isset($_SESSION['user_id']) || (isset($_SESSION['user_id']) && (!User::userIsAdmin()))): ?>
                                        <?php if (isset($_SESSION['user_id'])): ?>
                                            <?php if (User::checkWishList($filmItem['id'])) { ?>
                                                <button id="<?php echo $filmItem['id']; ?>" style="height: 50px"
                                                        type="button"
                                                        class="delete-to-wish-list btn btn-outline-danger btn-block">
                                                    Удалить
                                                </button>
                                            <?php } else { ?>
                                                <button id="<?php echo $filmItem['id']; ?>" style="height: 50px"
                                                        type="button"
                                                        class="add-to-wish-list btn btn-outline-primary btn-block">
                                                    Добавить
                                                </button>
                                            <?php } endif; endif; ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php } else echo '<h3 style="text-align: center; color: white;">Список фильмов пуст</h3>'; ?>
    </div>

<?php require_once ROOT . "/views/layouts/footer.php"; ?>