
function modal_get(e){
    var val = (typeof e.val() && e.val() != null && e.val() != '')?e.val():e.html();
    $.ajax({
        type: e.data('method'), // or post?
        url: e.data('href'), // change as needed
        beforeSend:function(){
            (typeof e.val() && e.val() != null && e.val() != '')?e.val("loading"):e.html("loading");
        },
        success: function(data) {
            if (data) {
                if(typeof data.status !== 'undefined' && data.status == 500){
                    swal({   
                        type: "error",
                        title: "failed",   
                        text: data.message,   
                        showConfirmButton: false ,
                        showCloseButton: true,
                        footer: ''
                    });
                }else{
                    $('#ajax-modal').empty().append(data).modal();
                }
            } else {
                alert(data);
            }
            (typeof e.val() && e.val() != null && e.val() != '')?e.val(val):e.html(val);
        },
        error: function(xhr, textStatus) {
            alert(xhr.status+'\n'+textStatus);
        }
    });
}
function modal_post(e, data=''){
    var val = (typeof e.val() && e.val() != null && e.val() != '')?e.val():e.html();
    $.ajax({
        type: e.data('method'), // or post?
        url: e.data('href'), // change as needed
        data: data, // change as needed
        beforeSend:function(){
            (typeof e.val() && e.val() != null && e.val() != '')?e.val(val):e.html(val);
        },
        success: function(data) {
            if (data) {
                if(typeof data.status !== 'undefined' && data.status == 500){
                    swal({   
                        type: "error",
                        title: "failed",   
                        text: data.message,   
                        showConfirmButton: false ,
                        showCloseButton: true,
                        footer: ''
                    });
                }else{
                    $('#ajax-modal').empty().append(data).modal();
                }
            } else {
                alert(data);
            }
            (typeof e.val() && e.val() != null && e.val() != '')?e.val(val):e.html(val);
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
function checkDecimal(el){
    // var RE = ^\d*\.?\d{0,2}$
    // if(RE.test(value)){
    //     return true;
    // }else{
    //     el.value = el.value.substring(0,el.value.length - 1);
    // }
    var ex = /^[0-9]+\.?[0-9]*$/;
    if(ex.test(el.value)==false){
        el.value = el.value.substring(0,el.value.length - 1);
    }
}
