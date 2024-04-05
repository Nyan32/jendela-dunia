$(document).ready(function () {
    var url = base_url
    var showNav = false;
    $('#btnShowHideNav').on('click', function () {
        if (showNav) {
            $('#navControl').removeClass('show-nav');
            $('#navControl').removeClass('normal-nav');
            $('#navControl').addClass('hide-nav');
            setTimeout(function () {
                $("#navControl").addClass('d-none');
            }, 1000)
            showNav = false;
        }
        else if (!showNav) {
            $('#navControl').removeClass('d-none');
            $('#navControl').removeClass('hide-nav');
            $('#navControl').removeClass('normal-nav');
            $('#navControl').addClass('show-nav');

            showNav = true;
        }
    });

    $(window).resize(function () {
        $('#navControl').removeClass('hide-nav');
        $('#navControl').removeClass('show-nav');
        $('#navControl').removeClass('d-none');
        $('#navControl').addClass('normal-nav');

        showNav = false;
    });

    $('#homeBtn').on('click', function () {
        window.location.href = `${url}`;
    })

    $('#aboutUsHeader').on('click', function () {
        window.location.href = `${url}/aboutus`;
    });

    // Header button

    $('#loginHeader').on('click', function () {
        window.location.href = `${url}/loginreg`;
    });

    $('#profileHeader').on('click', function () {
        window.location.href = `${url}/profile`;
    });

    $('#likesHeader').on('click', function () {
        window.location.href = `${url}/likes`;
    });

    $('#homeHeader').on('click', function () {
        window.location.href = `${url}`;
    });

    // Profile button

    $('#logoutBtn').on('click', function () {
        window.location.href = `${url}/loginreg`;
    })

    $('#editProfile').on('click', function () {
        window.location.href = `${url}/profile/showedit`;
    })

    // Admin Button

    $('#adminBtn').on('click', function () {
        window.location.href = `${url}/admin`;
    })

    // Select box control

    $('.select-box input[type=radio]').on('change', function () {
        $(this).parents('.select-box').find('.select-label').text($(this).parent().children('.item-label').text());
        $(this).parents('.select-box').find('.select-list').removeClass('d-block');
        $(this).parents('.select-box').find('.select-list').addClass('d-none');
    });

    $('.select-box[data-type="sort"] input[type=radio]').on('click', function () {
        var searchItem = $('.search-item input[name="search"]').val();
        var sort1 = $('.select-box input[name="sort"]:checked').val();
        var sort2 = $('.select-box input[name="sortType"]:checked').val();
        $.ajax({
            url: `${url}/searchitem`,
            method: 'get',
            dataType: 'json',
            data: {
                'searchItem': searchItem,
                'sort1': sort1,
                'sort2': sort2
            }
        }).done(function (response) {
            $('#daftarBukuCont').empty();
            $('#daftarBukuCont').append(generateBook(response));

            // Detail book button

            $('.book-detail').on('click', function () {
                var book_id = $(this).data('id');
                window.location.href = `${url}/detailbook/${book_id}`;
            });

            // Js Fill Color

            $('.js-fillcolor').fillColor();
        });
    })

    $('.select-box[data-type="bylikes"] input[type=radio]').on('click', function () {
        var searchItem = $('#searchLikes').val();
        var sort1 = $('.select-box input[name="sort"]:checked').val();
        var sort2 = $('.select-box input[name="sortType"]:checked').val();
        $.ajax({
            url: `${url}/searchitem/bylikes`,
            method: 'get',
            dataType: 'json',
            data: {
                'searchItem': searchItem,
                'sort1': sort1,
                'sort2': sort2
            }
        }).done(function (response) {
            $('#daftarBukuCont').empty();
            $('#daftarBukuCont').append(generateBook(response));

            // Detail book button

            $('.book-detail').on('click', function () {
                var book_id = $(this).data('id');
                window.location.href = `${url}/detailbook/${book_id}`;
            });

            // Js Fill Color

            $('.js-fillcolor').fillColor();
        });
    })

    $('.select-box .select-activate').on('change', function () {
        if ($(this).is(':checked')) {
            $(this).parents('.select-box').children('.select-list').removeClass('d-none');
            $(this).parents('.select-box').children('.select-list').addClass('d-block');
        }
        else {
            $(this).parents('.select-box').children('.select-list').removeClass('d-block');
            $(this).parents('.select-box').children('.select-list').addClass('d-none');
        }
    })

    // Search box control

    $('.search-item input[name="search"]').on('keypress', function (event) {
        let keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            var searchItem = $('.search-item input[name="search"]').val();
            var sort1 = $('.select-box input[name="sort"]:checked').val();
            var sort2 = $('.select-box input[name="sortType"]:checked').val();

            $.ajax({
                url: `${url}/searchitem`,
                method: 'get',
                dataType: 'json',
                data: {
                    'searchItem': searchItem,
                    'sort1': sort1,
                    'sort2': sort2
                }
            }).done(function (response) {
                $('#daftarBukuCont').empty();
                $('#daftarBukuCont').append(generateBook(response));

                // Detail book button

                $('.book-detail').on('click', function () {
                    var book_id = $(this).data('id');
                    window.location.href = `${url}/detailbook/${book_id}`;
                });

                // Js Fill Color

                $('.js-fillcolor').fillColor();
            });
        }
    })

    $('#searchLikes').on('keypress', function (event) {
        let keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            var searchItem = $('#searchLikes').val();
            var sort1 = $('.select-box input[name="sort"]:checked').val();
            var sort2 = $('.select-box input[name="sortType"]:checked').val();

            $.ajax({
                url: `${url}/searchitem/bylikes`,
                method: 'get',
                dataType: 'json',
                data: {
                    'searchItem': searchItem,
                    'sort1': sort1,
                    'sort2': sort2
                }
            }).done(function (response) {
                $('#daftarBukuCont').empty();
                $('#daftarBukuCont').append(generateBook(response));

                // Detail book button

                $('.book-detail').on('click', function () {
                    var book_id = $(this).data('id');
                    window.location.href = `${url}/detailbook/${book_id}`;
                });

                // Js Fill Color

                $('.js-fillcolor').fillColor();
            });
        }
    })

    // Function to generate book item

    function generateBook(response) {
        var elementAdd = '';
        if (response['book'] != null) {
            for (i = 0; i < response['book'].length; i++) {
                var author = '';
                for (j = 0; j < response['book'][i][0]['author'].length; j++) {
                    if (j == response['book'][i][0]['author'].length - 1) {
                        author += response['book'][i][0]['author'][j]['name'];
                    } else {
                        author += response['book'][i][0]['author'][j]['name'] + '; ';
                    }
                }

                var publisher = '';
                if (response['book'][i][0]['publisher'].length > 0) {
                    publisher = response['book'][i][0]['publisher'][0]['name'];
                } else {
                    publisher = "Unknown";
                }

                elementAdd += `
                <div class="col-xl-2 col-lg-3 col-md-4 col-12 p-1">
                    <div class="d-flex flex-md-column flex-row flex-wrap style-2 h-100">
                        <div class="d-flex align-items-center justify-content-center col-md-12 col-4 js-fillcolor" style="height: 300px">
                            <img src="${url}/administrator/image_upload/buku/${response['book'][i][0]['image']}" class="card-img-menu" alt="${response['book'][i][0]['image']}">
                        </div>
                        <hr class="m-0">
                        <div class="card-menu-body d-flex flex-grow-1 flex-column p-2 col-md-12 col-8 justify-content-md-start justify-content-center">
                            <h5 class="card-title">${response['book'][i][0]['title']}</h5>
                            <h6 class="card-subtitle mb-2 text-muted ">${publisher}</h6>
                            <p class="card-text">${author}</p>
                        </div>
                        <div class="card-menu-footer w-100 col-12">
                            <button class="style-2 color-3 w-100 book-detail" data-id="${response['book'][i][0]['id']}">DETAIL</button>
                        </div>
                    </div>
                </div>
                `
            }
        } else {
            elementAdd += `
            <div class="align-self-center text-center w-100" style="color:var(--color-2)">
                <i class="fa-solid fa-ghost" style="font-size:150px"></i>
                <br><br><h3>ITEM NOT FOUND</h3>
                <p>Please try another keyword</p>
            </div>`;
        }
        return elementAdd;
    }

    // Detail book button

    $('.book-detail').on('click', function () {
        var book_id = $(this).data('id');
        window.location.href = `${url}/detailbook/${book_id}`;
    })

    // Js Fill Color

    $('.js-fillcolor').fillColor();

    // Auto text color

    $('.autotext-color').autotextcolor();

    // Login Register animation

    $('#dummy').height($('#registerForm').height());

    setTimeout(function () {
        $('#registerForm').addClass('d-none');
        $('#registerForm').removeClass('hidden');
    }, 1)

    var btnLoginAvail = true;
    var btnRegisAvail = true;

    $('#registerBtn').on('click', function () {
        if (btnRegisAvail == true) {
            btnRegisAvail = false;
            btnLoginAvail = false;
            $('#loginForm').addClass('anim-left-hide');
            $('#loginForm input[type=text]').val('');
            $('#loginForm input[type=password]').val('');
            $('#registerForm').removeClass('d-none');
            $('#registerForm').addClass('d-flex');
            $('#registerForm').addClass('anim-left-show');

            $('#errorList').remove();

            setTimeout(function () {
                $('#loginForm').addClass('d-none');
                $('#loginForm').removeClass('anim-left-hide');
                $('#loginForm').removeClass('d-flex');
                $('#registerForm').removeClass('anim-right-hide');
                $('#registerForm').removeClass('anim-left-show');
                btnLoginAvail = true;
                btnRegisAvail = true;
            }, 1000)
        }
    })

    $('#loginBtn').on('click', function () {
        if (btnLoginAvail == true) {
            btnRegisAvail = false;
            btnLoginAvail = false;
            $('#registerForm').addClass('anim-right-hide');
            $('#registerForm input[type=text]').val('');
            $('#registerForm input[type=password]').val('');
            $('#registerForm input[type=tel]').val('');
            $('#registerForm input[type=date]').val('');
            $('.select-box input[name="gender"]:checked').removeAttr('checked');
            $('.select-box input[name="gender"][value="M"]').prop('checked', true);
            $('.select-box .select-label').text('Laki-laki');
            $('#loginForm').removeClass('d-none');
            $('#loginForm').addClass('d-flex');
            $('#loginForm').addClass('anim-right-show');

            $('#errorList').remove();

            setTimeout(function () {
                $('#registerForm').addClass('d-none');
                $('#registerForm').removeClass('anim-right-hide');
                $('#registerForm').removeClass('d-flex');
                $('#loginForm').removeClass('anim-left-hide');
                $('#loginForm').removeClass('anim-right-show');
                btnLoginAvail = true;
                btnRegisAvail = true;
            }, 1000)
        }
    })

    // Login Register ajax

    $('#submitLogin').on('click', function () {
        var email = $('input[name="emailLogin"]').val();
        var password = $('input[name="passwordLogin"]').val();
        var method = $('#submitLogin').val();
        var csrf = $('input[name="csrf_token_name"]').val();
        $.ajax({
            url: `${url}/verify`,
            method: 'post',
            data: {
                'emailLogin': email,
                'passwordLogin': password,
                'method': method,
                'csrf_token_name': csrf
            },
            dataType: 'json'
        }).done(function (response) {
            $('input[name="csrf_token_name"]').val(response['token']);
            $('#errorList').remove();
            if (response['errorRes'] != null) {
                $('#errorNotif').append('<ul class="alert-danger mb-0 p-2" id="errorList"></ul>');
                for (var key in response['errorRes']) {
                    var value = response['errorRes'][key];
                    $('#errorList').append('<li><i class="fa-solid fa-circle-xmark"></i> ' + value + '</li>');
                }
                var new_position = $('#errorNotif').offset();
                $('html, body').stop().animate({ scrollTop: new_position.top }, 500);
            } else {
                window.location.href = `${url}`;
            }
        });
    });

    $('#submitRegister').on('click', function () {
        var name = $('input[name="name"]').val();
        var gender = $('.select-box input[name="gender"]:checked').val();
        var birthdate = $('input[name="birthdate"]').val();
        var phone = $('input[name="phone"]').val();
        var address = $('input[name="address"]').val();
        var email = $('input[name="emailReg"]').val();
        var password = $('input[name="passwordReg"]').val();
        var confPassword = $('input[name="confPassword"]').val();
        var method = $('#submitRegister').val();
        var csrf = $('input[name="csrf_token_name"]').val();
        $.ajax({
            url: `${url}/verify`,
            method: 'post',
            data: {
                'name': name,
                'gender': gender,
                'birthdate': birthdate,
                'phone': phone,
                'address': address,
                'emailReg': email,
                'passwordReg': password,
                'confPassword': confPassword,
                'method': method,
                'csrf_token_name': csrf
            },
            dataType: 'json'
        }).done(function (response) {
            $('input[name="csrf_token_name"]').val(response['token']);
            $('#errorList').remove();
            if (response['errorRes'] != null) {
                $('#errorNotif').append('<ul class="alert-danger mb-0 p-2" id="errorList"></ul>');
                for (var key in response['errorRes']) {
                    var value = response['errorRes'][key];
                    $('#errorList').append('<li><i class="fa-solid fa-circle-xmark"></i> ' + value + '</li>');
                }
                var new_position = $('#errorNotif').offset();
                $('html, body').stop().animate({ scrollTop: new_position.top }, 500);
            } else {
                $('#loginBtn').trigger('click');
                $('#errorNotif').append('<div class="alert-success mb-0 p-2" id="errorList">Account is successfuly registered.</div>');
                var new_position = $('#errorNotif').offset();
                $('html, body').stop().animate({ scrollTop: new_position.top }, 500);
                setTimeout(function () {
                    $('#errorList').remove();
                }, 2000)
            }
        });
    });
})