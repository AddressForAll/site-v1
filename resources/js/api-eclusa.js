

function getdata(param = null){
    let step = $('input[type=radio][name=tipo_do_filtro]:checked').val()
    let user_type = $('input[type=radio][name=tipo_de_usuario]:checked').val()
    let user = $('#usuario').val()
    if (user != "") {
        let fn = (step=='step0')? 'checkuserdir': ('checkuserfiles_'+ step)
        url = 'http://api-test.addressforall.org/v1/eclusa/'+ fn +'/'+ user +'/' + user_type
        $.getJSON(url, function( data ) {
            $('#tabela').show();
            $('#definepaginacao').show();
            $('#tabela').DataTable({
                "bDestroy": true,
                "dom": 'Bfrtip',
                "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
                "data" : data,
                "columns" : [
                    {"data" : "fmeta.jurisdiction_label"},
                    {"data" : "fid"},
                    {"data" : "fname"},
                    {"data" : "is_valid"}
                ], /* endcolumns */
                "paging": $('#paginar').prop('checked'),
                "responsive": true,
                "pageLength" : 10
            });

        });

        /* Changes automatically the GET LINK at Annotation for Developers Section */
        $('#get_url').text(url);
        $('#get_url').attr("href", url);
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
