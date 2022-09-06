$(document).change(function () {
    if ($('#beneficiary_status').val() === '2') {
        $('#beneficiary_status').after("<p style='color: red; font-size: 13px; margin-left: 0.5rem!important;' id='user_payment_alert'>Un bénéficaire ne peut pas être un prestataire, merci de corriger</p>")
        $('.btn').prop('disabled', true)
    } else {
        $('#user_payment_alert').remove()
        $('.btn').prop('disabled', false)
    }

})