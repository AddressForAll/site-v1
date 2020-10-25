<section class="main" id="dados">
  <div>
    <h1>Dados</h1>
    <p>
      No contexto Brasil os dados disponibilizados pelo Instituto podem ser baixados por
      município (dados locais) ou ao nível nacional.
    </p>

    <div class="container">

      <div class="timeline-item" step='Passo 0'>
        <h1>Fluxo da aquisicao de dados</h1>
        <p>
          AddressForAll recebe dados doados por diversas fontes, tais como prefeituras, IBGE, e OpenStreetMap,
          que publicam ou transferem por licença aberta (CC0, ODbL ou outra) os dados que produzem.
        </p>
        <div class='dados-passo'><img src='resources/img/datafigs-flow1.svg'></div>
      </div>

      <table border="1">
        <caption style="caption-side:top;">Projeto AddressForAll</caption>
        <tr><td colspan="3"><img src='resources/img/datafigs-flow2-tab.svg'></td></tr>
        <tr><td>val1</td> <td>val3</td> <td>val3</td></tr>
      </table>

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
