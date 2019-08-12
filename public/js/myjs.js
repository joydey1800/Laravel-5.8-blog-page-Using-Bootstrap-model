// {{-- ajax Form Add Post--}}

$("#add").click(function () {
    $.ajax({
        type: "POST",
        url: "posts",
        data: {
            _token: $("input[name=_token]").val(),
            title: $("input[name=title]").val(),
            body: $("input[name=body]").val()
        },
        success: function (data) {
            $('#alltablepost').append("<div class='card m-3'>" +
                "<div class='card-header'>" +
                "< h3 > <strong>" + data.body + "</strong></h3 >" +
                "</div>" +
                "<div class='row no-gutters'>" +
                "<div class='col-md-1'>" +
                "<img src='' class='card-img img-thumbnail rounded' alt='JBlog'></div>" +
                "<div class='col-md-11'>" +
                "<div class='card-body'>" +
                "<h5 class='card-title'>" + data.body + "</h5>" +
                "<br>" +
                "<a class='btn btn-secondary btn-sm' href=''>Read More</a>" +
                "<hr>" +
                "<p class='card-text'>" +
                "<small class='text-muted float-left'>Created By: <strong>JOYDEY</strong></small>" +
                "<small class='text-muted float-right'>" + data.created_at + "</small></p>" +
                "</div></div></div></div>");
        }

    });
    $('#title').val('');
    $('#body').val('');
});
