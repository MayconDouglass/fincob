$('#CadastroModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) //Botão que acionou o modal  
    $(this).find('form').trigger('reset');
})

//Apaga tudo que estiver nos forms do modal
$('#CadastroModal').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
})

$('#VisualizarCadModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botão que acionou o modal
    var idview = button.data('whatever-id')
    var emailview = button.data('whatever-email')
    var passwordview = button.data('whatever-pw')
    var statusview = button.data('whatever-status')

    var modal = $(this)
    modal.find('.modal-title').text('Visualizar Usuário')
    modal.find('#id_user').val(idview)
    modal.find('#email_user').val(emailview)
    modal.find('#pw_user').val(passwordview)
    modal.find('#status_user').val(statusview)
})

$('#VisualizarCadContaModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botão que acionou o modal
    var idview = button.data('whatever-id')
    var emailview = button.data('whatever-email')
    var passwordview = button.data('whatever-pw')
    var statusview = button.data('whatever-status')

    var modal = $(this)
    modal.find('.modal-title').text('Visualizar Usuário')
    modal.find('#id_user').val(idview)
    modal.find('#email_user').val(emailview)
    modal.find('#pw_user').val(passwordview)
    modal.find('#status_user').val(statusview)
})

$('#AlterarCadModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botão que acionou o modal
    var id = button.data('whatever-id')
    var email = button.data('whatever-email')
    var password = button.data('whatever-pw')
    var status = button.data('whatever-status')

    $("#statususer").val(status);

    var modal = $(this)
    modal.find('.modal-title').text('Modificar Usuário')
    modal.find('#id_user').val(id)
    modal.find('#email_user').val(email)
    modal.find('#pw_user').val(password)
})
$('#AlterarCadContaModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botão que acionou o modal
    var id = button.data('whatever-id')
    var tipo = button.data('whatever-tipo')
    var titulo = button.data('whatever-titulo')
    var valor = button.data('whatever-valor')
    var efetivado = button.data('whatever-efetivado')
    var parcela = button.data('whatever-parcela')
    var data_conta = button.data('whatever-dataconta')
    var data_efetivado = button.data('whatever-dataefetivado')
    var data_vencimento = button.data('whatever-datavencimento')

    var modal = $(this)
    modal.find('.modal-title').text('Visualizar Documento')
    modal.find('#id_contaalt').val(id)
    modal.find('#tipo_conta').val(tipo)
    modal.find('#titulo_contaalt').val(titulo)
    modal.find('#valor_conta').val(valor)
    modal.find('#efetivado_contaalt').val(efetivado)
    modal.find('#parcela_conta').val(parcela)
    modal.find('#data_conta').val(data_conta)
    modal.find('#dataefetivado_conta').val(data_efetivado)
    modal.find('#vencimento_conta').val(data_vencimento)
})

$('#VisualizarCadContaModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botão que acionou o modal
    var idview = button.data('whatever-id')
    var tipoview = button.data('whatever-tipo')
    var tituloview = button.data('whatever-titulo')
    var valorview = button.data('whatever-valor')
    var efetivadoview = button.data('whatever-efetivado')
    var parcelaview = button.data('whatever-parcela')
    var data_contaview = button.data('whatever-dataconta')
    var dataefe_view = button.data('whatever-dataefetivado')
    var vencimentoview = button.data('whatever-datavencimento')
    var categoriaview = button.data('whatever-categoria')
    var pastaview = button.data('whatever-pasta')

    var modal = $(this)
    modal.find('.modal-title').text('Visualizar Documento')
    modal.find('#id_conta').val(idview)
    modal.find('#tipo_conta').val(tipoview)
    modal.find('#titulo_conta').val(tituloview)
    modal.find('#valor_conta').val(valorview)
    modal.find('#efetivado_conta').val(efetivadoview)
    modal.find('#parcela_conta').val(parcelaview)
    modal.find('#data_conta').val(data_contaview)
    modal.find('#dataefe_conta').val(dataefe_view)
    modal.find('#vencimento_conta').val(vencimentoview)
    modal.find('#categoria_conta').val(categoriaview)
    modal.find('#pasta_conta').val(pastaview)
})


$('#modal-danger').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Botão que acionou o modal
    var iddelete = button.data('whatever-id')
    $("#iddelete").val(iddelete);
    var modal = $(this)
    modal.find('.b_text_modal_title_danger').text('Excluir Registro')
})



function deleteMsg() {
    return confirm('Deseja realmente apagar este registro?');
}




function selected() {
    var dadosLoja = document.getElementsByClassName('dataefetivado');
    var dadosLoja2 = document.getElementsBy('efetivado_conta').text;
    var value = modal.find('#efetivado_conta').val(efetivadoview);
    if (dadosLoja2 == "Sim") {
        // dadosLoja[0].style.display = 'none';
    } else {
        dadosLoja[0].style.display = 'block';
    }
}

$('#efetivado_contaalt').change(function (event) {
    var test = event.currentTarget.value;
    if (test == 1) {
       
        $('#dataefetivado').hide();
    } else {
        
        $('#dataefetivado').show();
    }
});

function imprimir() {
    window.addEventListener("load", window.print());
}
