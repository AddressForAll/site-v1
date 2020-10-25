<section class="main" id="dados">
  <div>
    <h1>Dados</h1>
    <p>
      No contexto Brasil os dados disponibilizados pelo Instituto podem ser baixados por
      município (dados locais) ou ao nível nacional.
    </p>
    <h2>Fluxo geral repositorios de dados</h2>
    <p>
      AddressForAll recebe dados doados por diversas fontes, tais como prefeituras, IBGE, e OpenStreetMap,
      que publicam ou transferem por licença aberta (CC0, ODbL ou outra) os dados que produzem.
    </p>
    <div style='text-align:center'><img src='resources/img/datafigs-flow1.svg'></div>
    <p>Os dados de preservacao sao de uso geral (diversos projetos), e, uma vez homologados, recebem tratamento e garantia de preservacao por pelo menos 20 anos.</p>

    <h2>Dados a cada projeto</h2>
    <p>
      A Plataforma de Projetos do Instituto AddressForAll consome os dados preservados pelo [Projeto Digital Preservation](http://git.AddressForAll.org/digital-preservation).
      Cada projeto faz seu proprio recorte e filtragem de dados preservados.
    </p>
    <style>
      table.qtstatus td {text-align: center;}
      /* table.qtstatus tr td:nth-child(3) {text-align: center;}
      table.qtstatus tr td:nth-child(4) {text-align: right;} */
    </style>
    <table class="qtstatus" border="0">
      <caption style="caption-side:top;">Projeto AddressForAll Brasil, status atual</caption>
      <tr><td></td> <td><a href="http://git.AddressForAll.org/digital-preservation-BR">(preserved)</a></td>
         <td><a href="http://git.AddressForAll.org/in-BR">in-BR</a></td>
         <td><a href="http://git.AddressForAll.org/out-BR">out-BR</a></td>
      </tr>
      <tr><td></td><td colspan="3"><img src='resources/img/datafigs-flow2-tab.svg'></td></tr>
      <tr><td>Qt. arquivos: </td><td>val1</td> <td>val3</td> <td>val3</td></tr>
      <tr><td>Mega bytes: </td><td>val1</td> <td>val3</td> <td>val3</td></tr>
    </table>

    <p>...</p>

    <table border="0">
      <caption style="caption-side:top;">Projeto OSM.codes, status atual</caption>
      <tr><td></td><td colspan="3"><img src='resources/img/datafigs-flow2-tab.svg'></td></tr>
      <tr><td>Qt. arquivos: </td><td>1</td> <td>1</td> <td>1</td></tr>
      <tr><td>Mega bytes: </td><td>val1</td> <td>val3</td> <td>val3</td></tr>
    </table>

    <!-- #### -->
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
