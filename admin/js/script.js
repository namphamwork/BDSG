const bg = document.getElementsByClassName("set-bg");
for (let i = 0; i < bg.length; i++) {
    let data = bg[i].getAttribute("data-bg")
    bg[i].style.backgroundImage = "url(../img/product/"+ data +")"
}

function controlDropdown(n){
    if(n.classList.contains('card-active')){
        n.classList.remove('card-active')
        if(n.parentElement.children[1] != undefined){
            n.parentElement.children[1].style.height = '0'
        }
    }else{
        n.classList.toggle('card-active')
        if(n.parentElement.children[1] != undefined){
            let childCount = n.parentElement.children[1].childElementCount
            n.parentElement.children[1].style.height = 'calc(24px * '+childCount+' + 12px * '+(childCount - 1 )+' + 20px)'
        }
        
    }
}

                                
function expand(n){
    if(n.classList.contains('block-active')){
        n.classList.remove('block-active')
        n.style.height ='160px';
    }else{
        n.classList.toggle('block-active')
        n.style.height ='500px';
    }
    console.log(n.classList)
}

const imgBtn = document.getElementsByClassName("mini-img_block")
const imgShow = document.getElementsByClassName("large-img")

function showImage(n){
    if(n.classList.contains('actived')){

    }else{
        for(let i = 0; i < imgBtn.length; i++){
            imgBtn[i].classList.remove('actived')
            imgShow[i].classList.remove('actived')
        }
        n.classList.toggle('actived')
        for(let i = 0; i < imgBtn.length; i++){
            if(imgBtn[i].classList.contains('actived')){
                imgShow[i].classList.toggle('actived')
            }
        }
    }
}


const input = document.getElementsByClassName('btn-fullW');
const image = document.getElementsByClassName('large-img');

for (let i = 0; i < input.length; i++){

    input[i].addEventListener('change', (e) => {
        if (e.target.files.length) {
            let src = URL.createObjectURL(e.target.files[0]);
            image[i].style.backgroundImage = 'url('+src+')'
            if(imgBtn)
            imgBtn[i].style.backgroundImage = 'url('+src+')';
        }
    });
}


function openTab(x){
    let itemAll = document.querySelectorAll("[data-orderStatus]")
    if(x == 'pending'){
        hide(document.querySelectorAll("[data-orderStatus_3]"))

    }
    if(x == 'done'){
        show(itemAll,document.querySelectorAll("[data-orderStatus_3]"))
    }
    
    if(x == 'cancel'){
        show(itemAll,document.querySelectorAll("[data-orderStatus_4]"))
    }
    // console.log(itemHide)

    // itemHide.forEach(item => {
    //     console.log(item)
    //     // item.style.display = 'none'
    // });
}

function hide(x){
     x.forEach(item => {
        item.style.display = 'none'
    });
}


function show(all,x){
    all.forEach(item => {
       item.style.display = 'none'
   });
   x.forEach(item => {
      item.style.display = 'block'
  });
}