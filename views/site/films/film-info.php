<?php require_once ROOT . "/views/layouts/header.php"; ?>

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
                    <?php if (!isset($_SESSION['user_id']) || (isset($_SESSION['user_id']) && (!User::userIsAdmin()))): ?>

                        <!-- Бронирование -->
                        <div class="modal fade bd-example-modal-lg" id="exampleModalCenter2" tabindex="-1" role="dialog"
                             aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Бронирование билетов</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="today-tab" data-toggle="tab"
                                                   href="#today"
                                                   role="tab" aria-controls="today" aria-selected="true">Сегодня</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="tomorrow-tab" data-toggle="tab" href="#tomorrow"
                                                   role="tab" aria-controls="tomorrow" aria-selected="false">Завтра</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="after-tomorrow-tab" data-toggle="tab"
                                                   href="#after-tomorrow" role="tab" aria-controls="after-tomorrow"
                                                   aria-selected="false"><?php echo date("d.m.Y", strtotime("+2 day")); ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="day4-tab" data-toggle="tab" href="#day4"
                                                   role="tab"
                                                   aria-controls="day4"
                                                   aria-selected="false"><?php echo date("d.m.Y", strtotime("+3 day")); ?></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="day5-tab" data-toggle="tab" href="#day5"
                                                   role="tab"
                                                   aria-controls="day5"
                                                   aria-selected="false"><?php echo date("d.m.Y", strtotime("+4 day")); ?></a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">

                                            <!-- Рассписание на сегодня -->
                                            <div class="tab-pane fade show active" id="today" role="tabpanel"
                                                 aria-labelledby="today-tab">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col">
                                                            <br>
                                                            <h1 align="center">ЭКРАН</h1>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <!-- Рассписание на завтра -->
                                            <div class="tab-pane fade" id="tomorrow" role="tabpanel"
                                                 aria-labelledby="tomorrow-tab">...
                                            </div>

                                            <!-- Рассписание на после завтра -->
                                            <div class="tab-pane fade" id="after-tomorrow" role="tabpanel"
                                                 aria-labelledby="after-tomorrow-tab">...
                                            </div>

                                            <!-- Рассписание на после-после завтра =) -->
                                            <div class="tab-pane fade" id="day4" role="tabpanel"
                                                 aria-labelledby="day4-tab">
                                                ...
                                            </div>

                                            <!-- Рассписание на после-после-после завтра -->
                                            <div class="tab-pane fade" id="day5" role="tabpanel"
                                                 aria-labelledby="day5-tab">
                                                ...
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button style="height: 50px" type="button" class="btn btn-outline-dark btn-block"
                                data-toggle="modal" data-target="#exampleModalCenter2">Забронировать
                        </button>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <?php if (User::checkWishList($filmInfo['id'])) { ?>
                                <button id="<?php echo $filmInfo['id']; ?>" style="height: 50px" type="button"
                                        class="delete-to-wish-list btn btn-outline-danger btn-block">
                                    Удалить
                                </button>
                            <?php } else { ?>
                                <button id="<?php echo $filmInfo['id']; ?>" style="height: 50px" type="button"
                                        class="add-to-wish-list btn btn-outline-primary btn-block">
                                    Добавить
                                </button>
                            <?php } endif; endif; ?>
                </div>


                <!-- Описание -->

                <div class="col" id="description-name">
                    <br>
                    <h1><?php echo $filmInfo['name']; ?></h1><br>
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
                            <p>от <?php echo date("d-m-Y", strtotime($filmInfo['rent_start'])); ?>
                                по <?php echo date("d-m-Y", strtotime($filmInfo['rent_end'])); ?></p>
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
                            <p><?php echo $filmInfo['genres']; ?></p>
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
                        <p style="margin-left: 20px; margin-right: 20px; text-indent: 1.5em;"><?php echo $filmInfo['description']; ?></p>
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

<?php require_once ROOT . "/views/layouts/footer.php"; ?>
