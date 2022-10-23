  
    let price = document.getElementsByClassName('productPrice') ;
    let qty = document.getElementsByClassName('productQty') ;
    let subTotal = document.getElementsByClassName('sub-total') ;
    let gTotal = document.getElementById('gtotal') ;    
    let gt = 0;
     
    
    function SUBTOTAL() {
        gt = 0;
        for(i=0;i<price.length;i++)
        {
            subTotal[i].innerText = (price[i].value) * (qty[i].value) ;
    
            gt = gt + (price[i].value) * (qty[i].value) ;      
    
            
        }
        gTotal.innerText = gt;  
        document.getElementById('grandTotal').value = gt;     
        
    }    
    SUBTOTAL();     
    

