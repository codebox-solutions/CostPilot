<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/modal_editar_simulacao.css">
    <title>Document</title>
</head>
<body>
    
<div class="modal-simulacao" id="modal_simulacao">
    <h1>Editar Simulação</h1>
 <form class="editSimulacaoForm">
                <div class="form-group-modal">
                    <label for="nome_nova_simulacao">Nome do produto:</label>
                    <input type="text" id="nome_nova_simulacao" class="form-control-modal" name="productname" placeholder="Ex: Camisa Gucci Tamanho P" required />
                </div>

                <div class="form-group-modal">
                    <label for="custo_fixo">Custo Fixo (R$):</label>
                    <input type="number" min="0" step="0.01" id="custo_fixo" class="form-control-modal" name="custofixo" required />
                </div>

                <div class="form-group-modal">
                    <label for="custo_variavel">Custo Variável Unitário (R$):</label>
                    <input type="number" min="0" step="0.01" id="custo_variavel" class="form-control-modal" name="custovariavel" required />
                </div>

                <div class="form-group-modal">
                    <label for="volume">Volume Produzido/Vendido:</label>
                    <input type="number" min="1" step="1" id="volume" class="form-control-modal" name="volume" required />
                </div>

                <div class="form-group-modal">
                    <label for="impostos">Impostos (Opcional, %):</label>
                    <input type="number" min="0" step="0.01" id="impostos" class="form-control-modal" name="impostos" />
                </div>

                 </form>     

                <div class="form-actions-modal">
      <button type="button" class="btn-cancel-modal">Cancelar</button>
      <button type="submit" class="btn-submit-modal">Salvar</button>
                </div>
</div>
  
  
        </div>
</body>
</html>