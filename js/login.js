$("#loginForm").on("submit", function (e) {
  e.preventDefault();

  $(".form-control").removeClass("is-invalid");

  const email = $("#email_login").val().trim();
  const senha = $("#senha_login").val();

  if (!email || !validar_email(email)) {
    $("#email_login").addClass("is-invalid").focus();
    return;
  }

  if (!senha || senha.length < 6) {
    $("#senha_login").addClass("is-invalid").focus();
    return;
  }

  autenticar_usuario(email, senha);
});

function autenticar_usuario(email, senha) {
  $.ajax({
    url: "autenticar.php",
    type: "POST",
    dataType: "json",
    data: { email, senha },
    success: function (res) {
      if (res.status === "sucesso" && res.redirect) {
        window.location.href = res.redirect;
      } else {
        mostrar_erro("Redirecionamento inválido.");
      }
    },
    error: function (xhr) {
      let resposta = {};
      try {
        resposta = JSON.parse(xhr.responseText);
      } catch (e) {
        resposta.mensagem = "Erro inesperado. Tente novamente.";
      }

      mostrar_erro(resposta.mensagem || "Erro desconhecido.");
    },
  });
}
