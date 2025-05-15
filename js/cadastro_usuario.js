$("#btn_cadastro_usuarios").on("click", function (e) {
  e.preventDefault();

  $(".form-control").removeClass("is-invalid");

  const nome = $("#cadastro_nome").val().trim();
  const email = $("#cadastro_email").val().trim();
  const senha = $("#cadastro_senha").val();
  const confirmarSenha = $("#cadastro_confirma_senha").val();

  if (!nome) {
    $("#cadastro_nome").addClass("is-invalid").focus();
    return;
  }

  if (!email || !validateEmail(email)) {
    $("#cadastro_email").addClass("is-invalid").focus();
    return;
  }

  if (!senha || senha.length < 6) {
    $("#cadastro_senha").addClass("is-invalid").focus();
    return;
  }

  if (!confirmarSenha || confirmarSenha !== senha) {
    $("#cadastro_confirma_senha").addClass("is-invalid").focus();
    return;
  }

  cadastrar_usuarios(nome, email, senha);
});

function validateEmail(email) {
  let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regex.test(email);
}

function cadastrar_usuarios(nome, email, senha) {
  $("#btn_cadastro_usuarios").prop("disabled", true);

  $.ajax({
    url: "http://localhost:8000/cadastro_usuario_script.php",
    type: "POST",
    data: {
      nome,
      email,
      senha,
    },
    success: function (res) {
      $("#modal_sucesso_mensagem").html(
        res.mensagem || "Usuário cadastrado com sucesso!"
      );
      $("#modal_sucesso").modal("show");
      $("#form_cadastro")[0].reset();

      $('#modal_sucesso').on('hidden.bs.modal', function () {
        window.location.href = "login.php";
      });

    },
    error: function (xhr) {
      let resposta = {};

      try {
        resposta = JSON.parse(xhr.responseText);
      } catch (e) {
        resposta.mensagem = "Erro inesperado. Tente novamente.";
      }

      $("#modal_erro_mensagem").html(resposta.mensagem || "Erro desconhecido.");
      $("#modal_erro").modal("show");
    },
  });
}
