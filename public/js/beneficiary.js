$(document).change(function () {
    if ($('#beneficiary_status').val() === '2') {
        $('#beneficiary_status').after("<p style='color: red; font-size: 13px; margin-left: 0.5rem!important;' id='user_payment_alert'>Un bénéficaire ne peut pas être un prestataire, merci de corriger</p>")
        $('.btn').prop('disabled', true)
    } else {
        $('#user_payment_alert').remove()
        $('.btn').prop('disabled', false)
    }
})

$(document).ready(function () {
    $("#localisation_link").on('click', function () {
        ajaxCall('app_beneficiary_localisation_ajax', {'id': user_id})
    });
    $("#formation_link").on('click', function () {
        ajaxCall('app_beneficiary_formation_ajax', {'id': user_id})
    });

    $("#general_link").on('click', function () {
        ajaxCall('app_beneficiary_detail', {'id': user_id})
    });

    $("#health_link").on('click', function () {
        ajaxCall('app_beneficiary_health_ajax', {'id': user_id})
    })

    $("#behaviour_link").on('click', function () {
        ajaxCall('app_beneficiary_behaviour_ajax', {'id': user_id})
    })

    $("#interview_link").on('click', function () {
        ajaxCall('app_beneficiary_interview_ajax', {'id': user_id})
    })

})

function ajaxCall(url, data) {
    $.ajax({
        url: Routing.generate(url, data),
        type: 'POST',
        data: data,
        dataType: 'json',
        async: true,
        success: function (response) {
            $('#general_information').html(response)
        },
    })
}