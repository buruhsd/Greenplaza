function copyToClipboard(elem) {
    if (document.selection) { 
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById(containerid));
        range.select().createTextRange();
        document.execCommand("copy"); 
    } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById(containerid));
        window.getSelection().addRange(range);
        document.execCommand("copy");
        alert("text copied") 
    }
      // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
          succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}

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
                    $('#ajax-modal2').empty().append(data).modal();
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
function modal_post2(e, data=''){
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
                    $('#ajax-modal2').empty().append(data).modal();
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
function showNotifications(notifications, target, url) {
    if(Object.keys(notifications).length) {
        $(target).children("span").children("i").removeClass('faa-vertical');
        $(target + '-notif').children("li#no-notif").remove();
        var htmlElements = makeNotification(notifications, url);
        var htmlMainElements = makeMainNotification();
        $(target + '-notif').prepend(htmlElements);
        // $(target + '-notif').html(htmlElements);
        $(target).children("span").children("i").addClass('faa-vertical');
        $(target).children("span").removeClass('hidden');
    } else {
        // $(target + '-notif').html('<li class="dropdown-header">No notifications</li>');
        $(target).children("span").children("i").removeClass('faa-vertical');
        $(target).children("span").addClass('hidden');
    }
}
function makeNotification(notification, url) {
    var to = routeNotification(url);
    var notificationText = makeNotificationText(notification);
    return '<li><a href="' + to + '">' + notificationText + '</a></li>';
}
function makeMainNotification(){
    return '<i class="fa fa-bell animated"></i><span class="text-danger"><i class="fa fa-exclamation-triangle animated"></i></span>';
}
function routeNotification(url) {
    var to = url;
    return to;
}
function makeNotificationText(notification) {
    var text = '';
    const title = notification.title;
    const message = notification.message;
    text += '<strong>' + title + '</strong>  <small>' + message + '</small>';
    return text;
}