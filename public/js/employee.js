$(document).ready(function () {
    $("#function_link").on('click', function () {
        ajaxCall('app_employee_function_ajax', {'id': user_id})
    });
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

function ajaxCallDelete(url, data,type, id) {
    $.ajax({
        url: Routing.generate(url, data),
        type: 'POST',
        data: data,
        dataType: 'json',
        async: true,
        success: function () {
            $('#' + type + id).remove()
        },
        error: function (response) {
            console.log(response)
        }
    })
}