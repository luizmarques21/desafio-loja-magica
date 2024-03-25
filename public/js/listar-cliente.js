$('.btn-dependente').click(function () {
    var filiadoId = $(this).data('id');
    listaDependentes(filiadoId);
});

$(document).on('click', '#btn-cadastra', function () {
    var filiadoId = $(this).data('id');
    cadastraDependente(filiadoId);
});

$(document).on('click', '#btn-edita', function () {
    var dependenteID = $(this).data('id');
    editaDependente(dependenteID);
});

function listaDependentes(filiadoID) {
    $.ajax({
        url: "../js/ajax/lista-dependentes.ajax.php",
        dataType : "html",
        type : "post",
        data : {
            "filiadoID" : filiadoID,
        },
        success : function(retorno) {
            $("#box-conteudo-modal").empty().append(retorno);
        },
        error : retorno => console.log(retorno)
    });
}

function cadastraDependente(filiadoID) {
    $.ajax({
        url: "../js/ajax/cadastra-dependente.ajax.php",
        dataType : "html",
        type : "post",
        data : {
            "filiadoID" : filiadoID,
        },
        success : function(retorno) {
            $("#box-conteudo-modal").empty().append(retorno);
        },
        error : retorno => console.log(retorno)
    });
}

function editaDependente(dependenteID) {
    $.ajax({
        url: "../js/ajax/edita-dependente.ajax.php",
        dataType : "html",
        type : "post",
        data : {
            "dependenteID" : dependenteID,
        },
        success : function(retorno) {
            $("#box-conteudo-modal").empty().append(retorno);
        },
        error : retorno => console.log(retorno)
    });
}