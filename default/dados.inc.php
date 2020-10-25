<section class="main" id="dados">
  <div>
    <h1>Dados</h1>
    <p>
      No contexto Brasil os dados disponibilizados pelo Instituto podem ser baixados por
      município (dados locais) ou ao nível nacional.
    </p>
    <h2>Fluxo geral e repositorios de dados</h2>
    <p>
      AddressForAll recebe dados doados por diversas fontes, tais como prefeituras, IBGE, e OpenStreetMap,
      que publicam ou transferem por licença aberta (CC0, ODbL ou outra) os dados que produzem.
    </p>
    <div style='text-align:center'><img src='resources/img/datafigs-flow1.svg'></div>
    <p>Os dados de preservacao sao de uso geral (diversos projetos), e, uma vez homologados, recebem tratamento e garantia de preservacao por pelo menos 20 anos.</p>

    <h2>Dados a cada projeto</h2>
    <p>
      A Plataforma de Projetos do Instituto AddressForAll consome os dados preservados pelo <a href="http://git.AddressForAll.org/digital-preservation">Projeto Digital Preservation</a>.
      Cada projeto faz seu proprio recorte e filtragem de dados preservados.
    </p>
    <style>
      table.qtstatus td {text-align: center;}
      table.qtstatus td.smallLabel {text-align: left; font-size: 75%;}
      /*
      table.qtstatus tr.totFile td:not(.smallLabel) {font-weight:bold;}
      table.qtstatus tr td:nth-child(3) {text-align: center;}
      table.qtstatus tr td:nth-child(4) {text-align: right;} */
    </style>
<?php
    // get by JSON API the values!
    $aVals['a4a-count'] = ['preserv'=>11, 'in'=>4, 'out'=>1];
    $aVals['a4a-size'] = ['preserv'=>1123, 'in'=>456, 'out'=>123];

    $aVals['osmCodes-count'] = ['preserv'=>22, 'in'=>3, 'out'=>2];
    $aVals['osmCodes-size'] = ['preserv'=>223, 'in'=>77, 'out'=>88];
?>
    <div style="text-align:center; align:center">
    <table id="qtstatus_a4a" class="qtstatus" border="0" align="center">
      <caption style="caption-side:top;">Projeto AddressForAll Brasil, status atual</caption>
      <tr><td width="65"></td> <td width="30%"><a href="http://git.AddressForAll.org/digital-preservation-BR">dig. preserv. BR</a></td>
         <td width="30%"><a href="http://git.AddressForAll.org/in-BR">in-BR</a></td>
         <td width="30%"><a href="http://git.AddressForAll.org/out-BR">out-BR</a></td>
      </tr>
      <tr><td></td><td colspan="3"><img src='/resources/img/datafigs-flow2-tabPad.svg'></td></tr>
      <tr class="totFile"><td class="smallLabel">Qt. arquivos: </td>
          <td><b><?= $aVals['a4a-count']['preserv'] ?></b></td>
          <td><b><?= $aVals['a4a-count']['in'] ?></b></td>
          <td><b><?= $aVals['a4a-count']['out'] ?></b></td>
      </tr>
      <tr class="totFile"><td class="smallLabel">Mega bytes: </td>
        <td><b><?= $aVals['a4a-size']['preserv'] ?></b> zip</td>
        <td><b><?= $aVals['a4a-size']['in'] ?></b></td>
        <td><b><?= $aVals['a4a-size']['out'] ?></b></td>
      </tr>
    </table>

    <p>...</p>

    <table id="qtstatus_osmCodes" class="qtstatus" border="0" align="center">
      <caption style="caption-side:top;">Projeto OSM.codes, status atual</caption>
      <tr><td></td><td colspan="3"><img src='/resources/img/datafigs-flow2-tabPad.svg'></td></tr>
      <tr class="totFile"><td class="smallLabel">Qt. arquivos: </td>
          <td><b><?= $aVals['osmCodes-count']['preserv'] ?></b></td>
          <td><b><?= $aVals['osmCodes-count']['in'] ?></b></td>
          <td><b><?= $aVals['osmCodes-count']['out'] ?></b></td>
      </tr>
      <tr class="totFile"><td class="smallLabel">Mega bytes: </td>
        <td><b><?= $aVals['osmCodes-size']['preserv'] ?></b> zip</td>
        <td><b><?= $aVals['osmCodes-size']['in'] ?></b></td>
        <td><b><?= $aVals['osmCodes-size']['out'] ?></b></td>
      </tr>
    </table>
  </div><!-- center tables -->

<!-- script type="text/javascript">
  // abortado, usar server-side direto!
  let qtDom = $("#qtstatus_a4a tr.totFileCount td:nth-child(2)").text('hello!');
</script -->

    <!-- #### -->
    <h1>Dados do Projeto AddressForAll</h1>
    Ciclo de processamento nos dados relativos a pontos de endereco, reunidos e consolidados pelo projeto.

    <div class="container">


      <div class="timeline-item" step='Passo 1'>
        <h1>Verificação</h1>
        <p>
          AddressForAll ao receber dados, começa por verificar a licença destes dados (procura-se dados com licença aberta (CC0) ou CCBYSA ou Odbl.
        </p>
        <p>AddressForAll pode ainda receber dados privados que poderão ser utilizados para alguns serviços providos pelo Instituto de maneira anonima.</p>
        <div class='dados-passo passo1'><img src='resources/img/passo1.1.png'><img src='resources/img/passo1.2.png'></div>
      </div>

      <div class="timeline-item" step='Passo 2'>
        <h1>Integridade</h1>
        <p>AddressForAll garante a integridade destes dados, armazenando eles de maneira segura por um prazo de 30 anos
        </p>
        <div class='dados-passo passo2'><img src='resources/img/passo2.png'></div>
      </div>

      <div class="timeline-item" step='Passo 3'>
        <h1>Tratamento</h1>
        <p>
          AddressForAll trata os dados limpando e organizando-os
        </p>
        <div class='dados-passo passo3'><img src='resources/img/passo3.1.png'><img src='resources/img/passo3.2.png'></div>
      </div>

      <div class="timeline-item" step='Passo 4'>
        <h1>Normalização</h1>
        <p>
          AddressForAll extrai da combinação dos dados um dado "otimizado" utilizado pelo AddressForAll para prover serviços otimizados através de API. Por exemplo a API de Geolocalização que retorna uma latitude / Longitude quando lhe é submetido um endereço postal.
        </p>
        <div class='dados-passo passo4'><img src='resources/img/passo4.png'></div>
      </div>

    </div>

  </div>
  <div class='buttons-dados'>
    <button>Dados locais</button>
    <button>Dados nacionais</button>
  </div>
</section>
