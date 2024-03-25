$('document').ready(function () {
    $('#valor-busca-tipo').hide();
});

$('#filtro-busca').change(function () {
    var filtro = $(this).val();
    alteraInput(filtro);
});

$('#btn-busca').click(function () {
    var filtro = $('#filtro-busca').val();
    var valor;
    if (filtro === 'nome') {
        valor = $('#valor-busca-nome').val();
    } else {
        valor = $('#valor-busca-tipo').val();
    }
    buscaResultados(filtro, valor);
});

function alteraInput(filtro) {
    switch(filtro) {
        case 'nome':
            $('#valor-busca-nome').show();
            $('#valor-busca-nome').val('');
            $('#valor-busca-tipo').hide();
            break;
        case 'tipo':
            $('#valor-busca-tipo').show();
            $('#valor-busca-tipo').val('P');
            $('#valor-busca-nome').hide();
            break;
    }
}

function buscaResultados(filtro, valor) {
    $.ajax({
        url: "../public/js/ajax/busca-clientes.ajax.php",
        dataType : "html",
        type : "post",
        data : {
            "filtro" : filtro,
            "valor" : valor
        },
        success : retorno => $("#table-resultado").empty().append(retorno),
        error : retorno => console.log(retorno)
    });

}