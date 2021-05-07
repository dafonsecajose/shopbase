$('#calcular').click(function () {
    let data = {
        "sCepDestino": $('input[type=text][name=sCepDestino]').val(),
        "nVlComprimento": $('input[type=hidden][name=nVlComprimento]').val(),
        "nVlAltura": $('input[type=hidden][name=nVlAltura]').val(),
        "nVlLargura": $('input[type=hidden][name=nVlLargura]').val(),
        "nVlPeso": $('input[type=hidden][name=nVlPeso]').val(),
        "_token": csrf

    }


    $.ajax({
        type: 'POST',
        url: route,
        data: data,
        dataType: 'json',
        success: function (res) {
            $('div.response').html('');
            reposnde = $('div.response');
            for (let i = 0; res.length; i++) {
                if (res[i].hasOwnProperty('erro')) {
                    reposnde.append(`<div class="alert alert-danger">${res[i].erro}</div>`);
                    return false;
                } else {
                    reposnde.append(`
                          <div class="form-check">

                         <label class="form-check-label">${res[i].name} Valor: R$ ${res[i].price} Prazo estimado: ${res[i].deadline} dia(s).</label>
                            </div>`);
                }
            }

        },
        error: function (res) {
        }
    });

});
