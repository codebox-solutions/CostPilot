$(document).ready(function () {
  get_simulacoes();

  $("#btn_criar_nova_simulacao").click(function () {
    window.location.href = "nova_simulacao.php";
  });

  $("#confirmar-exportar").on("click", function () {
    const formato = $('input[name="formato"]:checked').val();
    const simulacao_id = $("#modal_exportar").data("simulacao-id");

    if (formato === "pdf") {
      gerar_pdf(simulacao_id);
    } else {
      gerar_csv(simulacao_id);
    }

    $("#modal_exportar").modal("hide");
  });
});

function get_simulacoes() {
  $.ajax({
    type: "GET",
    url: "http://localhost:8000/buscar_simulacoes.php",
    data: {
      nome: $("#filtro_nome_simulacoes").val(),
      tipo: $("#filtro_interpolacao_simulacoes").val(),
      data: $("#filtro_data_simulacoes").val(),
    },
    dataType: "json",
    xhrFields: {
      withCredentials: true,
    },
    success: function (res) {
      let concat = res
        .map(function (item) {
          return `
        <tr>
            <td>${item.nome}</td>
            <td>${item.tipo}</td>
            <td>${item.data}</td>
            <td>
                <button class="btn btn-primary btn_" style="background-color: #1e4359;"onclick="abrir_simulacao(${item.id})">
                    Visualizar
                </button>
                <button class="btn btn-dark" onclick="editar_simulacao(${item.id})">
                    Editar
                </button>
                <button data-simulacao-id=${item.id} class="btn btn-primary btn_exportar" style="background-color: #010d26;">
                    Exportar
                </button>
            </td>
        </tr>
      `;
        })
        .join("");

      $("#tabela_simulacoes").html(
        concat || '<tr><td colspan="5">Nenhuma simulação encontrada.</td></tr>'
      );

      $(".btn_exportar").on("click", function () {
        $("#modal_exportar").data("simulacao-id", $(this).data("simulacao-id"));
        $("#modal_exportar").modal("show");
      });
    },
    error: function () {
      mostrar_erro("Erro ao buscar as simulações no servidor.");
      $("#tabela_simulacoes").html(
        '<tr><td colspan="5">Erro na comunicação com o servidor.</td></tr>'
      );
    },
  });
}

function gerar_pdf(simulacao_id) {
  $.ajax({
    url: "http://localhost:8000/simulacoes.php",
    type: "GET",
    data: {
      id: simulacao_id,
    },
    dataType: "json",
    success: function (res) {
      $("#rel_produto").text(res.data.product_name);
      $("#rel_data").text(new Date(res.data.created_at).toLocaleDateString());
      $("#rel_id").text("CP-" + String(res.data.id).padStart(6, "0"));

      $("#rel_custo_fixo").text("R$ " + Number(res.data.fixed_cost).toFixed(2));
      $("#rel_custo_variavel").text(
        "R$ " + Number(res.data.variable_cost).toFixed(2)
      );
      $("#rel_margem_lucro").text(res.data.desired_margin_percent + "%");
      $("#rel_impostos").text((res.data.tax_percent ?? 0) + "%");

      const lucroEstimado =
        Number(res.data.fixed_cost) +
        Number(res.data.variable_cost) *
          (1 + Number(res.data.desired_margin_percent) / 100);
      $("#rel_lucro_estimado").text("R$ " + lucroEstimado.toFixed(2));

      $("#rel_juros").text(
        res.data.apply_compound_interest == 1 ? "Sim" : "Não"
      );
      $("#rel_fluxo").text(
        res.data.use_cashflow_prediction == 1 ? "Sim" : "Não"
      );
      $("#rel_interpolacao").text(res.data.interpolation_type || "-");

      $("#rel_gerado_em").text(new Date().toLocaleDateString());

      $("#modal_pdf").modal("show");
    },
    error: function () {
      mostrar_erro("Erro ao carregar os dados da simulação para o PDF.");
    },
  });
}

function imprimir_pdf() {
  $("#print_area").printThis({
    importCSS: true,
    importStyle: true,
    printDelay: 500,
  });
}

function gerar_csv(simulacao_id) {
  $.ajax({
    url: "http://localhost:8000/simulacoes.php",
    type: "GET",
    data: {
      id: simulacao_id,
    },
    dataType: "json",
    success: function (res) {
      const dados = res.data;

      const header = [
        "ID",
        "Nome do Produto",
        "Data de Criação",
        "Custo Fixo",
        "Custo Variável",
        "Margem de Lucro (%)",
        "Impostos (%)",
        "Juros Compostos",
        "Fluxo de Caixa",
        "Tipo de Interpolação",
      ];

      const row = [
        "CP-" + String(dados.id).padStart(6, "0"),
        dados.product_name,
        new Date(dados.created_at).toLocaleDateString(),
        dados.fixed_cost,
        dados.variable_cost,
        dados.desired_margin_percent,
        dados.tax_percent ?? 0,
        dados.apply_compound_interest == 1 ? "Sim" : "Não",
        dados.use_cashflow_prediction == 1 ? "Sim" : "Não",
        dados.interpolation_type || "-",
      ];

      const csvContent =
        header.join(",") + "\n" + row.map((val) => `"${val}"`).join(",");

      const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
      const url = window.URL.createObjectURL(blob);

      const $a = $("<a>")
        .attr("href", url)
        .attr("download", `simulacao_${dados.id}.csv`)
        .css("display", "none");

      $("body").append($a);
      $a[0].click();
      $a.remove();
      window.URL.revokeObjectURL(url);
    },
    error: function () {
      mostrar_erro("Erro ao gerar o CSV da simulação.");
    },
  });
}
