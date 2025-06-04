$(document).ready(function () {
    abre_um_em_cima_do_outro();
});

function abre_um_em_cima_do_outro() {
    $(".modal").on({
        "show.bs.modal": function() {
            var idx = $(".modal:visible").length;
            $(this).css("z-index", 1040 + 10 * idx);
            $("#modal_alerta_notificacao").css("z-index", 1041 + 10 * idx);
        },
        "shown.bs.modal": function() {
            var idx = $(".modal:visible").length - 1;
            $(".modal-backdrop").not(".stacked").css("z-index", 1039 + 10 * idx).addClass("stacked");
        },
        "hidden.bs.modal": function() {
            if ($(".modal:visible").length > 0) {
                setTimeout(function () {
                    $(document.body).addClass("modal-open");
                }, 0);
            }
        },
    });
}

function validar_campo(elemento, min, max) {
    let valor = elemento.val().trim();
    if (valor.length < min || valor.length > max) {
        elemento.addClass("is-invalid");
        isValid = false;
    }
}

function validar_email(email) {
    let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

function mostrar_erro(mensagem) {
    $('#modal_erro_mensagem').text(mensagem);
    $('#modal_erro').modal('show');
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