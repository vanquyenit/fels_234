(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=1623335627974998";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
$(window).on('load', function(e) {
    if (window.location.hash == '#_=_') {
        window.location.hash = '';
        history.pushState('', document.title, window.location.pathname);
        e.preventDefault();
    }
    var check = $("#thongbao").html();
    var error = $("#error").html();
    if (error != '') {
        alert(error);
    }
    if (check == 1) {
        $("#register").modal('show');
    }
})
$(".header-profile-wrapper").on('click', function() {
    $(".header-profile-inner").toggle("slow", function() {
        $(".header-profile-inner").addClass('is-active');
    });
});
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name=_token]').attr('content')
        }
    });
    $('.delete_course').on('click', function() {
        var id = $(this).data('id');
        if (confirm($('#confirmDelete').val()) == true) {
            $('#' + id).slideUp(300);
        }
    })
    $('.progress-bar').each(function() {
        var data_ = $(this).attr('data-progress');
        $(this).css('width', data_ + '%');
    });
    $('.bar-success').each(function() {
        var data = $(this).attr('data-progress');
        $(this).css('width', data + '%');
    });
    $('.mempal-button').on('click', function() {
        var elem = $(this).find('input[type="hidden"]');
        var dataFollow = elem.val();
        var id = $(this).data('user-id');
        var unfollow = $(this).data('unfollow');
        var follow = $(this).data('follow');
        var username = $(this).data('fullname');
        var idUser = $(this).closest('.people-rows').attr('data-user-follow');
        var this_ = $(this);
        var action = $(this).data('action');
        $.ajax({
            url: action,
            type: 'POST',
            data: {
                id: id,
                follow: dataFollow,
                idUser: idUser,
                username: username
            },
            success : function (data) {
                if (data == 1) {
                    this_.removeClass('green');
                    this_.find('.text').text(unfollow);
                } else {
                  this_.addClass('green')
                  this_.find('.text').text(follow);
              }
            }
        })
    })
});
