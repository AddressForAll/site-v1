<link rel="stylesheet" href="/resources/css/api.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script type="text/jacolumn_namevascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/sp-1.1.1/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"/>

<section class="main-api" id="api">
    <h1>Resultado da solicitação de API</h1>
    <table id="api_default_preview"></table>
<script>
    function createTableHeader(tableNode, headItems){
        var tbody = document.createElement('tbody');
        var thead = document.createElement('thead');
        var tr, td;
        tr = document.createElement('tr');
        for (var item of headItems){
            var td = tr.insertCell(); // must TH but...
            td.appendChild(document.createTextNode(item["data"]));
            td.style.fontWeight = 'bold';
        }
        thead.appendChild(tr);
        tableNode.appendChild(thead);
    }

    var url = data_url; // this variable `data_url` is defined during index.php call
    $.getJSON(url, function( data ) {
        var columns_list = Object.entries(data[0]);
        var columns = [];
        for (var i in columns_list){
            if (typeof columns_list[i][1] == 'object' && columns_list[i][1] != null){
                key_above = columns_list[i][0];
                for(var nested in columns_list[i][1]) columns.push({data: key_above + '.' + nested});
            }
            else columns.push({data: columns_list[i][0]}); 
        }
        createTableHeader(document.getElementById('api_default_preview'), columns);
        $('#api_default_preview').DataTable({
                    "bDestroy": true,
                    "dom": 'Bfrtip',
                    "buttons": ['copy', 'csv', 'excel', 'pdf'],
                    "data" : data,//JSON.stringify(api_global_req),
                    "columns" : columns,
                    "paging": $('#paginar').prop('checked'),
                    "responsive": true,
                    "pageLength" : 10
                });
    });
</script>

<!-- ADDING ANNOTATION FOR DEVS --> 
<?= include_once("default/api_default_devFoot.inc.php") ?>

</section>
