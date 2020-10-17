
<pre id="api_default_preview"></pre>
<script>
if (api_uri_global && api_global_req_keys) {
  const preview_domNode = document.getElementById("api_default_preview");
  preview_domNode.appendChild( document.createTextNode(api_global_req_keys.join('\t')) );
  for (var item in api_uri_global) if (api_uri_global.hasOwnProperty(item)) {
    var text = Object.values(item).join('\t');
    preview_domNode.appendChild( document.createTextNode(text) );
  }
} else alert("ERRO NA CARGA DA API, confira a URL utilizada");
</script>
