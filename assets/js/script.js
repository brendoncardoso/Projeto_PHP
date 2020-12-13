$(document).ready(function(){
    $("#filter_preco").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: true});
    $("input[name='filter']").change(function(){
        var val = $(this).val();
        if(val != 0){
            $('#procurar').attr('disabled', false);
        }else{
            $('#procurar').attr('disabled', true);
            $('#procurar').val("");
        }

        if(val == 2){
            $('#procurar').hide();
            $('#procurar').val('');
            $('#cor').show();

            $('#filter_preco').hide();
            $('#filter_preco').val('');
        }else if(val == 3) {
            $('#procurar').hide();
            $('#procurar').val('');
            $('#cor').hide();

            $('#filter_preco').show();
        }else{
            $('#cor').hide();
            $('#procurar').show();
            $('#cor').val('0');
            $('#filter_preco').hide();
            $('#filter_preco').val('');
        }
    });

    $('.delete').click(function(){
        var idprod = $(this).data('idprod');
        var tbody_count = $('table tbody tr').length - 1;
        $(this).parents('tr').remove();

        $.ajax({
            method: "POST",
            url: "delete.php",
            data: { idprod: idprod },
            
            success: function (msg){
                if(tbody_count == 0){
                    $('table > tbody').append("<tr><td colspan='5'>Não há registros na tabela.</td></tr>");
                }
            }
        })
    });

    $("#preco").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: true});
   
    $("#preco").keyup(function() {
        var val = $(this).val().substr(3).replace(',','.');
        var currency = val.replace(/\D/g, ''); 
        var money =   parseFloat(currency)/100; // 20000.99
     
        var cor = $("input[name='cor']:checked").val();
        if(cor == 'white'){
            var total_desconto = money;
        }else if(cor == 'blue'){
            var total_desconto = (money * 0.2);
        }else if(cor == 'red'){
            if(currency > 5000){
                var total_desconto = (money * 0.05);
            }else{
                var total_desconto = (money * 0.2);
            }        
        }else if(cor == 'yellow'){
            var total_desconto = (money * 0.1);
        }

        $('#valor_desc').val(total_desconto.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
        $('#valor_desc_hidden').val(total_desconto.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
    });

    $("input[name='cor']").change(function() {
        var val = $('#preco').val().substr(3).replace(',','.');
        var currency = val.replace(/\D/g, ''); 
        var money =   parseFloat(currency)/100; 
     
        var cor = $(this).val();
        if(val != ""){
            if(cor == 'white'){
                var total_desconto = money;
            }else if(cor == 'blue'){
                var total_desconto = (money * 0.2);
            }else if(cor == 'red'){
                if(currency > 5000){
                    var total_desconto = (money * 0.05);
                }else{
                    var total_desconto = (money * 0.2);
                }
            }else if(cor == 'yellow'){
                var total_desconto = (money * 0.1);
            }
        }else{
            var total_desconto = 'R$ 0,00';
        }
        
        $('#valor_desc').val(total_desconto.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
        $('#valor_desc_hidden').val(total_desconto.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
    });

    var val = $('#preco').val().substr(3).replace(',','.');
    var currency = val.replace(/\D/g, ''); 
    var money =   parseFloat(currency)/100; 
    
    var cor = $("input[name='cor']:checked").val();
    
    if(val != ""){
        if(cor == 'white'){
            var total_desconto = money;
        }else if(cor == 'blue'){
            var total_desconto = (money * 0.2);
        }else if(cor == 'red'){
            if(currency > 5000){
                var total_desconto = (money * 0.05);
            }else{
                var total_desconto = (money * 0.2);
            }
        }else if(cor == 'yellow'){
            var total_desconto = (money * 0.1);
        }
    }else{
        var total_desconto = 'R$ 0,00';
    }
    
    $('#valor_desc').val(total_desconto.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
    $('#valor_desc_hidden').val(total_desconto.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'}));
});
