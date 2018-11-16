
function modal_get(e){
    $.ajax({
        type: e.data('method'), // or post?
        url: e.data('href'), // change as needed
        success: function(data) {
            if (data) {
                $('#ajax-modal').empty().append(data).modal();
            } else {
                alert(data);
            }
        },
        error: function(xhr, textStatus) {
            alert(xhr.status+'\n'+textStatus);
        }
    });
}
function modal_post(e, data=''){
    $.ajax({
        type: e.data('method'), // or post?
        url: e.data('href'), // change as needed
        data: data, // change as needed
        success: function(data) {
            if (data) {
                $('#ajax-modal').empty().append(data).modal();
            } else {
                alert(data);
            }
        },
        error: function(xhr, textStatus) {
            alert(xhr.status+'\n'+textStatus);
        }
    });
}

function modal_get2(e){
    $.ajax({
        type: e.data('method'), // or post?
        url: e.data('href'), // change as needed
        success: function(data) {
            if (data) {
                $('#ajax-modal2').empty().append(data).modal();
            } else {
                alert(data);
            }
        },
        error: function(xhr, textStatus) {
            alert(xhr.status+'\n'+textStatus);
        }
    });
}
function modal_post2(e, data=''){
    $.ajax({
        type: e.data('method'), // or post?
        url: e.data('href'), // change as needed
        data: data, // change as needed
        success: function(data) {
            if (data) {
                $('#ajax-modal2').empty().append(data).modal();
            } else {
                alert(data);
            }
        },
        error: function(xhr, textStatus) {
            alert(xhr.status+'\n'+textStatus);
        }
    });
}