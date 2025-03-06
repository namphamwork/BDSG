// const productList = document.querySelector('[data-product-list]')
// let products = []

// fetch("include/product.php")
//     .then(res => res.json())
//     .then(data => {
//         products.push(data)
//     })

//     console.log(products)
//     function abs(handler) {
//         fetch("include/product.php")
//         .then(res => {return res.json()})
//         .then(data => {
//             var a = [];
//             a.push(data);
//             handler(a);
//         });
//     }

// var a = []
// console.log(abs(a))


// var userCart = []

// function addToCart(id,qty){
//     const item = {id,qty}
//     var flag = true
//     for (let i = 0; i < userCart.length; i++){
//         if (userCart[i].id == id){
//             userCart[i].qty += 1
//             flag = false
//         }
//     }
//     if (flag){
//         userCart.push(item)
//     }

//     saveCart()
// }
function addToCart(x){
    let val = x.querySelector("button").value
    let fd = new FormData();
    fd.append("addToCart", val)
    fetch('./include/cart.php', {method: "POST", body: fd })
        .then(res => res.json())
        // .then(data =>{
        //     // console.log(data)
        // })

}



function showMiniCart(){
    let cartIcon = document.querySelector('[data-cart-icon]')
    cartIcon.innerHTML += 
    `<div class="bef">
    <div class="dropdown">
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>`
            const cartList = JSON.parse(window.localStorage.getItem('Cart'))
            cartIcon.innerHTML+= cartList.map(`
            <tr>
                <td class="cart_item">
                    <div class="cart_item_img">
                            <div class="mini_bg set-bg" data-setbg="'.$item['img'].'">
                            <input type="hidden" name="index" value="'.$index.'"></div>
                    </div>
                    <div class="cart_item_text">
                        <h6>'.$item['name'].'</h6>
                        <h5>$'.$item['price'].'</h5>
                    </div>
                </td>
                <td class="qty_item">
                    <div class="qty">
                            <button class="btn" name="decrease" type="submit" value=" "><i class="fas fa-angle-left"></i></button>
                            <input type="text"  value="'.$item['quantity'].'">
                            <button class="btn" name="increase" type="submit"  value=" "><i class="fas fa-angle-right"></i></button>
                    </div>
                </td>
                <td class="cart_price">$'.(float)$item['price'] * $item['quantity'].'</td>
                <td class="cart_del"><button class="btn" name="del" type="submit"  value=" "><i class="fa fa-close"></i></button></td>
            </tr>`)

            cartList.forEach(item => {
                
            });
                `
            </tbody>
        </table>
    </div>
</div>`
}