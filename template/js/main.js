/* Регистрация пользователя Ajax*/
$('button#registration').on('click', function (e) {
    e.preventDefault();

    $email = $('#email_value').val();
    $name = $('#name_value').val();
    $password = $('#password_value').val();
    $.post('/ajax/registration', {
        email: $email,
        name: $name,
        password: $password,
    }, onAjaxSuccess);

    function onAjaxSuccess(data) {
        if (data == "0") {
            alert("Регистрация прошла успешно!");
            $(".conclusion").hide();
        }
        else {
            var result = JSON.parse(data);
            for (var i = 0; i < result.length; i++) {
                if (result[i] == "email") {
                    $(".email_conclusion").html("Неправильно введен Email или указанный уже существует");
                    $(".email_conclusion").show();
                }
                if (result[i] == "name") {
                    $(".name_conclusion").html("Имя не должно быть короче 2 символов");
                    $(".name_conclusion").show();
                }
                if (result[i] == "password") {
                    $(".password_conclusion").html("Пароль не должен быть короче 6-ти символов");
                    $(".password_conclusion").show();
                }
            }
        }
    }
});
$('#hide').on('click', function () {
    $(".conclusion").hide();
});

/* Вход Ajax */
$('button#login').on('click', function (e) {
    e.preventDefault();

    $email = $('.login_email').val();
    $password = $('.login_password').val();
    $.post('/ajax/login', {
        email: $email,
        password: $password,
    }, onAjaxSuccess);

    function onAjaxSuccess(data) {
        alert(data);
        window.location.reload();
    }
});

/* Выход Ajax */
$('a#logout').on('click', function (e) {
    e.preventDefault();
    $.post('/ajax/logout', {}, onAjaxSuccess);

    function onAjaxSuccess() {
        window.location.reload();
    }
});

/* Удаление элемента (фильм, сеанс, жанр) */
$('.delete').on('click', function (e) {
    e.preventDefault();
    $element = $(this);
    $id = $(this).attr("id");

    $.post('/ajax/delete/' + $(this).val(), {
        id: $id,
    }, onAjaxSuccess);

    function onAjaxSuccess() {
        $element.parents('tr').fadeOut('fast');
    }
});

/* Изменение пароля */
$('#change_password').on('click', function (e) {
    e.preventDefault();
    $oldPassword = $('#old_pass').val();
    $newPassword = $('#new_pass').val();
    $repPassword = $('#rep_pass').val();

    $.post('/ajax/change/password', {
        oldPassword: $oldPassword,
        newPassword: $newPassword,
        repPassword: $repPassword,
    }, onAjaxSuccess);

    function onAjaxSuccess(data) {
        alert(data);
    }
});

/* Показ нужного модального окна для добавления сущности */
$('#submit-essence').on('click', function (e) {
    e.preventDefault();
    $target = $('#select-essence :selected').val();
    if ($target == '2') {
        $('#add-film').modal('show');
    }
});

/* Добавление фильма */
$('#submit-film').on('click', function (e) {
    e.preventDefault();
    $filmName = $('#film-name').val();
    $filmAge = $('#film-age').val();
    $filmOriginalName = $('#film-original-name').val();
    $formProducer = $('#form-producer').val();
    $filmRentStart = $('#film-rent-start').val();
    $filmEndStart = $('#film-end-start').val();
    $filmRating = $('#film-rating').val();
    $filmLanguage = $('#film-language').val();
    $filmProduction = $('#film-production').val();
    $filmScenario = $('#film-scenario').val();
    $filmStarring = $('#film-starring').val();
    $filmDescription = $('#film-description').val();
    $filmTrailer = $('#film-trailer').val();
    $isAvailable = $('#is-available').val();
    $isImportant = $('#is-important').val();
    $.post('ajax/add/essence/film', {
        filmName: $filmName,
        filmAge: $filmAge,
        filmOriginalName: $filmOriginalName,
        formProducer: $formProducer,
        filmRentStart: $filmRentStart,
        filmEndStart: $filmEndStart,
        filmRating: $filmRating,
        filmLanguage: $filmLanguage,
        filmProduction: $filmProduction,
        filmScenario: $filmScenario,
        filmStarring: $filmStarring,
        filmDescription: $filmDescription,
        filmTrailer: $filmTrailer,
        isAvailable: $isAvailable,
        isImportant: $isImportant,
    }, onAjaxSuccess);

    function onAjaxSuccess(data) {
        alert(data);
    }

})
