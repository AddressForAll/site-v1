
<pre id="api_default_preview"></pre>
<script>
if (api_uri_global && api_global_req_keys) {
  const preview_domNode = document.getElementById("api_default_preview");
  preview_domNode.appendChild( document.createTextNode(api_global_req_keys.join('\t')) );
  for (var i = 0; i < api_global_req.length; i++) {
    var text = Object.values( api_global_req[i] ).join('\t');
    preview_domNode.appendChild( document.createTextNode("\n"+text) );
  }
} else alert("ERRO NA CARGA DA API, confira a URL utilizada");
</script>
