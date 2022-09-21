const navSlide = ()=> {
    const burger = document.querySelector('.burger') ;
    const nav = document.querySelector('.nav-links') ;
    const navlinks = document.querySelectorAll('.nav-links li')

    burger.addEventListener('click',()=>{
        nav.classList.toggle('nav-active') ;   

    // animate burger
    burger.classList.toggle('toggle') ;   

    }) ;
}
navSlide();

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
}
SUBTOTAL();