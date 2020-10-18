<link rel="stylesheet" href="/resources/css/api.css">
<style>
#api_default_preview {  border-collapse: collapse; }
#api_default_preview td { border: 1px solid #777; }
#api_default_preview thead { font-size: 70%; }

</style>
<!-- section class="main-api" id="api" -->
<h1>Resultado da solicitação de API</h1>
<table id="api_default_preview" width="100%" border="1"></table><!-- add css by id -->
<script>
function tableCreate_fromArrayObjects(tableNode,arrInput,headItems){
    const borderStyle='1px solid #555';
    var tbody = document.createElement('tbody');
    var thead = document.createElement('thead');
    var tr, td;
    tr = document.createElement('tr');
    for (var item of headItems){
      var td = tr.insertCell(); // must TH but...
      td.appendChild(document.createTextNode(item));
      td.style.fontWeight = 'bold';
    }
    thead.appendChild(tr);
    for (var line of arrInput) {
      tr = document.createElement('tr');
      for ( var  item  of  Object.values(line) ){
        var td = tr.insertCell();
        td.appendChild(document.createTextNode(item));
      }
      tbody.appendChild(tr);
    }
    tableNode.appendChild(thead);
    tableNode.appendChild(tbody);
} // \func

if (api_uri_global && api_global_req_keys)
  tableCreate_fromArrayObjects(
    document.getElementById('api_default_preview'),
    api_global_req,
    api_global_req_keys
  );
else alert("ERRO NA CARGA DA API, confira a URL utilizada");
</script>

<!-- /section -->
