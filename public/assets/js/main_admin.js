$(document).ready(function () {
    var url = base_url;
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

    // Js Fill Color

    $('.js-fillcolor').fillColor();

    // Auto text color

    $('.autotext-color').autotextcolor();

    // Navigation button

    $('#booksBtn').on('click', function () {
        window.location.href = `${url}/admin/books`;
    });

    $('#authorsBtn').on('click', function () {
        window.location.href = `${url}/admin/authors`;
    });

    $('#publishersBtn').on('click', function () {
        window.location.href = `${url}/admin/publishers`;
    })

    $('#genresBtn').on('click', function () {
        window.location.href = `${url}/admin/genres`
    })

    $('#usersBtn').on('click', function () {
        window.location.href = `${url}/admin/users`
    })

    $('#logoutBtn').on('click', function () {
        window.location.href = `${url}/admin`;
    });

    $('#loginBtn').on('click', function () {
        window.location.href = `${url}/admin`;
    });

    // Select box control

    $('.select-box input[type=radio]').on('change', function () {
        $(this).parents('.select-box').find('.select-label').text($(this).parent().children('.item-label').text());
        $(this).parents('.select-box').find('.select-list').removeClass('d-block');
        $(this).parents('.select-box').find('.select-list').addClass('d-none');
    });

    $('.select-box[data-type="sortBooks"] input[type=radio]').on('click', function () {
        var searchItem = $('.search-item input[name="searchBook"]').val();
        var sort1 = $('.select-box input[name="sortBooks"]:checked').val();
        var sort2 = $('.select-box input[name="sortTypeBooks"]:checked').val();
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
            $('#daftarBookCont').empty();
            $('#daftarBookCont').append(generateBook(response));

            $('#addBookBtn').on('click', function () {
                window.location.href = `${url}/admin/addeditbook`
            });

            $('.editBookBtn').on('click', function () {
                var id = $(this).data('id');
                window.location.href = `${url}/admin/addeditbook/${id}`
            })

            // Js Fill Color

            $('.js-fillcolor').fillColor();
        });
    })

    $('.select-box[data-type="sortAuthors"] input[type=radio]').on('click', function () {
        var searchItem = $('.search-item input[name="searchAuthor"]').val();
        var sort1 = $('.select-box input[name="sortAuthors"]:checked').val();

        $.ajax({
            url: `${url}/searchauthor`,
            method: 'get',
            dataType: 'json',
            data: {
                'searchItem': searchItem,
                'sort1': sort1
            }
        }).done(function (response) {
            $('#daftarAuthorCont').empty();
            $('#daftarAuthorCont').append(generateAuthor(response));

            $('.editAuthorBtn').on('click', function () {
                var id = $(this).data('id');
                window.location.href = `${url}/admin/addeditauthor/${id}`
            })

            $('#addAuthorBtn').on('click', function () {
                window.location.href = `${url}/admin/addeditauthor`
            });

            // Js Fill Color

            $('.js-fillcolor').fillColor();
        });
    })

    $('.select-box[data-type="sortPublishers"] input[type=radio]').on('click', function () {
        var searchItem = $('.search-item input[name="searchPublisher"]').val();
        var sort1 = $('.select-box input[name="sortPublishers"]:checked').val();

        $.ajax({
            url: `${url}/searchpublisher`,
            method: 'get',
            dataType: 'json',
            data: {
                'searchItem': searchItem,
                'sort1': sort1
            }
        }).done(function (response) {
            $('#daftarPublisherCont').empty();
            $('#daftarPublisherCont').append(generatePublisher(response));

            $('#addPublisherBtn').on('click', function () {
                window.location.href = `${url}/admin/addeditpublisher`
            });

            $('.editPublisherBtn').on('click', function () {
                var id = $(this).data('id');
                window.location.href = `${url}/admin/addeditpublisher/${id}`
            })

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

    $('.search-item input[name="searchBook"]').on('keypress', function (event) {
        let keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            var searchItem = $('.search-item input[name="searchBook"]').val();
            var sort1 = $('.select-box input[name="sortBooks"]:checked').val();
            var sort2 = $('.select-box input[name="sortTypeBooks"]:checked').val();

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
                $('#daftarBookCont').empty();
                $('#daftarBookCont').append(generateBook(response));

                $('#addBookBtn').on('click', function () {
                    window.location.href = `${url}/admin/addeditbook`
                });

                $('.editBookBtn').on('click', function () {
                    var id = $(this).data('id');
                    window.location.href = `${url}/admin/addeditbook/${id}`
                })

                // Js Fill Color

                $('.js-fillcolor').fillColor();
            });
        }
    })

    $('.editBookBtn').on('click', function () {
        var id = $(this).data('id');
        window.location.href = `${url}/admin/addeditbook/${id}`
    })

    $('.search-item input[name="searchAuthor"]').on('keypress', function (event) {
        let keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            var searchItem = $('.search-item input[name="searchAuthor"]').val();
            var sort1 = $('.select-box input[name="sortAuthors"]:checked').val();

            $.ajax({
                url: `${url}/searchauthor`,
                method: 'get',
                dataType: 'json',
                data: {
                    'searchItem': searchItem,
                    'sort1': sort1
                }
            }).done(function (response) {
                $('#daftarAuthorCont').empty();
                $('#daftarAuthorCont').append(generateAuthor(response));

                $('.editAuthorBtn').on('click', function () {
                    var id = $(this).data('id');
                    window.location.href = `${url}/admin/addeditauthor/${id}`
                })

                $('#addAuthorBtn').on('click', function () {
                    window.location.href = `${url}/admin/addeditauthor`
                });

                // Js Fill Color

                $('.js-fillcolor').fillColor();
            });
        }
    })

    $('.editAuthorBtn').on('click', function () {
        var id = $(this).data('id');
        window.location.href = `${url}/admin/addeditauthor/${id}`
    })

    $('.search-item input[name="searchPublisher"]').on('keypress', function (event) {
        let keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            var searchItem = $('.search-item input[name="searchPublisher"]').val();
            var sort1 = $('.select-box input[name="sortPublishers"]:checked').val();

            $.ajax({
                url: `${url}/searchpublisher`,
                method: 'get',
                dataType: 'json',
                data: {
                    'searchItem': searchItem,
                    'sort1': sort1
                }
            }).done(function (response) {
                $('#daftarPublisherCont').empty();
                $('#daftarPublisherCont').append(generatePublisher(response));

                $('#addPublisherBtn').on('click', function () {
                    window.location.href = `${url}/admin/addeditpublisher`
                });

                $('.editPublisherBtn').on('click', function () {
                    var id = $(this).data('id');
                    window.location.href = `${url}/admin/addeditpublisher/${id}`
                })

                // Js Fill Color

                $('.js-fillcolor').fillColor();
            });
        }
    })

    $('.editPublisherBtn').on('click', function () {
        var id = $(this).data('id');
        window.location.href = `${url}/admin/addeditpublisher/${id}`
    })

    $('.editGenreBtn').on('click', function () {
        var id = $(this).data('id');
        window.location.href = `${url}/admin/addeditgenre/${id}`
    })

    // Image Upload control

    $('.imgUpload input[type="file"]').on('change', function () {
        $(this).parent().children('.imgText').text($(this)[0].files[0].name);
        $(this).parent().children('input[name="imageStatus"]').val('add');
    })

    $('#deleteImage').on('click', function () {
        $(this).parents('.imgUpload').children('input[type="file"]').val('');
        $(this).parents('.imgUpload').children('.imgText').text('Upload file');
        $(this).parents('.imgUpload').children('input[name="imageStatus"]').val('delete');
    })

    // Function to generate book item

    function generateBook(response) {
        var elementAdd = `
            <div class="col-xl-2 col-lg-3 col-md-4 col-12 p-1">
                <div class="d-flex h-100 w-100">
                    <button class="card-menu-body d-flex flex-column flex-wrap flex-grow-1 style-2 color-3 p-5 justify-content-center align-items-center col-12 h-100" id="addBookBtn">
                        <i class="fa-solid fa-circle-plus p-1" style="font-size:50px"></i>
                        <p class="p-1">Add book</p>
                    </button>
                </div>
            </div>`;
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
                        <div class="card-menu-footer d-flex col-12 flex-wrap">
                            <button class="color-3 style-2 col-6 editBookBtn" data-id="${response['book'][i][0]['id']}">Edit</button>
                            <form action="" class="d-inline col-6" method="POST">
                                <input type="hidden" name="<?= csrf_token() ?>" value="${response['token']}" />
                            <button class="w-100 h-100 color-2 style-1" name = "id" value = "${response['book'][i][0]['id']}" > Delete</button>
                            </form>
                        </div>
                    </div>
                </div> `
            }
        }
        return elementAdd;
    }

    // Function to generate author

    function generateAuthor(response) {
        var elementAdd = `
            <div class="col-xl-2 col-lg-3 col-md-4 col-12 p-1">
                <div class="d-flex h-100 w-100">
                    <button class="card-menu-body d-flex flex-column flex-wrap flex-grow-1 style-2 color-3 p-5 justify-content-center align-items-center col-12 h-100" id="addAuthorBtn">
                        <i class="fa-solid fa-circle-plus p-1" style="font-size:50px"></i>
                        <p class="p-1">Add author</p>
                    </button>
                </div>
            </div>`;
        if (response['author'] != null) {
            for (i = 0; i < response['author'].length; i++) {
                elementAdd += `
                    <div class="col-xl-2 col-lg-3 col-md-4 col-12 p-1" >
                        <div class="d-flex flex-md-column flex-row flex-wrap style-2 h-100">
                            <div class="d-flex align-items-center justify-content-center col-md-12 col-4 js-fillcolor" style="height: 300px">
                                <img src="${url}/administrator/image_upload/penulis/${response['author'][i]['image']}" class="card-img-menu" alt="${response['author'][i]['image']}">
                            </div>
                            <hr class="m-0 d-none d-md-block">
                                <div class="card-menu-body d-flex flex-grow-1 flex-column p-2 col-md-12 col-8 justify-content-md-start justify-content-center">
                                    <h5 class="card-title mb-2">ID: ${response['author'][i]['id']}</h5>
                                    <h6 class="card-title">${response['author'][i]['name']}</h6>
                                    <h6 class="card-subtitle mb-2">${response['author'][i]['birthdate']}</h6>
                                </div>
                                <div class="card-menu-footer d-flex col-12 flex-wrap">
                                    <button class="color-3 style-2 col-6 editAuthorBtn" data-id="${response['author'][i]['id']}">Edit</button>
                                    <form action="" class="d-inline col-6" method="POST">
                                        <input type="hidden" name="csrf_token_name" value="${response['token']}" />
                                        <button class="w-100 h-100 color-2 style-1" name="id" value="${response['author'][i]['id']}">Delete</button>
                                    </form>
                                </div>
                        </div>
                </div> `;
            }
        }
        return elementAdd;
    }

    // Function to generate publisher

    function generatePublisher(response) {
        var elementAdd = `
            <div class="col-xl-2 col-lg-3 col-md-4 col-12 p-1">
                <div class="d-flex h-100 w-100">
                    <button class="card-menu-body d-flex flex-column flex-wrap flex-grow-1 style-2 color-3 p-5 justify-content-center align-items-center col-12 h-100" id="addPublisherBtn">
                        <i class="fa-solid fa-circle-plus p-1" style="font-size:50px"></i>
                        <p class="p-1">Add publisher</p>
                    </button>
                </div>
            </div>`;
        if (response['publisher'] != null) {
            for (i = 0; i < response['publisher'].length; i++) {
                elementAdd += `
                    <div class="col-xl-2 col-lg-3 col-md-4 col-12 p-1" >
                        <div class="d-flex flex-md-column flex-row flex-wrap style-2 h-100">
                            <div class="d-flex align-items-center justify-content-center col-md-12 col-4 js-fillcolor px-2" style="height: 300px; filter: invert(100%); -webkit-filter: invert(100%);-moz-filter: invert(100%);-o-filter: invert(100%);-ms-filter: invert(100%);">
                                <img src="${url}/administrator/image_upload/penerbit/${response['publisher'][i]['image']}" class="card-img-menu" alt="${response['publisher'][i]['image']}" style="filter: invert(100%); -webkit-filter: invert(100%);-moz-filter: invert(100%);-o-filter: invert(100%);-ms-filter: invert(100%);">
                            </div>
                            <hr class="m-0 d-none d-md-block">
                                <div class="card-menu-body d-flex flex-grow-1 flex-column p-2 col-md-12 col-8 justify-content-md-start justify-content-center">
                                    <h5 class="card-title mb-2">ID: ${response['publisher'][i]['id']}</h5>
                                    <h6 class="card-subtitle">${response['publisher'][i]['name']}</h6>
                                </div>
                                <div class="card-menu-footer d-flex col-12 flex-wrap">
                                    <button class="color-3 style-2 col-6 editPublisherBtn" data-id="${response['publisher'][i]['id']}">Edit</button>
                                    <form action="" class="d-inline col-6" method="POST">
                                        <input type="hidden" name="csrf_token_name" value="${response['token']}" />
                                        <button class="w-100 h-100 color-2 style-1" name="id" value="${response['publisher'][i]['id']}">Delete</button>
                                    </form>
                                </div>
                        </div>
                </div> `;
            }
        }
        return elementAdd;
    }

    // Add author

    $('#addBookBtn').on('click', function () {
        window.location.href = `${url}/admin/addeditbook`
    });

    $('#addAuthorBtn').on('click', function () {
        window.location.href = `${url}/admin/addeditauthor`
    });

    $('#addPublisherBtn').on('click', function () {
        window.location.href = `${url}/admin/addeditpublisher`
    });

    $('#addGenreBtn').on('click', function () {
        window.location.href = `${url}/admin/addeditgenre`
    });
})