<script src="/resources/frameworks/tabulator/js/tabulator.js"></script>
<link rel="stylesheet" href="/resources/frameworks/tabulator/css/tabulator.css"/>
<style>
</style>
<section class="main" id="api">
    <div>
        <h1>API - Resgatar dados</h1>
        <form method="POST">
            <span><strong>Dados: </strong>Cidades</span>
            <br>
            <label for="scales"><strong>Estado: </strong></label><select id="estados"></select>
            <br>
            <label for="scales"><strong>Cidade: </strong></label>
            <select id="cidades"><option selected value='all'>Trazer Tudo</option></select>
            <br>
            <label for="scales"><strong>Paginar Resultado: </strong></label><input type="checkbox" id="paginar" checked>
            <br>
            <stron><a href="#" style="text-decoration: none;" onclick="getdata();">Consultar</a></strong>
        </form> 
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
<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
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
            paginationSizeSelector:[3, 6, 8, 10],
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
