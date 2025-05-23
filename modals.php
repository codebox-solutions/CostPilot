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