<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="cs/modal.css">
  <title>Modals</title>
</head>
<body>
  
<!-- Modal de Sucesso -->
<div class="modal fade" id="modal_sucesso" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-success">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modal_sucesso_titulo">Sucesso</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="modal_sucesso_mensagem">
        
      </div>
    </div>
  </div>
</div>

<!-- Modal de Erro -->
<div class="modal fade" id="modal_erro" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-danger">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modal_erro_titulo">Erro</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="modal_erro_mensagem">
        
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_exportar" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-dark">
      <div class="modal-header text-white">
        <h5 class="modal-title" style="color: #010D26">Exportar Simulação</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Escolha o formato de exportação:</p>

        <div class="d-flex gap-4">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="formato" id="formato_pdf" value="pdf" checked>
            <label class="form-check-label" for="formato_pdf">PDF</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="formato" id="formato_csv" value="csv">
            <label class="form-check-label" for="formato_csv">CSV</label>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="confirmar-exportar" class="btn btn-dark">Exportar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_pdf" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="print_area">
      <div class="modal-header">
        <h5 class="modal-title">Relatório de Simulação</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <h2 style="text-align:center;">COSTPILOT</h2>
        <p style="text-align:center;">Relatório de Simulação - Documento de Análise Financeira</p>
        <hr>

        <h4>DADOS DA SIMULAÇÃO</h4>
        <table class="table table-bordered">
          <tr><td>Nome do Produto:</td><td id="rel_produto"></td></tr>
          <tr><td>Data da Simulação:</td><td id="rel_data"></td></tr>
          <tr><td>ID da Simulação:</td><td id="rel_id"></td></tr>
        </table>

        <h4>DETALHES FINANCEIROS</h4>
        <table class="table table-bordered">
          <tr><td>Custo Fixo (R$):</td><td id="rel_custo_fixo"></td></tr>
          <tr><td>Custo Variável (R$):</td><td id="rel_custo_variavel"></td></tr>
          <tr><td>Margem de Lucro Desejada (%):</td><td id="rel_margem_lucro"></td></tr>
          <tr><td>Impostos (%):</td><td id="rel_impostos"></td></tr>
          <tr><td>Lucro Estimado (R$):</td><td id="rel_lucro_estimado"></td></tr>
        </table>

        <h4>CONFIGURAÇÕES AVANÇADAS</h4>
        <table class="table table-bordered">
          <tr><td>Aplicar Juros Compostos?</td><td id="rel_juros"></td></tr>
          <tr><td>Previsão de Fluxo de Caixa?</td><td id="rel_fluxo"></td></tr>
          <tr><td>Tipo de Interpolação:</td><td id="rel_interpolacao"></td></tr>
        </table>

        <h4>Observações:</h4>
        <p class="border p-2">
          Simulação gerada automaticamente pela plataforma CostPilot. Os valores apresentados são estimativas baseadas nas informações fornecidas pelo usuário. Este relatório não possui valor fiscal.
        </p>

        <p class="text-center">
          &copy; 2025 CostPilot - Relatório gerado em <span id="rel_gerado_em"></span>
        </p>
      </div>
      <div id="botoes-opcoes" class="modal-footer">
        <button class="btn btn-primary" onclick="imprimir_pdf()">Imprimir PDF</button>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_alterar_email" tabindex="-1" aria-labelledby="modalEmailLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="atualizar_email.php" onsubmit="return validarEmails()">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEmailLabel">Alterar Email</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="email1" class="form-label">Novo Email</label>
            <input type="email" class="form-control" id="input_email_um_modal_alterar_email" name="novo_email" required>
          </div>
          <div class="mb-3">
            <label for="email2" class="form-label">Confirmar Email</label>
            <input type="email" class="form-control" id="input_email_modal_dois_alterar_email" required>
          </div>
          <div class="text-danger d-none" id="erro_email">Os emails não coincidem.</div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark">Salvar</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="modal_alterar_senha" tabindex="-1" aria-labelledby="modalSenhaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="atualizar_senha.php" onsubmit="return validarSenhas()">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalSenhaLabel">Alterar Senha</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="senha1" class="form-label">Nova Senha</label>
            <input type="password" class="form-control" id="input_senha_um_modal_alterar_senha" name="nova_senha" required>
          </div>
          <div class="mb-3">
            <label for="senha2" class="form-label">Confirmar Senha</label>
            <input type="password" class="form-control" id="input_senha_modal_dois_alterar_senha" required>
          </div>
          <div class="text-danger d-none" id="erro_senha">As senhas não coincidem.</div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark">Salvar</button>
        </div>
      </div>
    </form>
  </div>
</div>

<style>
  @media print {
  #botoes-opcoes, .barra-navegacao, footer {
    display: none !important;
  }
}
</style>