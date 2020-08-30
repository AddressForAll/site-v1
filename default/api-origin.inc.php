<section class="main" id="api">
    <div><h1>API - Resgatar dados</h1></div>
    <span><strong>Dados: </strong>Origin</span>
    <br><label><strong>Estado: </strong></label><select id="estados"></select>
    <br><label><strong>Cidade: </strong></label>
    <select id="cidades"><option selected value='all'>Trazer Tudo</option></select>
    <br><label><strong>Paginar Resultado: </strong></label><input type="checkbox" id="paginar" checked>
    <br><strong><button onclick="getdata();">Consultar</button></strong>
    <br>
    <br>
    <table id="tabela" class="display" style="display: none;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Id City</th>
                <th>City Name</th>
                <th>File Name</th>
                <th>File Size</th>
                <th>File Version</th>
                <th>Donor</th>
                <th>Donor Legal Name</th>
                <th>Pack Accepted Date</th>
                <th>Ingest Instant</th>
            </tr>
        </thead>
    </table>
    <div id="definepaginacao" style="display: none;">
        <strong>Configurar resultados por página</strong>
        <select id="paginacao">
            <option value="10">10</option>
            <option value="30" selected>30</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="-1">Mostrar tudo</option>
        </select>
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
    function getdata(){
        var uf = $("#estados").children("option:selected").val();
        var city = $("#cidades").children("option:selected").val();
        var url = "http://addressforall.org/_sql/origin";
        url += uf != "all" ? "?city_state=eq." + uf : "";
        url += city != "all" ? "&city_name=eq." + city : "";
        $.getJSON(url, function( data ) {
            //console.log(typeof(data));
            $('#tabela').show();
            $('#definepaginacao').show();
            $('#tabela').DataTable({
                "bDestroy": true,
                "dom": 'Bfrtip',
                "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
                "data" : data,
                "columns" : [
                    {"data" : "id"},
                    {"data" : "city_id"},
                    {"data" : "cityname"},
                    {
                        "data" : null, 
                        "render" : function(data, type, row) {
                                        return '<a href="http://preserv.addressforall.org/download/' + data["fhash"] + "/" + data["fmeta"].ext + '" target_blank>' + data["fname"] + '</a>' 
                                    }
                        
                    },
                    {
                        "data" : null, 
                        "render" : function(data, type, row) {
                                        return parseFloat((data["fmeta"].size / (1024 ** 2))).toFixed(2) + "MB"
                                    }
                    },
                    {"data" : "fversion"},
                    {
                        "data" : null,
                        "render" : function(data, type, row) {
                                        return '<a href="http://localhost:3001/api-donor?id='+data["donor_id"]+'" target_blank>' + data["donor_id"] + " - " + data["donor_shortname"] + '</a>' 
                                    }
                    
                    },
                    {
                        "data" : null,
                        "render" : function(data, type, row) {
                                        return '<a href="'+data["donor_url"]+'" target_blank>'+data["donor_legalname"]+'</a>' 
                                    }
                    
                    },
                    {"data" : "pack_accepted_date"},
                    {"data" : "ingest_instant"}
                ],
                "paging": $('#paginar').prop('checked'),
                "responsive": true,
                "pageLength" : 30
            });

        });

    }

    $(document).ready(function(){
        $.getJSON('http://addressforall.org/_sql/dim_state', function(data){
            var options = "<option selected value='all'>Trazer Tudo</option>";
            for (var x = 0; x < data.length; x++) {
                options += '<option value="' + data[x]['state'] + '">' + data[x]['state'] + '</option>';
            }
            $('#estados').html(options);
        });

        $('#estados').on('change', function (){
            var estado_selecionado = $("#estados").children("option:selected").val();
            $.getJSON('http://addressforall.org/_sql/city?state=eq.'+estado_selecionado, function(data){
                var options = "<option selected value='all'>Trazer Tudo</option>";
                for (var x = 0; x < data.length; x++) {
                    options += '<option value="' + data[x]['name'] + '">' + data[x]['name'] + '</option>';
                }
                $('#cidades').html(options);
            });
        });

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
