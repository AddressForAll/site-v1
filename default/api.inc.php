<script src="/resources/frameworks/tabulator/js/tabulator.js"></script>
<link rel="stylesheet" href="/resources/frameworks/tabulator/css/tabulator.css"/>
<style>
</style>
<section class="main" id="api">
    <div>
        <h1>API - Resgatar dados</h1>
            <span><strong>Dados: </strong>Cidades</span>
            <br>
            <label for="scales"><strong>Estado: </strong></label><select id="estados"></select>
            <br>
            <label for="scales"><strong>Cidade: </strong></label>
            <select id="cidades"><option selected value='all'>Trazer Tudo</option></select>
            <br>
            <label for="scales"><strong>Paginar Resultado: </strong></label><input type="checkbox" id="paginar" checked>
            <br>

            <!-- FILTRO AVANÇADO -->
            <div>
            <label for="scales"><strong>Filtro avançado: </strong></label>
                <select id="filter-field">
                    <option></option>
                    <option value="ibge_id">Id Ibge</option>
                    <option value="name">Name</option>
                    <option value="state">State</option>
                    <option value="abbrev3">Abbrev3</option>
                    <option value="wikidata_id">Id Wikdata</option>
                    <option value="lexlabel">Lex Label</option>
                    <option value="isolabel_ext">ISO Label</option>
                    <option value="ddd">DDD</option>
                </select>

                <select id="filter-type">
                    <option value="=">=</option>
                    <option value="<"><</option>
                    <option value="<="><=</option>
                    <option value=">">></option>
                    <option value=">=">>=</option>
                    <option value="!=">!=</option>
                    <option value="like">like</option>
                </select>
                <input id="filter-value" type="text" placeholder="Valor para filtrar">
                <button id="filter-clear">Limpar</button>
            </div>
            <stron><button onclick="getdata();">Consultar</button></strong>
    </div>
    <br>
    <div>
        <div class="downloads" style="margin: 10px;">
            <button id="download-csv">Download CSV</button>
            <button id="download-json">Download JSON</button>
        </div>
        <div id="dados"></div>
    </div>
</section>

<!-- IMPORTA JQUERY -->
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>

    function getdata(){
        var pagination = $('#paginar').prop('checked');
        var uf = $("#estados").children("option:selected").val();
        var city = $("#cidades").children("option:selected").val();

        var url = "http://addressforall.org/_sql/city";
        url += uf != "all" ? "?state=eq." + uf : "";
        url += city != "all" ? "&name=eq." + city : "";

        var table = new Tabulator("#dados", {
            ajaxURL: url,
            layout:"fitColumns",
            pagination: pagination ? "local" : "",
            paginationSize:10,
            paginationSizeSelector:[10, 30, 50, 100, true],
            columns:[
                {title:"Id IBGE", field:"ibge_id"},
                {title:"Name", field:"name"},
                {title:"State", field:"state"},
                {title:"Abbrev3", field:"abbrev3"},
                {title:"Id Wikdata", field:"wikidata_id"},
                {title:"Lex Label", field:"lexlabel"},
                {title:"ISO Label Ext", field:"isolabel_ext"},
                {title:"DDD", field:"ddd"}
            ],
        });
        document.getElementById("download-csv").addEventListener("click", function(){
            table.download("csv", "data.csv");
        });
        
        document.getElementById("download-json").addEventListener("click", function(){
            table.download("json", "data.json");
        });

        //Define variables for input elements
        var fieldEl = document.getElementById("filter-field");
        var typeEl = document.getElementById("filter-type");
        var valueEl = document.getElementById("filter-value");

        //Custom filter example
        function customFilter(data){
            return data;
        }

        //Trigger setFilter function with correct parameters
        function updateFilter(){
            var filterVal = fieldEl.options[fieldEl.selectedIndex].value;
            var typeVal = typeEl.options[typeEl.selectedIndex].value;

            var filter = filterVal == "function" ? customFilter : filterVal;

            if(filterVal == "function" ){
                typeEl.disabled = true;
                valueEl.disabled = true;
            }else{
                typeEl.disabled = false;
                valueEl.disabled = false;
            }

            if(filterVal){
                table.setFilter(filter, typeVal, valueEl.value);
            }
        }

        //Update filters on value change
        document.getElementById("filter-field").addEventListener("change", updateFilter);
        document.getElementById("filter-type").addEventListener("change", updateFilter);
        document.getElementById("filter-value").addEventListener("keyup", updateFilter);

        //Clear filters on "Clear Filters" button click
        document.getElementById("filter-clear").addEventListener("click", function(){
        fieldEl.value = "";
        typeEl.value = "=";
        valueEl.value = "";
        table.clearFilter();
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
