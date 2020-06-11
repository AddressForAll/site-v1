<?php include_once("header.php"); ?>

<!-- START CONTENT -->
<section class="main" id="dados">
  <div>
    <h1>Dados</h1>
    <p>
      Os dados disponibilizados pelo Instituto podem ser baixados por
      Município (Dados locais) ou ao nível nacional (Dados Nacionais).
    </p>

    <div class="container">

      <div class="timeline-item" step='Passo 1'>
        <h1>Verificação</h1>
        <p>
          AddressForAll ao receber dados, começa por verificar a licença destes dados (procura-se dados com licença aberta (CC0) ou CCBYSA ou Odbl.
        </p>
        <p>AddressForAll pode ainda receber dados privados que poderão ser utilizados para alguns serviços providos pelo Instituto de maneira anonima.</p>
      </div>

      <div class="timeline-item" step='Passo 2'>
        <h1>Integridade</h1>
        <p>AddressForAll garante a integridade destes dados, armazenando eles de maneira segura por um prazo de 30 anos
        </p>
      </div>

      <div class="timeline-item" step='Passo 3'>
        <h1>Tratamento</h1>
        <p>
          AddressForAll trata os dados limpando e organizando-os
        </p>
      </div>

      <div class="timeline-item" step='Passo 4'>
        <h1>Normalização</h1>
        <p>
          AddressForAll extrai da combinação dos dados um dado "otimizado" utilizado pelo AddressForAll para prover serviços otimizados através de API. Por exemplo a API de Geolocalização que retorna uma latitude / Longitude quando lhe é submetido um endereço postal.
        </p>
      </div>

    </div>

  </div>
  <div class='buttons-dados'>
    <button>Dados locais</button>
    <button>Dados nacionais</button>
  </div>
</section>
<!-- END CONTENT -->

<?php include_once("footer.php"); ?>