

function getdata(param = null){
    step = $('input[type=radio][name=tipo_do_filtro]:checked').val();
    user = $('#usuario').val();

    if (user != ""){
        url = 'http://api.addressforall.org/v1.json/eclusa/checkUserFiles-'+ step +'/'+ user +'/0';
        $.getJSON(url, function( data ) {
            $('#tabela').show();
            $('#definepaginacao').show();
            $('#tabela').DataTable({
                "bDestroy": true,
                "dom": 'Bfrtip',
                "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
                "data" : data,
                "columns" : [
                    {"data" : "cityname"},
                    {"data" : "fid"},
                    {"data" : "fname"},
                    {"data" : "err_msg"},
                    {"data" : "is_valid"}
                ], /* endcolumns */
                "paging": $('#paginar').prop('checked'),
                "responsive": true,
                "pageLength" : 10
            });

        });
    } 
    else {
        alert('Inserir usuário para completar.')
    }

}

$(document).ready(function(){

    /* Páginação controlda */
    $('#definepaginacao').on('change', function (){
        var qtd = $("#paginacao").children("option:selected").val();
        $('#tabela').DataTable().page.len(qtd).draw();
    });    


    /* Considera ordenação correta em PT, A, À, Á, B, C ... Z */
    $.fn.dataTable.ext.order.intl = function ( locales, options ) {
    if ( window.Intl ) {
        var collator = new window.Intl.Collator( locales, options );
        var types = $.fn.dataTable.ext.type;

        delete types.order['string-pre'];
        types.order['string-asc'] = collator.compare;
        types.order['string-desc'] = function ( a, b ) {
            return collator.compare( a, b ) * -1;
            };
        }
    };
    $.fn.dataTable.ext.order.intl( 'pt' ); 
});
