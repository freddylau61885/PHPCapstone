$(document).ready(function () {
    // flesh message close button
    $('div.alert-flesh button.flesh-btn-close').click(function () {
        $('div.alert-flesh').hide();
    });

    let url = window.location.origin;
    //filter for adopt page 
    $('#dogFilterAndSearch select').change(function () {
        let selected = [];
        $.each($('#dogFilterAndSearch select option:selected'), function () {
            selected.push($(this).val());
        });
        if (selected) {
            window.location.href =                
            `${url}/dogadop?b=${selected[0]}&a=${selected[1]}&g=${selected[2]}`;
        }
    });

    //adopt button
    $("#adopButton").click(function () {
        let con = confirm("Are you confirm to apply for adopt this animal?");
        if (con) {
            let id = $("#dog_detail_field div.dogDetailContainer ul li:eq(0)")
            .text();
            id = id.split(": ")[1];
            $.post("/adopanimal", JSON.stringify({ ani_id: id })).done(
                function (d) {
                // console.log(d);                      
                window.location.href = `${url}/dogdetails?id=${id}`;
            }).fail(function () {
                // console.log(d);               
                window.location.href = `${url}/dogdetails?id=${id}`;
            });
        }
    });

    //image slide in animal detail page
    var imgIndex = 0;
    carousel();

    function carousel() {
        let i;
        let x = $(".imgSlides");
        for (i = 0; i < x.length; i++) {
            $(x[i]).hide();
        }
        imgIndex++;
        if (imgIndex > x.length) {
            imgIndex = 1;
        }
        $(x[imgIndex - 1]).show();
        setTimeout(carousel, 2000);
    }

});