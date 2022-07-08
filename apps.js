// hide and unhide password
const psdKeyBtn = document.querySelectorAll('.input i.psd-key')

if(psdKeyBtn.length > 0) {
    psdKeyBtn.forEach(btn => {
        btn.addEventListener('click', ()=> {
            if(btn.className.indexOf('lni-lock') !== -1) {
                btn.classList.remove('lni-unlock')
                btn.classList.add('lni-lock')
                btn.parentElement.querySelector('input').setAttribute('type') = 'text'
            } else {
                btn.classList.remove('lni-lock')
                btn.classList.add('lni-unlock')
                btn.parentElement.querySelector('input').setAttribute('type') = 'password'
            }
        })
    })
}

// handle change cart quantity
const quantityPlusBtn = document.querySelector('i.lni-plus.plus-btn')
const quantityMinusBtn = document.querySelector('i.lni-minus.minus-btn')
const quantityInput = document.querySelector('.quantity-wrapper input')

quantityMinusBtn.addEventListener('click', ()=> {
    if(quantityInput.value == 1) {
    quantityInput.value = quantityInput.value;
    quantityMinusBtn.parentElement.querySelector('p').innerHTML = `(${quantityInput.value == 1 ? quantityInput.value + 'item added' : quantityInput.value + ' items added'})`
    } else {
        quantityInput.value = parseInt(quantityInput.value) - 1;
        quantityMinusBtn.parentElement.querySelector('p').innerHTML = `(${quantityInput.value == 1 ? quantityInput.value + 'item added' : quantityInput.value + ' items added'})`
    }
})

quantityPlusBtn.addEventListener('click', ()=> {
    quantityInput.value = parseInt(quantityInput.value) + 1;
    quantityMinusBtn.parentElement.querySelector('p').innerHTML = `(${quantityInput.value == 1 ? quantityInput.value + 'item added' : quantityInput.value + ' items added'})`
})