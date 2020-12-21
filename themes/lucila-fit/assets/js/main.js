jQuery(function () {
    new WOW().init();
    var height = jQuery(window).height();

    jQuery('.primary-menu-container').height(height);
    jQuery('#saveVideo').on('click', function () {
        jQuery(this).children('i').removeClass('far');
        jQuery(this).children('i').addClass('fas');
        jQuery(this).addClass('video-save');

    });
    jQuery('#btnLogin').on('click', function () {
        jQuery(this).prop('disabled', true);
        let mail = jQuery('#email').val();
        let pass = jQuery('#password').val();
        let divResponse = jQuery('#errorLogin');
        let error = false;
        if ((/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail) === false) || mail === "") {
            divResponse.removeClass('hidden');
            divResponse.append('El correo eléctronico es invalido');
            error = true;
            return false;
        }
        if (pass === null || pass === undefined || pass === "") {
            divResponse.removeClass('hidden');
            divResponse.append('La contraseña esta vácia');
            error = true;
            return false;
        }
        if (!error) {
            jQuery.ajax({
                url: settings.ajax_url,
                type: 'POST',
                dataType: 'json',
                data: {
                    'action': 'lucila_login_fronted',
                    'email': mail,
                    'password': pass
                },
                success: function (response) {
                    let data = response;
                    if (data.status === 'error') {
                        divResponse.append(result.message);
                        divResponse.removeClass('hidden');
                    } else {
                        divResponse.removeClass('hidden alert-warning');
                        divResponse.addClass('alert-success');
                        divResponse.html("Inicio de sesión exitoso");
                        window.location.replace(data.url);
                    }
                }
            });

        } else {
            setTimeout(1500, function () {
                divResponse.addClass('hidde');
                divResponse.empty();
            });
        }
        jQuery(this).prop('disabled', false);

    });

    //video
    jQuery('video').on('play', function (e) {
        let count = jQuery(this).data('count');
        if (count < 2) {
            count++;
            jQuery(this).data('count', count);
        } else {
            return false;
        }

        let info = jQuery(this).closest('#videoContent').find('.start-rutine');

        if (!info.hasClass('hidden')) {
            info.addClass('hidden');
        }
        let postId = jQuery(this).data('postid');
        let userId = jQuery(this).data('userid');
        if (userId === null || userId === undefined || userId === "") {
            return false;
        }
        jQuery.ajax({
            url: settings.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                'action': 'save_video_data',
                'post-id': postId,
                'user-id': userId
            },
            success: function (response) {
                let data = response;
                if (data.status === 'success') {
                    info.removeClass('hidden');
                }
            }
        });
     /*   setTimeout(1500, function () {
            info.addClass('hidden');
        });*/
    });


    jQuery('video').on('ended', function () {
        let postId = jQuery(this).data('postid');
        let userId = jQuery(this).data('userId');
        if (userId === null || userId === undefined || userId === "") {
            return false;
        }
        jQuery.ajax({
            url: settings.ajax_url,
            type: 'POST',
            dataType: 'json',
            data: {
                'action': 'lucila_video_end',
                'post-id': postId,
                'user-id': userId
            },
            success: function (response) {
                let data = response;
                let progreso = jQuery(this).children('.ended-video');
                if (data.status === 'success') {
                    progreso.removeClass('hidden');
                }
            }
        });

    });

});