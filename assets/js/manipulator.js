var id;

$('.editable')
    .on('mouseover mouseout',function () {

    //this.classList.toggle('panel-warning')
        if (!$(this).hasClass('panel-warning')) $(this).addClass('panel-warning');
    })
    .on('mouseout',function(){
        if ($(this).hasClass('panel-warning')) $(this).removeClass('panel-warning');
    })

    .on('click',function () {
        //alert(this.getAttribute('id'));
        //confirm($(this).attr('id'));

        // show editor  '<div style="text-align: center"><img src="/assets/img/waitLine.gif"></div>'
        $('#editModal').modal('show');

        id = $(this).attr('id');

        $.ajax({
            url: "/ajax/getArticle.php",
            type: "POST",
            data: {
                id: id
            },
            beforeSend: function () {
                //CKEDITOR.instances['editContent'].setData('<div style="height: 100%; width: 100%; text-align: center"><img style="top:49%" src="/assets/img/waitLine.gif"></div>');
            },
            success: onLoadArticle
        });
        
    });

function onLoadArticle(data) {
    var arr = data.split("+split+");
    //console.log(arr);
    $("#editTitle").val(arr[0]);
    CKEDITOR.instances['editContent'].setData(arr[1]);
}

//   confirm on Yes button
$('#btnYes').click(function (e) {
    $.ajax({
        url: "/ajax/deleteArticle.php",
        type: "POST",
        data: {
            id: id
        },
        beforeSend: function () {
            CKEDITOR.instances['editContent'].setData('<div style="height: 100%; width: 100%; text-align: center"><img style="top:49%" src="/assets/img/waitLine.gif"></div>');
        },
        success: function ($data) {
            //alert($data);
            location.reload();
        },
        complete: function () {
            $('#confirmModal').modal('hide');
        }
    });
});
//   confirm on Delete button

$('#btnDelete').click(function () {
    $('#editModal').modal('hide');
    $('#confirmModal').modal('show');

});
//  END  show  confirm dialog on Delete button

// Save

$('#btnSave').click(function (e) {
    var title = $("#editTitle").val();
    var content = CKEDITOR.instances['editContent'].getData();

    $.ajax({
        url: "/ajax/setArticle.php",
        type: "POST",
        data: {
            id: id,
            title: title,
            content: content
        },
        beforeSend: function () {
            CKEDITOR.instances['editContent'].setData('<div style="height: 100%; width: 100%; text-align: center"><img style="top:49%" src="/assets/img/waitLine.gif"></div>');
        },
        success: function ($data) {
            //alert($data);
            location.reload();
        },
        complete: function () {
            $('#editModal').modal('hide');
        }
    });
});


