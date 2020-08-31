<section class="main" id="api">
    <h1>API - Resgatar dados</h1>
    <span>
        <strong>Dados: </strong>Origin
    </span>
    <br>

    <!-- FILTROS -->
    <span>
        <strong>Filtrar por: </strong>
    </span> 
    <input type="radio" id="radio_estados" name="tipo_do_filtro" value="estado">
    <label for="radio_estados">Estado</label>
    <input type="radio" id="radio_donors" name="tipo_do_filtro" value="donor">
    <label for="radio_donors">Donor</label>

    <!-- COMBOS -->
    <div id="div_estados" style="display: none;">
        <br><label><strong>Estado: </strong></label>
        <select id="estados"></select>
    </div>
    <div id="div_donors" style="display: none;">
        <br><label><strong>Donor: </strong></label>
        <select id="donors"></select>
    </div>

    <br>
    <label><strong>Paginar Resultado: </strong></label>
    <input type="checkbox" id="paginar" checked>

    <br>
    <button onclick="getdata();"><strong>Consultar</strong></button>
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
                <th>Donor</th>
                <th>Donor Legal Name</th>
                <th>Pack Accepted Date</th>
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
        var valor, atributo, url;
        if (param != null){
            valor = param;
            atributo = "donor_id";
        }
        else if ($('input[type=radio][name=tipo_do_filtro]:checked').val() == "estado") {
            valor = $("#estados").children("option:selected").val();
            atributo = "city_state";
        }
        else {
            valor = $("#donors").children("option:selected").val();
            atributo = "donor_vat_id";
        }

        url = "http://addressforall.org/_sql/origin";
        url += valor != "all" ? "?" + atributo + "=eq." + valor : "";

        $.getJSON(url, function(data) {
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
                                        return data["ctype"] + '&nbsp;' + '<a href="http://preserv.addressforall.org/download/' + data["fhash"] + "." + data["fmeta"].ext + '" target_blank>' + data["fhash"].substring(0, 7) + '</a>' + '&nbsp;v' + data["fversion"] 
                                    }
                        
                    },
                    {
                        "data" : null, 
                        "render" : function(data, type, row) {
                                        return parseFloat((data["fmeta"].size / (1024 ** 2))).toFixed(2) + "MB"
                                    }
                    },
                    {
                        "data" : null,
                        "render" : function(data, type, row) {
                                        return '<a href="http://addressforall.org/api-donor?id='+data["donor_id"]+'" target_blank>' + data["donor_id"] + " - " + data["donor_shortname"] + '</a>' 
                                    }
                    
                    },
                    {
                        "data" : null,
                        "render" : function(data, type, row) {
                                        return '<a href="'+data["donor_url"]+'" target_blank>'+data["donor_legalname"]+'</a>' 
                                    }
                    
                    },
                    {"data" : "pack_accepted_date"}
                ],
                "paging": $('#paginar').prop('checked'),
                "responsive": true,
                "pageLength" : 10
            });

        });

    }

    $(document).ready(function(){

        /* Pega parametro da url ?donor_id=43242 quando o usuário está navegando de api-donor */
        let searchParams = new URLSearchParams(window.location.search);
        if (searchParams.has('donor_id')){
            getdata(searchParams.get('donor_id'));
        } 

        /* Controla o radio que escolhe o tipo da filtragem */
        $('input[type=radio][name=tipo_do_filtro]').change(function() {
            if (this.value == 'estado') {
                $('#div_estados').show();
                $('#div_donors').hide();
            }
            else if (this.value == 'donor') {
                $('#div_donors').show();
                $('#div_estados').hide();
            }
        });


        /* Carregar option dos doadores */ 
        $.getJSON('http://api.addressforall.org/_sql/vw02donors_origin', function(data){
            var options = "<option selected value='all'>Trazer Tudo</option>";
            for (var x = 0; x < data.length; x++) {
                options += '<option value="' + data[x]['donor_vat_id'] + '">' + data[x]['donor_legalname'] + " -     (" + data[x]['n_files'] + ')</option>';
            }
            $('#donors').html(options);
        });


        /* Carregar option dos estados */ 
        $.getJSON('http://api.addressforall.org/_sql/vw01states_origin', function(data){
            var options = "<option selected value='all'>Trazer Tudo</option>";
            for (var x = 0; x < data.length; x++) {
                options += '<option value="' + data[x]['city_state'] + '">' + data[x]['city_state'] + " -     (" + data[x]['count'] + ')</option>';
            }
            $('#estados').html(options);
        });

        
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
