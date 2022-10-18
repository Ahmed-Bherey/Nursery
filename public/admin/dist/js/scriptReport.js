let pagination=document.querySelector('.pagination');
let page=document.querySelectorAll('.page');
let item=''
for (let i = 0; i < page.length; i++) {
    item  +=`
        <li class="page-item"><a class="page-link" href="#" onclick="active(${i})">${i+1}</a></li>        
    `
    page[i].id=i;
}

pagination.innerHTML =`
<li class="page-item disabled" id="add">
<a class="page-link">Previous</a>
</li>
${item}
<li class="page-item">
<a class="page-link" href="#">Next</a>
</li>
`

function active(id){
    page.forEach(page => {
        page.classList.remove('active')
    });
    page[id].classList.add('active');
}

