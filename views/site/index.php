<?php require_once ROOT . "/views/layouts/header.php"; ?>

    <!-- Слайдер (карусель) -->

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $i = 0;
            foreach ($films as $film):?>
                <div class="carousel-item <?php if ($i == 1) echo 'active'; ?>">
                    <a href="/films/<?php echo $film['id'] ?>"><img class="d-block w-100"
                                                                    src="<?php echo $film['image'][1]; ?>"></a>
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $film['name']; ?></h5>
                    </div>
                </div>
                <?php
                $i++;
            endforeach;
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

<?php require_once ROOT . "/views/layouts/footer.php"; ?>