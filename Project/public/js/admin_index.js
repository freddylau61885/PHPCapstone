$(document).ready(function () {
    // flesh message close button
    $('div.alert-flesh button.flesh-btn-close').click(function () {
        $('div.alert-flesh').hide();
    });


    let url = window.location.origin;

    //remove single image in animal edit page
    $('.removeImgs').click(function () {
        img_id = $(this).attr('img_id');
        id = $(this).attr('id');
        $.post("/deleteimg", JSON.stringify({ img_id: img_id })).done(
            function (d) {
            console.log(d);
            window.location.href = `${url}/add_edit?id=${id}`;
        }).fail(function () {
            console.log(d);
            window.location.href = `${url}/add_edit?id=${id}`;
        });
    });

    //init data table
    $('#admin_table,#logs_table').DataTable({ searching: false });
});