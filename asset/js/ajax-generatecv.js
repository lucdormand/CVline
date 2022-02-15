console.log('Ok Ajax global');

$(document).ready(function() {

    const submitButton = $('#js_submitted_global');
    const errorSurname = $('#error_surname');
    const errorName = $('#error_name');
    const errorEmail = $('#error_mail');

    $('#global_cv').on('submit', function (e) {
        // ajax
        e.preventDefault();

        const surname = $('#js_surname').val();
        const name = $('#js_name').val();
        const email = $('#js_email').val();
        const adress = $('#js_adress').val();
        const postal = $('#js_postal').val();
        const city = $('#js_city').val();

        console.log('Clicked');
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'ajax_generatecv',
                surname: surname,
                name: name,
                email: email,
                adress: adress,
                postal: postal,
                city: city,
            },
            beforeSend: function () {
                console.log('ajax start : ok');
                $('.error').html('')
            },
            success: function (res) {
                console.log(res);

                if (res.success) {
                    //retirer la possibilité de soumettre une deuxieme fois le formulaire
                    submitButton.prop("disabled", true)
                } else {
                    //if success envoie form
                    if (res.errors.surname != null){
                        errorSurname.html(res.errors.surname)
                    }
                    if (res.errors.name != null) {
                        errorName.html(res.errors.name)
                    }
                    if (res.errors.email != null) {
                        errorEmail.html(res.errors.email)
                    }
                }
            }
        })
    })
})