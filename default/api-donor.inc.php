<section class="main" id="api">
    <h1>API - Resgatar dados</h1>
    <span>
        <strong>Dados: </strong>Donors
    </span>
    <style>
    .btn {
        color: #fff !important;
        text-transform: uppercase;
        text-decoration: none;
        background: #1874CD;
        padding: 7px;
        border-radius: 5px;
        display: inline-block;
        border: none;
        transition: all 0.1s ease 0s;
    }

    .btn:hover {
        background: #434343;
        letter-spacing: 1px;
        -webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
        -moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
        box-shadow: 5px 40px -10px rgba(0,0,0,0.57);
        transition: all 0.1s ease 0s;
    }

    .btn-disabled {
        color: #fff !important;
        text-transform: uppercase;
        text-decoration: none;
        background: #dddddd;
        padding: 7px;
        border-radius: 5px;
        display: inline-block;
        border: none;
        transition: all 0.1s ease 0s;
    }
    </style>
    <br>
    <label><strong>Paginar Resultado: </strong></label><input type="checkbox" id="paginar" checked>
    <br>
    <button onclick="getdata();"><strong>Consultar</strong></button>
    <br>
    <br>

    <table id="tabela" class="display" style="display: none;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Scope</th>
                <th>Id Vat</th>
                <th>Short Name</th>
                <th>Legal Name</th>
                <th>Id Wikidata</th>
                <th>Donations</th>
            </tr>
        </thead>
    </table>
    <div id="definepaginacao" style="display: none;">
        <strong>Configurar resultados por página</strong>
        <select id="paginacao">
            <option value="10" selected>10</option>
            <option value="30">30</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="-1">Mostrar tudo</option>
        </select>
    </div>

    <br><br>
    <div class="desenvolvedor">
        <table>
            <tr>
                <th colspan="2">Annotations for Developers</th>
            </tr>
            <tr>
                <td>data</td>
                <td>: donor</td>
            </tr>
            <tr>
                <td>GET</td>
                <td>: http://api.addressforall.org/_sql/donor2</td>
            </tr>
            <tr>
                <td>doc</td>
                <td>: <a href="https://github.com/AddressForAll/WS" style="text-decoration: none">https://github.com/AddressForAll/WS</a></td>
            </tr>
        </table>
    </div>
</section>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/sp-1.1.1/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"/>

<script>
    function getdata(param = null){

        url = 'http://addressforall.org/_sql/donor2';
        if (param != null) {
            url += "?id=eq." + param;
        }

        $.getJSON(url, function( data ) {
            $('#tabela').show();
            $('#definepaginacao').show();
            $('#tabela').DataTable({
                "bDestroy": true,
                "dom": 'Bfrtip',
                "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
                "data" : data,
                "columns" : [
                    {"data" : "id"},
                    {"data" : "scope"},
                    {"data" : "vat_id"},
                    {"data" : "shortname"},
                    {
                        "data" : null,
                        "render" : function(data, type, row){
                            return '<a href="'+data["url"]+'" target_blank>' + data["legalname"] + '</a>' 
                        }
                    },
                    {
                        "data" : null,
                        "render": function(data, type, row) {
                            return (data["wikidata_id"]) ? '<a href="http://wikidata.org/entity/Q'+data["wikidata_id"]+'" target_blank>' + data["wikidata_id"] + '</a>' : 'null'
                        }
                    },
                    {
                        "data" : null,
                        "render" : function(data, type, row) {
                            let href = (data["n_files"] > 0) ? 'href ="http://addressforall.org/api-origin?donor_id=' + data["id"] + '"' : '';
                            let sclass = (href == '') ? "btn-disabled" : "btn";
                            return '<div align="center"><a style="text-decoration: none" class="'+sclass+'" '+href+' target_blank>'+'&nbsp;'+data["n_files"]+'&nbsp;'+'</a></div>' 
                        }
                    }
                ], /* endcolumns */
                "paging": $('#paginar').prop('checked'),
                "responsive": true,
                "pageLength" : 10
            });

        });

    }

    $(document).ready(function(){

        /* Pega parametro da url ?id=43242 quando o usuário está navegando de api-origin */
        let searchParams = new URLSearchParams(window.location.search);
        if (searchParams.has('id')){
            getdata(searchParams.get('id'));
        } 


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

</script>
