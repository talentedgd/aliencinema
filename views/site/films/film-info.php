<?php require_once ROOT . "/views/layouts/header.php";?>

<!-- Информация о фильме -->

<div class="container card" id="view">
    <div class="row">
        <div class="col" style="width: 40rem;">
            <div class="row">

                <!-- Изображение -->

                <div class="col-md-4">
                    <img class="card-img-top"
                         src="<?php echo $filmInfo['image'][0] ?>"
                         alt="Card image cap"><br><br>
                    <button style="height: 50px" type="button" class="btn btn-outline-dark btn-block">Забронировать</button>
                    <button style="height: 50px" type="button" class="btn btn-outline-primary btn-block">Добавить</button>
                </div>

                <!-- Описание -->

                <div class="col" id="description-name">
                    <br><h1><?php echo $filmInfo['name']; ?></h1><br>
                    <div class="row">
                        <div class="col">
                            <p>Возраст:</p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo $filmInfo['age']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Оригинальное название:</p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo $filmInfo['original_name']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Режиссер:</p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo $filmInfo['producer']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Период проката:</p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo $filmInfo['rent_start']; ?> - <?php echo $filmInfo['rent_end']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Рейтинг:</p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo $filmInfo['rating']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Язык:</p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo $filmInfo['language']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Жанр:</p>
                        </div>
                        <div class="col-md-8">
                            <p>Боевик, Комедия, Фантастика, Приключения</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Длительность:</p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo $filmInfo['duration']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Производство:</p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo $filmInfo['production']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>Сценарий:</p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo $filmInfo['scenario']; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p>В главных ролях:</p>
                        </div>
                        <div class="col-md-8">
                            <p><?php echo $filmInfo['starring']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p style="margin-left: 20px; margin-right: 20px; text-indent: 1.5em;">Продолжение истории о ненормальном, невыносимом и неубиваемом Дэдпуле, разрушающем все
                            стереотипы о супергероях. Бывшего наёмника, превращённого в мутанта-убийцу, ждут новые
                            «подвиги» — смесь фарса, кровопролития и безумия.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <!-- Трейлер -->

                    <div class="row">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="<?php echo $filmInfo['trailer']; ?>"
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once ROOT . "/views/layouts/footer.php";?>
