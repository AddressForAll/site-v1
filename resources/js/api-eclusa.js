who_show = '';

function getdata(param = null){
    let step = $('input[type=radio][name=tipo_do_filtro]:checked').val();
    let user_type = $('input[type=radio][name=tipo_de_usuario]:checked').val();
    let user = $('#usuario').val();

    if (user != "") {
        let fn = (step=='step0') ? 'checkuserdir' : ('checkuserfiles_'+ step)
        url = 'http://api-test.addressforall.org/v1/eclusa/'+ fn +'/'+ user +'/' + user_type

        if (step =='step0'){
            columns = [
                {"data" : "username"},
                {"data" : "jurisdiction_label"},
                {"data" : "jurisdiction_osmid"},
                {"data" : "pack_path"},
                {"data" : "packinfo.user_resp"},
                {"data" : "packinfo.accepted_date"}
            ]

            $('#tabela').hide();
            $('#tabela_step_0').show();
        }
        else {
            columns = [
                {"data" : "fmeta.jurisdiction_label"},
                {"data" : "fid"},
                {"data" : "fname"},
                {"data" : "is_valid"}
            ];

            $('#tabela').show();
            $('#tabela_step_0').hide();
        }  


        /* Calling DataTable constructor */
        who_show = $('#tabela').is(":visible") ? '#tabela' : '#tabela_step_0';
        who_destroy = !$('#tabela').is(":visible") ? '#tabela' : '#tabela_step_0';

        $.getJSON(url, function( data ) {
            $(who_show).show();
            $('#definepaginacao').show();
            $(who_show).DataTable({
                "bDestroy": true,
                "dom": 'Bfrtip',
                "buttons": ['copy', 'csv', 'excel', 'print'],
                "data" : data,
                "columns" : columns, 
                "paging": $('#paginar').prop('checked'),
                "responsive": true,
                "pageLength" : 10
            });

        });
        
        /* Destroy unchecked table to remove duplicated export buttons */
        $(who_destroy).DataTable().destroy();

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
        $(who_show).DataTable().page.len(qtd).draw();
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
