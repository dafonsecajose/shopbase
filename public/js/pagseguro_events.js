let cardNumber = document.querySelector('input[name=card_number]');
let spanBrand = document.querySelector('span.brand');

cardNumber.addEventListener('keyup', function () {
    if (cardNumber.value.length >= 6) {
        PagSeguroDirectPayment.getBrand({
            cardBin: cardNumber.value.substr(0, 6),
            success: function (res) {
                let imgFlag = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png">`;
                spanBrand.innerHTML = imgFlag;
                document.querySelector('input[name=card_brand]').value = res.brand.name;
                brand = res.brand.name;
                getInstallments(total, res.brand.name);
            },
            error: function (err) {
                //console.log(err);
            },
            complete: function (res) {
                //console.log('Complete ',res);
            }
        });
    }
});

let submitButton = document.querySelectorAll('button.proccessCheckout');


submitButton.forEach(function (elemento, key) {

    elemento.addEventListener('click', function (event) {
        event.preventDefault();
        document.querySelector('div.msg').innerHTML = '';

        let buttonTarget = event.target;
        buttonTarget.disable = true;
        buttonTarget.textContent = 'Carregando...';
        console.log(buttonTarget.dataset.paymentType);

        if (buttonTarget.dataset.paymentType === 'CREDITCARD') {
            PagSeguroDirectPayment.createCardToken({
                cardNumber: document.querySelector('input[name=card_number]').value,
                brand: document.querySelector('input[name=card_brand]').value,
                cvv: document.querySelector('input[name=card_cvv]').value,
                expirationMonth: document.querySelector('input[name=card_month]').value,
                expirationYear: document.querySelector('input[name=card_year]').value,
                success: function (res) {
                    proccessPayment(res.card.token, buttonTarget);
                },
                error: function (err) {
                    buttonTarget.disable = false;
                    buttonTarget.textContent = 'Efetuar Pagamento';
                    console.log(err);
                    for (let i in err.errors) {
                        document.querySelector('div.msg').innerHTML = showErrorMessages(errorsMapPagSeguroJs(i));
                    }
                }
            })
        }
        if (buttonTarget.dataset.paymentType === 'BOLETO') {
            proccessPayment(null, buttonTarget);
        }
    })
});

