$(function () {
    $('.optionOne_show').each(function () {
        $(this).click(function () {
            optionOneId = $(this).find('.optionOne_id').text().trim();
            productId = $(this).find('.product_id').text().trim();
            description = $(this).find('.description').text().trim();
            //alert(description);
            $.ajax({
                type: "get",
                url: "/seller/optionTwoCreate",
                data: { productId: productId, optionOneId: optionOneId, description: description },
                chche: false,
                success: function (data) {
                    $('.optionTwoCreate_section').empty().append(data);
                    $('#txtOptionOneId').val(optionOneId);
                    $('.my_loader').hide();
                },
                error: function (data) {
                    alert("/seller/optionTwoCreate 시스템에러...");
                    $('.my_loader').hide();                   
                }
            });
            return false;
        })
    })    
});