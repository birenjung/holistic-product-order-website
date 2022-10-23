$(document).ready(function(){   
    
    $(".addToCartBtn").click(function(e){
        e.preventDefault(); // it prevents page reload
        let form = $(this).closest(".cart-form") ; // to get values from while loop

        let id = form.find("#pid").val() ;
        let title = form.find('#title').text() ;
        let price = form.find('#price').val() ;

        $.ajax({
            url : "m-cart.php",
            method : "post",
            data : {
                id:id, title:title, price:price
            },
            success:function(response){
                // alert(response);
                // product_num_cart() 
                $('.cartMessage').html(response);
            }
        });
        product_num_cart() ;
        function product_num_cart(){
            $.ajax ({
                url : "m-cart.php",
                method : "get",
                data : { 
                    p_number : "p_number"
                },
                success:function(response){
                    $("#pnum").html(response) ;

                }
            });
        }        
    });
   
    
    $('#selectCategory').on('change', function selectCategory() {
        let x = document.getElementById('selectCategory').value ;    
        $.ajax ({
            url : "select-category.php",
            method : "POST",
            data : {
                id : x
            },
            success:function(data){
                $("#ans").html(data);
            }
        });    
        
    });

    $('#buy-form').submit(function(event){
        event.preventDefault();
       
        let formData = {
            cName : $('#c-name').val(),
            cAddress : $('#c-address').val(),
            cPhone : $('#c-phone').val(),
            cEmail : $('#c-email').val(),
            payMode : $("input[name='pay-mode']:checked").val(),
            gTotal : $('#grandTotal').val(), 
                   
        }       
        $.ajax ({
            url: 'purchase.php',
            method: 'post',
            data : {formData:formData},           
            success:function(response){              
                $('#purchase_success_msg').removeClass('d-none');                                         
                $('#purchase_success_msg').html(response);                                         
            }
        })
    });

    $(".btn_close").click(function(){        
        window.location.href = "cart.php";        
    });
    
    $('.timepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 30,
        minTime: '10',
        maxTime: '8:00pm',
        defaultTime: '11',
        startTime: '8:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
   
    $("#jq-filter").on("keyup", function(){
        let value = $(this).val().toLowerCase();
        $("#a_table tr").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)            
        });
    });  
    
});