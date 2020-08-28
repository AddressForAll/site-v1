<section class="main" id="api">
    <div><h1>API - Resgatar dados</h1></div>
    <span><strong>Dados: </strong>Cidades</span>
    <br><label for="scales"><strong>Estado: </strong></label><select id="estados"></select>
    <br><label for="scales"><strong>Cidade: </strong></label>
    <select id="cidades"><option selected value='all'>Trazer Tudo</option></select>
    <br><label for="scales"><strong>Paginar Resultado: </strong></label><input type="checkbox" id="paginar" checked>
    <br><strong><button onclick="getdata();">Consultar</button></strong>
    <br>
    <br>
    <table id="tabela" class="display" style="display: none;">
        <thead>
            <tr>
                <th>Id IBGE</th>
                <th>Name</th>
                <th>State</th>
                <th>Abbrev3</th>
                <th>Id Wikidata</th>
                <th>LEX Label</th>
                <th>ISO Label</th>
                <th>DDD</th>
            </tr>
        </thead>
    </table>
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
        var url = "http://addressforall.org/_sql/city";
        url += uf != "all" ? "?state=eq." + uf : "";
        url += city != "all" ? "&name=eq." + city : "";
        $.getJSON(url, function( data ) {
            //console.log(typeof(data));
            $('#tabela').show();
            $('#tabela').DataTable({
                "bDestroy": true,
                "dom": 'Bfrtip',
                "buttons": ['copy', 'csv', 'excel', 'pdf', 'print'],
                "data" : data,
                "columns" : [
                    {"data" : "ibge_id"},
                    {"data" : "name"},
                    {"data" : "state"},
                    {"data" : "abbrev3"},
                    {"data" : "wikidata_id"},
                    {"data" : "lexlabel"},
                    {"data" : "isolabel_ext"},
                    {"data" : "ddd"}
                ],
                "paging": $('#paginar').prop('checked'),
                "responsive": true
            });
        });

    }

    $(document).ready(function(){
        $.getJSON('http://addressforall.org/_sql/dim_state', function(data){
            var options = "<option selected value='all'>Trazer Tudo</option>";
            for (var x = 0; x < data.length; x++) {
                options += '<option value="' + data[x]['state'] + '">' + data[x]['state'] + " -     (" + data[x]['qt_city'] + ')</option>';
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
    });
</script>
