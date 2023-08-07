$(document).ready(function() {
    $("#fb-comment-chapter").hide();
    function checkButtonClick(e)
    {
        e.preventDefault();
        btn1  = $(".toggle-nav-open");
        span1 = btn1.children('span');

        if(span1.hasClass('glyphicon-menu-up'))
        {
            span1.removeClass('glyphicon-menu-up');
            span1.addClass('glyphicon-menu-down');
            $("#chapterBody").attr("style", "margin-top: 10px;");
        }
        else
        {
            span1.removeClass('glyphicon-menu-down');
            span1.addClass('glyphicon-menu-up');
            $("#chapterBody").attr("style","margin-top: 0px;");
        }
        $("#nav").slideToggle();
        return false;
    }
    $(".toggle-nav-open").click(checkButtonClick);
    // Comment
    $("#chapter_comment").click(function(e){
        e.preventDefault();
        $("#fb-comment-chapter").toggle();
        return false;
    });
    // show list chapter
    $(".goToChapter").hide();
    $(".btnGoToChapter").on('click',function(e){
        e.preventDefault();
        $(".btnGoToChapter").hide();
        $(".goToChapter").show();
        return false;
    });

    // update index new list
    $("#new-select").change(function(e){
        e.preventDefault();
        categoryID =  $(this).children("option:selected").attr("value");
        $.ajax({
            url: '/api/new-post',
            type: 'POST',
            dataType: 'text',
            data: {'categoryID': categoryID},
            success: function(data){
                $(".col-truyen-main").children(".row").remove();
                $(".col-truyen-main").append(data);
            },
        });
    });

    $("#hot-select").change(function(e){
        e.preventDefault();
        categoryID =  $(this).children("option:selected").attr("value");
        $.ajax({
            url: '/api/hot-post',
            type: 'POST',
            dataType: 'text',
            data: {'categoryID': categoryID},
            success: function(data){
                $(".index-intro").children("div").remove();
                $(".index-intro").append(data);
            },
        });
    });

    $("#contact-form").on('submit', function(e){
        e.preventDefault();
        var token = $('input[name="_token"]').val();
        var name  = $("#contact-name").val();
        var email  = $("#contact-email").val();
        var subject  = $("#contact-subject").val();
        var message  = $("#contact-message").val();

        $.ajax({
            url: '/contact',
            type: 'POST',
            dataType: 'text',
            data: {'_token': token, '_method': 'PUT', 'name': name, 'email': email, 'subject': subject, 'messageTxt': message},
            success: function(data){
                $(".well-sm").html('<div class="alert alert-success" role="alert">' + data + '</div>');
            },
        });
        return false;
    });

    $(".showmore a").on('click', function(){ $(".desc .desc-text.desc-text-full").css('height', 'auto'); $(this).parent().hide(); });

    $("#chapter_error").on("click", function(e){
        e.preventDefault();
        var reportMessenge = prompt("Nội dung lỗi", "");
        var chapter_id     = $(this).attr('chapter-id');
        if (reportMessenge != "") {
            $.ajax({
                url: '../api/report-chapter',
                type: 'POST',
                dataType: 'text',
                data: {'chapterID': chapter_id, 'reportMessenge': reportMessenge},
                success: function(data){
                    alert("Cảm ơn bạn đã thông báo lỗi cho chúng tôi, chúng tôi sẽ khắc phục trong khoảng thời gian sớm nhất ! ");
                    $(this).hide();
                },
            });
        }
        else {
            alert("Bạn không nhập gì cả ?");
        }

    });

    $('*').bind('cut copy paste contextmenu', function (e) {
        e.preventDefault();
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#payment_chapter').click(function () {
        var url = $(this).attr('url');
        var point = $(this).attr('point');
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {
                'point' : point
            },
            success: function(result){
                if (result.code == 2) {
                    alert("Đã xảy ra lỗi bạn không đủ linh thạch để thanh toán")
                } else {
                    $url = window.location.href;
                    window.location.href = $url;
                }
            },
        });

    })

    if (event.keyCode == 123) {
        return false;
    }
    else if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74)) {
        return false;
    }

    document.onkeydown = function(e) {
        if (event.keyCode == 123) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }
    }
});

document.addEventListener('contextmenu', event => event.preventDefault());
document.onkeypress = function (event) {
    event = (event || window.event);
    if (event.keyCode == 123) {
        return false;
    }
}
document.onmousedown = function (event) {
    event = (event || window.event);
    if (event.keyCode == 123) {
        return false;
    }
}
document.onkeydown = function (event) {
    event = (event || window.event);
    if (event.keyCode == 123) {
        return false;
    }
}

jQuery(document).ready(function($){
    $(document).keydown(function(event) {
        var pressedKey = String.fromCharCode(event.keyCode).toLowerCase();

        if (event.ctrlKey && (pressedKey == "c" || pressedKey == "u")) {
            return false;
        }
    });
});
