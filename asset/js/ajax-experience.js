console.log('Ok Ajax experience');

const allExp = [];

$(document).ready(function () {

    const addMoreExp = $('#addMoreExp');
    const errorPredate = $('#error_predate');
    const errorLastdate = $('#error_lastdate');
    const errorPostname = $('#error_post_name');
    const errorEntreprisename = $('#error_entreprise_name');
    const errorPostplace = $('#error_post_place');
    const errorPostdescription = $('#error_post_description');

    $('#experience_cv').on('submit', function (e) {
        // ajax
        e.preventDefault();

        const predate = $('#js_predate').val();
        const lastdate = $('#js_lastdate').val();
        const postname = $('#js_post_name').val();
        const entreprisename = $('#js_entreprise_name').val();
        const postplace = $('#js_post_place').val();
        const postdescription = $('#js_post_description').val();

        console.log('Clicked : OK');
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'ajax_experience',
                predate: predate,
                lastdate: lastdate,
                postname: postname,
                entreprisename: entreprisename,
                postplace: postplace,
                postdescription: postdescription,
            },
            beforeSend: function () {
                console.log('ajax start : salut');
                $('.error').html('')
            },
            success: function (res) {
                console.log(res);
                dataFinal.push(res);
                if (res.success2) {
                    //retirer la possibilité de soumettre une deuxieme fois le formulaire
                    // submitButton2.prop("disabled", true)
                    allExp.push(res);
                    console.log(allExp);
                } else {
                    //if success envoie form
                    if (res.errors.predate != null) {
                        errorPredate.html(res.errors.predate)
                    }
                    if (res.errors.lastdate != null) {
                        errorLastdate.html(res.errors.lastdate)
                    }
                    if (res.errors.postname != null) {
                        errorPostname.html(res.errors.postname)
                    }
                    if (res.errors.entreprisename != null) {
                        errorEntreprisename.html(res.errors.entreprisename)
                    }
                    if (res.errors.postplace != null) {
                        errorPostplace.html(res.errors.postplace)
                    }
                    if (res.errors.postdescription != null) {
                        errorPostdescription.html(res.errors.postdescription)
                    }
                }
            }
        })
    })
})

