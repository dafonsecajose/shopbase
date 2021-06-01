function proccessPayment(token, buttonTarget) {

    let data = {
        hash: PagSeguroDirectPayment.getSenderHash(),
        paymentType: buttonTarget.dataset.paymentType,
        shipChoice: ship,
        _token: csrf
    }

    if (buttonTarget.dataset.paymentType === 'CREDITCARD') {
        data.card_token = token;
        data.installment = document.querySelector('select.select_installments').value;
        data.card_name = document.querySelector('input[name=card_name]').value;
    }

    $.ajax({
        type: 'POST',
        url: urlProccess,
        data: data,
        dataType: 'json',
        success: function (res) {
            //console.log(res.data.order);
            let redirectUrl = `${urlThanks}?order=${res.data.order}`;
            let linkBoleto = `${redirectUrl}&b=${res.data.link_boleto}`;
            toastr.success(res.data.message, 'Sucesso');
            window.location.href = buttonTarget.dataset.paymentType === 'BOLETO' ? linkBoleto : redirectUrl;
        },
        error: function (err) {
            buttonTarget.disable = false;
            buttonTarget.textContent = 'Efetuar Pagamento';
            console.log(err);
            let message = JSON.parse(err.reponseText);
            document.querySelector('div.msg').innerHTML = showErrorMessages(message.data.message.error.message)

        }
    });
}


function getInstallments(amount, brand) {
    PagSeguroDirectPayment.getInstallments({
        amount: amount,
        brand: brand,
        maxInstallmentNoInterest: 0,
        success: function (res) {
            let selectInstallments = drawSelectInstallments(res.installments[brand]);
            document.querySelector('div.installments').innerHTML = selectInstallments;
            //console.log(err);
        },
        error: function (res) {
            //console.log(res);
        },
        complete: function (res) {
            //console.log(res);
        }
    });
}

function drawSelectInstallments(installments) {
    let select = '<label>Opções de Parcelamento:</label>';

    select += '<select class="form-control select_installments">';

    for (let l of installments) {
        select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount.toFixed(2).replace('.', ',')} - Total fica ${l.totalAmount.toFixed(2).replace('.', ',')}</option>`;
    }


    select += '</select>';

    return select;
}

function showErrorMessages(message) {
    return `
    <div class="alert alert-danger">${message}</div>
    `
}

function errorsMapPagSeguroJs(code) {
    switch (code) {
        case "10000":
            return 'Bandeira do cartão inválida!';
            break;
        case "10001":
            return 'Número do Cartão com tamanho inválido!';
            break;
        case "10002":
        case "30405":
            return 'Data com formato inválido!';
            break;
        case "10003":
            return 'Código de segurança inválido!'
            break;
        case "10004":
            return 'Código de segurança é obrigatório!';
            break;
        case "10006":
            return 'Tamanho do código de segurança inválido!';
            break;
        default:
            return 'Houve um erro na validação do seu cartão de crédito!';
    }
}
