var sits = [];
var sitsList = "";

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
    } else if ($target == '1') {
        $('#add-session').modal('show');
    } else {
        $('#add-genre').modal('show');
    }
});

/* Добавление фильма */
$('#submit-film').on('click', function (e) {
    e.preventDefault();
    $genres = [];
    $('.film-genre').each(function (index, value) {
        if (value.checked) {
            $genres.push($(value).attr("id"));
        }
    });
    $filmName = $('#film-name').val();
    $filmAge = $('#film-age').val();
    $filmOriginalName = $('#film-original-name').val();
    $filmProducer = $('#film-producer').val();
    $filmRentStart = $('#film-rent-start').val();
    $filmRentEnd = $('#film-rent-end').val();
    $filmRating = $('#film-rating').val();
    $filmLanguage = $('#film-language').val();
    $filmDuration = $('#film-duration').val();
    $filmProduction = $('#film-production').val();
    $filmScenario = $('#film-scenario').val();
    $filmStarring = $('#film-starring').val();
    $filmDescription = $('#film-description').val();
    $filmTrailer = $('#film-trailer').val();
    $isAvailable = $('#is-available').val();
    $isImportant = $('#is-important').val();

    $.post('/ajax/add/essence/film', {
        genres: JSON.stringify($genres),
        filmName: $filmName,
        filmAge: $filmAge,
        filmOriginalName: $filmOriginalName,
        filmProducer: $filmProducer,
        filmRentStart: $filmRentStart,
        filmRentEnd: $filmRentEnd,
        filmRating: $filmRating,
        filmLanguage: $filmLanguage,
        filmDuration: $filmDuration,
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
});

/* Добавление сеанса */
$('#submit-session').on('click', function (e) {
    e.preventDefault();
    $filmId = $('#session-film-name :selected').attr('id');
    $hallId = $('#session-hall-name :selected').attr('id');
    $sessionDate = $('#session-date').val();
    $sessionTime = $('#session-time').val();
    $sessionPrice = $('#session-price').val();

    $.post('/ajax/add/essence/session', {
        filmId: $filmId,
        hallId: $hallId,
        sessionDate: $sessionDate,
        sessionTime: $sessionTime,
        sessionPrice: $sessionPrice,
    }, onAjaxSuccess);

    function onAjaxSuccess(data) {
        alert(data);
    }
});

/* Добавление жанра */
$('#submit-genre').on('click', function (e) {
    e.preventDefault();
    $genreName = $('#genre-name').val();

    $.post('/ajax/add/essence/genre', {
        genreName: $genreName,
    }, onAjaxSuccess);

    function onAjaxSuccess(data) {
        alert(data);
    }
});

/* Добавление фильма в список желаемого */
$('.add-to-wish-list').on('click', function (e) {
    e.preventDefault()
    $id = $(this).attr('id');
    $.post('/ajax/addToWishList', {
        id: $id,
    }, onAjaxSuccess);

    function onAjaxSuccess(data) {
        alert(data);
        window.location.reload();
    }
});

/* Удаление фильма из списка желаемого */
$('.delete-to-wish-list').on('click', function (e) {
    e.preventDefault()
    $id = $(this).attr('id');
    $element = $(this);
    $.post('/ajax/deleteToWishList', {
        id: $id,
    }, onAjaxSuccess);

    function onAjaxSuccess(data) {
        alert(data);
        $element.parents('tr').fadeOut('fast');
    }
});

/* Выбор места */
$('.sits').on('click', function (e) {
    e.preventDefault();
    var exist = false;
    $id = $(this).attr('id');
    if (sits.length > 0) {
        for (var i = 0; i < sits.length; i++) {
            if (sits[i] != $id) continue;
            else {
                exist = i;
                break;
            }
        }
    }
    if (exist) {
        $(this).attr("class", "btn btn-primary");
        sits.splice(exist, 1);
    }
    else {
        sits.push($id);
        $(this).attr("class", "btn btn-success");
    }
});

$('#submit-sits').on('click', function (e) {
    e.preventDefault();
    $sitsList = JSON.stringify(sits);
    $.post('/ajax/bookedSits', {
            sits: $sitsList,
            session: $('.session').attr('id'),
            hall: $('.hall').attr('id'),
            email: $('#email-order').val(),
        },
        onAjaxSuccess
    )
    ;

    function onAjaxSuccess(data) {
        alert(data);
    }
});

/* Отмена заказа */
$('.cancel-order').on('click', function (e) {
    e.preventDefault();
    $id = $(this).attr("id");
    $element = $(this);
    $.post('/ajax/cancelOrder', {
        id: $id,
    }, onAjaxSuccess);

    function onAjaxSuccess(data) {
        alert(data);
        $element.parents('tr').fadeOut('fast');
    }

});

/* Отказ в заказе (администратор) */
$('.order-admin-cancel').on('click', function (e) {
    e.preventDefault();
    $id = $(this).attr("id");
    $.post('/ajax/cancelOrderAdmin', {
        id: $id,
    }, onAjaxSuccess);

    function onAjaxSuccess(data) {
        alert(data);
    }
});

/* Принятие заказа (администратор) */
$('.order-admin-success').on('click', function (e) {
    e.preventDefault();
    $id = $(this).attr("id");
    $.post('/ajax/accessOrderAdmin', {
        id: $id,
    }, onAjaxSuccess);

    function onAjaxSuccess(data) {
        alert(data);
    }
});