$(document).ready(function () {
    $.ajax({
        url: Routing.generate('app_beneficiary_resume', {'id': id}),
        type: 'POST',
        dataType: 'json',
        async: false,
        success: function (response) {
            $("#hero-content").append(response)
        }
    })

    $("#resume").click(function () {
        $("#hero-content").empty()
        showData("app_beneficiary_resume", "POST")
    })
})

function showData(input, type) {
    $.ajax({
        url: Routing.generate('app_beneficiary_resume', {'id': id}),
        type: type,
        dataType: 'json',
        async: true,
        success: function (response) {
            $("#hero-content").append(response)
        }
    })
}