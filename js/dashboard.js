$(document).ready(function () {
  get_simulacoes();

  $("#btn_criar_nova_simulacao").click(function () {
    window.location.href = "nova_simulacao.php";
  })

  $('#confirmar-exportar').on('click', function () {
  const formato = $('input[name="formato"]:checked').val(); 
  const simulacao_id = $('#modal_exportar').data('simulacao-id');

  if (formato === 'pdf') {
    gerar_pdf(simulacao_id);
  } else {
    gerar_csv(simulacao_id);
  }

  $('#modal_exportar').modal('hide');
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
      let concat = res.map(function (item) {
          return `
        <tr>
            <td>${item.nome}</td>
            <td>${item.tipo}</td>
            <td>${item.data}</td>
            <td>
                <button class="btn btn-primary" style="background-color: #1e4359;"onclick="abrir_simulacao(${item.id})">
                    Vizualizar
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
    }).join("");

      $("#tabela_simulacoes").html(
        concat || '<tr><td colspan="5">Nenhuma simulação encontrada.</td></tr>'
      );

    $(".btn_exportar").on("click", function () {
      $('#modal_exportar').data('simulacao-id', $(this).data('simulacao-id'));
      $("#modal_exportar").modal("show");
  })
    },
    error: function () {
      alert("Erro ao buscar as simulações no servidor.");
      $("#tabela_simulacoes").html(
        '<tr><td colspan="5">Erro na comunicação com o servidor.</td></tr>'
      );
    },
  });
}

