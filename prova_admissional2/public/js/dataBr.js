jQuery(function($){
	$.datepicker.regional['pt-BR'] = {
		closeText: 'Fechar',
		prevText: '&#x3c;Anterior',
		nextText: 'Pr&oacute;ximo&#x3e;',
		currentText: 'Hoje',
		monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
		'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
		'Jul','Ago','Set','Out','Nov','Dez'],
		dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','S&aacute;bado'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b'],
		dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b'],
		weekHeader: 'Sm',
		dateFormat: 'dd/mm/yy',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['pt-BR']);
});

function validaData(stringData)
{
    /******** VALIDA DATA NO FORMATO DD/MM/AAAA *******/    
    var regExpCaracter = /[^\d]/;     //Expressão regular para procurar caracter não-numérico.
    var regExpEspaco = /^\s+|\s+$/g;  //Expressão regular para retirar espaços em branco.

    if(stringData.length != 10)
    {
        return false;
    }

    splitData = stringData.split('/');

    if(splitData.length != 3)
    {                 
        return false;
    }

    /* Retira os espaços em branco do início e fim de cada string. */
    splitData[0] = splitData[0].replace(regExpEspaco, '');
    splitData[1] = splitData[1].replace(regExpEspaco, '');
    splitData[2] = splitData[2].replace(regExpEspaco, '');

    if ((splitData[0].length != 2) || (splitData[1].length != 2) || (splitData[2].length != 4))
    {                   
        return false;
    }

    /* Procura por caracter não-numérico. EX.: o "x" em "28/09/2x11" */
    if (regExpCaracter.test(splitData[0]) || regExpCaracter.test(splitData[1]) || regExpCaracter.test(splitData[2]))
    {                    
        return false;
    }

    dia = parseInt(splitData[0],10);
    mes = parseInt(splitData[1],10)-1; //O JavaScript representa o mês de 0 a 11 (0->janeiro, 1->fevereiro... 11->dezembro)
    ano = parseInt(splitData[2],10);    
    var novaData = new Date(ano, mes, dia);                                    
    var hoje = new Date();              

    if (novaData < hoje) {
            alert("Data retroativa é inválida");
            return false;

        }
        
    
    if ((novaData.getDate() != dia) || (novaData.getMonth() != mes) || (novaData.getFullYear() != ano))
    {                    
        return false;
    }
    else
    {                 
        return true;
    }
}



function adicionar(e, url, token){
    e.preventDefault();
    

    var options = "";

    $.ajax({
        url:url,
        type:"POST",
        dataType:"json",
        data:{"_token":token},
        success:function(data){
            $.each(data, function(i, retorno){
                options += '<option value="' + data[i].id + '">' + data[i].nome + '</option>';
            });
            addOptions(options,url,token);
        },
        error:function(xhr, err){
            options += "<option>Error</option>";
        }
    });

    

}

function addOptions(options,url,token){
    var count = $("#count").val();

    var html = "";

    html    += '<div class="row" id="row'+count+'">';
    html    += '<div class="col-md-10" id="curso'+count+'">';
    html    += '<div class="form-group">';
    html    += '<select name="curso_id[]" class="form-control" id="c'+count+'" required="required">';
    html    += '<option>Escolha o Curso</option>';
    html    += options;
    html    +=  '</select>';
    html    +=  '</div>';
    html    +=  '</div>';
    html    +=  '<div class="col-md-2">';
    html    +=  '<a href="#" class="btn btn-success" onclick="adicionar(event, \''+url+'\', \'' + token +'\');" title="Adicionar Curso"><span class="fas fa-plus"></span></a>';
    html    +=  '&nbsp;&nbsp;';
    html    +=  '<a href="#" class="btn btn-danger" onclick="decrementar(event, \''+count+'\')" title="Retirar este Curso"><span class="fas fa-minus"></span></a>';
    html    +=  '</div>';
    html    +=  '</div>';

    $("#span_container").append(html);

    count++;
    $("#count").val(count);
}

function decrementar(e, count){
    e.preventDefault();
    $("#row"+count).remove();
    count--;
    $("#count").val(count);
}

$(document).ready(function() {
    $('#dataTables-example').DataTable({
          "oLanguage": {
              "sProcessing": "Aguarde enquanto os dados são carregados ...",
              "sLengthMenu": "Mostrar _MENU_ registros por pagina",
              "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
              "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
              "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
              "sInfoFiltered": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
              "sSearch": "Procurar",
              "oPaginate": {
                "sFirst":    "Primeiro",
                "sPrevious": "Anterior",
                "sNext":     "Próximo",
                "sLast":     "Último"
              }
          },
          "order":[[ 0 , 'desc']] // ,
         // dom: 'Bfrtip',
         // buttons: [
           // 'copy', 'csv', 'excel', 'pdf', 'print'
         // ]
    });
});

function validaFormAluno(){
    var nome  = $("#nome").val();
    var email = $("#email").val();
    var pass  = $("#password").val();
    var passc = $("#passwordc").val();

    if(nome == ""){
        alert("Nome é obrigatório!!");
        return false;
    }

    if(email == ""){
        alert("E-mail é obrigatorio");
        return false;
    }

    if(pass == "" || passc == ""){
        alert("Senha é obrigatória");
        return false;
    }

    if(pass != passc){
        alert("Senhas não conferem.");
        return false;
    }

    return true;
}