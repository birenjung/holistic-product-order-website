$('#place_order').click(function(e){
    e.preventDefault() ;        
    let cName = $('#c-name').val() ;
    let cPhone = $('#c-phone').val() ;
    let cEmail = $('#c-email').val() ;
    let cAddress = $('#c-address').val() ;
    let payMode = $("input[name='pay-mode']:checked").val();

    $.ajax({
        url : "purchase.php",
        method : "post",
        data : {
            c_name:cName, c_phone:cPhone, c_email:cEmail, c_address:cAddress, pay_mode:payMode
        },
        success:function(purchase){
            ("#purchaseSuccessMsg").html(purchase) ;
        }
    })

    
});
    

$(".booking_submit").click(function(e){
    e.preventDefault(); // it prevents page reload
    let form = $(this).closest("#booking") ; // to get values from while loop


    $.ajax ({
        url: 'booking.php',
        method: 'post',
        data : {formData2 : formData2},
        success:function(response){
            $('#booking_success_msg').removeClass('d-none');
            $('#booking_success_msg').html(response);                                
        }
    })



    let formData2 = {
        cName : $('#c-name').val(),
        cAddress : $('#c-address').val(),
        cPhone : $('#c-phone').val(),
        cDate : $('#date').val(),
        title : $('#title').text(),
        price : $('#price').val(),
    }    