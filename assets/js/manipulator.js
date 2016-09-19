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

        $.ajax({
            url: "/ajax/getArticle.php",
            type: "POST",
            data: {
                id: $(this).attr('id')
            },
            beforeSend: function () {
                CKEDITOR.instances['editContent'].setData('<div style="height: 100%; width: 100%; text-align: center"><img style="top:49%" src="/assets/img/waitLine.gif"></div>');
            },
            success: onLoadArticle
        });

/*        $.post(
            "/ajax/getArticle.php",
            {
                id: $(this).attr('id')
            },
            onLoadArticle
        );/**/
        
    });

function onLoadArticle(data) {
    var arr = data.split("+split+");
    //console.log(arr);
    $("#editTitle").val(arr[0]);
    CKEDITOR.instances['editContent'].setData(arr[1]);
}

$('#btnYes').click(function (e) {
    alert ('Delete');
    $('#confirmModal').modal('hide');
});
//    show confirm dialog on Delete button

$('#btnDelete').click(function () {
    $('#editModal').modal('hide');
    $('#confirmModal').modal('show');

});
//  END  show  confirm dialog on Delete button

// Save

$('btnSave').click(function (e) {

});

