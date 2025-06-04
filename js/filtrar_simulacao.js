 $(document).ready(function () {

    get_simulacoes();


    $("#filtro_nome_simulacoes").on("input", get_simulacoes);
    $("#filtro_interpolacao_simulacoes").on("change", get_simulacoes);
    $("#filtro_data_simulacoes").on("change", get_simulacoes);


    $("#btn_criar_nova_simulacao").click(function () {
      window.location.href = "nova_simulacao.php";
    });

    function get_simulacoes() {
      $.ajax({
        type: "GET",
        url: "buscar_simulacoes.php",
        data: {
          nome: $("#filtro_nome_simulacoes").val(),
          tipo: $("#filtro_interpolacao_simulacoes").val(),
          data: $("#filtro_data_simulacoes").val(),
        },
        dataType: "json",
        success: function (res) {
          if (res.erro) {
            alert("Erro: " + res.erro);
            $("#tabela_simulacoes").html('<tr><td colspan="5">Erro ao carregar simulações.</td></tr>');
            return;
          }

          if (res.length === 0) {
            $("#tabela_simulacoes").html('<tr><td colspan="5">Nenhuma simulação encontrada.</td></tr>');
            return;
          }

          let linhas = res.map(function (item) {
            return `
            <tr>
              <td>${item.nome}</td>
              <td>${item.tipo}</td>
              <td>${item.data}</td>
              <td>
                <button class="btn btn-primary" style="background-color: #1e4359;" onclick="abrir_simulacao(${item.id})">Visualizar</button>
                <button class="btn btn-dark" onclick="editar_simulacao(${item.id})">Editar</button>
                <button data-simulacao-id="${item.id}" class="btn btn-primary btn_exportar" style="background-color: #010d26;">Exportar</button>
              </td>
            </tr>`;
          }).join("");

          $("#tabela_simulacoes").html(linhas);


          $(".btn_exportar").on("click", function () {
            const id = $(this).data("simulacao-id");
            $("#modal_exportar").data("simulacao-id", id);
            $("#modal_exportar").modal("show");
          });
        },
        error: function () {
          alert("Erro ao buscar as simulações no servidor.");
          $("#tabela_simulacoes").html('<tr><td colspan="5">Erro na comunicação com o servidor.</td></tr>');
        },
      });
    }
  });