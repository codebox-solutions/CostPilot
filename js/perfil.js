$(document).ready(function () {
  get_dados_usuario();

  $("#btn_alterar_email_usuario").on("click", function () {
    $("#modal_alterar_email").modal("show");
  });

  $("#btn_alterar_senha_usuario").on("click", function () {
    $("#modal_alterar_senha").modal("show");
  });

  $("#modal_alterar_email form").on("submit", function (e) {
    e.preventDefault();

    const email1 = $("#input_email_um_modal_alterar_email").val().trim();
    const email2 = $("#input_email_modal_dois_alterar_email").val().trim();
    const id = $(this).find("input[name='id']").val();

    if (email1 !== email2) {
      $("#erro_email").removeClass("d-none");
      return;
    }

    $("#erro_email").addClass("d-none");

    $.ajax({
      url: "atualizar_email.php",
      type: "POST",
      data: { id: id, novo_email: email1 },
      success: function (resposta) {
        if (resposta.includes("sucesso")) {
          location.reload();
        } else {
          $("#modal_erro_mensagem").html(resposta);
          $("#modal_erro").modal("show");
        }
      },
      error: function () {
        $("#modal_erro_mensagem").html("Erro ao tentar atualizar o email.");
        $("#modal_erro").modal("show");
      },
    });
  });

  $("#modal_alterar_senha form").on("submit", function (e) {
    e.preventDefault();

    const senha1 = $("#input_senha_um_modal_alterar_senha").val();
    const senha2 = $("#input_senha_modal_dois_alterar_senha").val();
    const id = $(this).find("input[name='id']").val();

    if (senha1 !== senha2) {
      $("#erro_senha").removeClass("d-none");
      return;
    }

    $("#erro_senha").addClass("d-none");

    $.ajax({
      url: "atualizar_senha.php",
      type: "POST",
      data: { id: id, nova_senha: senha1 },
      success: function (resposta) {
        if (resposta.includes("sucesso")) {
          location.reload();
        } else {
          $("#modal_erro_mensagem").html(resposta);
          $("#modal_erro").modal("show");
        }
      },
      error: function () {
        $("#modal_erro_mensagem").html("Erro ao tentar atualizar a senha.");
        $("#modal_erro").modal("show");
      },
    });
  });
});

function get_dados_usuario() {
  $.ajax({
    url: "http://localhost:8000/get_user.php",
    type: "GET",
    dataType: "json",
    success: function (res) {
      $("#perfil_id_usuario").text(res.data.id);
      $("#perfil_nome_usuario").text(res.data.name);
      $("#perfil_segundo_nome_usuario").text(res.data.name);
      $("#perfil_email_usuario").text(res.data.email);
      $("#perfil_ultimo_login_usuario").text(res.data.last_login);
    },
    error: function () {
      $("#modal_erro_mensagem").html("Erro ao carregar dados do usuário.");
      $("#modal_erro").modal("show");
    },
  });
}
