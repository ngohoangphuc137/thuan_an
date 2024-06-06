const items = document.querySelectorAll('.pagination-item');
const row = document.querySelector('.row-shop')
const selectShowItem = document.querySelector('.select-shop')
const scrollShop = document.querySelector('.sectionShop')
let thisPage = 1;
let limit = 6;
const listPage = () => {
    let countPage = Math.ceil((items.length - 1) / limit)
    document.querySelector('.ul-pagi').innerHTML = "";
    if (thisPage != 1) {
        let pre = document.createElement('li')
        pre.innerHTML = '<'
        pre.setAttribute('onclick', "changePage(" + (thisPage - 1) + ")");
        document.querySelector('.ul-pagi').appendChild(pre)
    }

    for (let i = 1; i <= countPage; i++) {
        if (i >= thisPage - 1 && i < thisPage + 2) {
            let newpage = document.createElement('li')
            newpage.setAttribute('data-croll', 'sectionShop')
            newpage.innerText = i
            if (i == thisPage) {
                newpage.classList.add('active')
            }
            newpage.setAttribute('onclick', "changePage(" + i + ")");

            document.querySelector('.ul-pagi').appendChild(newpage)
        }

    }
    if (thisPage != countPage) {
        let next = document.createElement('li')
        next.innerHTML = '>'
        next.setAttribute('onclick', "changePage(" + (thisPage + 1) + ")");
        document.querySelector('.ul-pagi').appendChild(next)
    }
}

const loadItem = () => {
    let beginitem = (thisPage - 1) * limit // sản phẩm bắt đầu tim theo vị trí index
    let enditem = limit * thisPage; // sản phầm kết thúc để hiển thị ra màn hình
    beginitem > items.length ?
        `${thisPage = 1}${limit = beginitem} ${loadItem()}`
        :
        items.forEach((item, index) => {
            if (index >= beginitem && index <= enditem - 1) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        })
    listPage()
}
loadItem()

const changePage = (i) => {
    thisPage = i;
    scrollShop.scrollIntoView({ behavior: "smooth" });
    loadItem()
}
const show = () => {
    selectShowItem.addEventListener('change', (e) => {
        limit = e.target.value;
        loadItem()
    })
}
show();