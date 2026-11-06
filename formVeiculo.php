<?php include "header.php" ?>

    <h2 class="text-center">Cadastro de Veículo</h2>
        
    <form action="actionVeiculo.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            
        <div class="row mb-3">
            <!-- Campo para upload da foto do veículo -->
            <label for="fotoVeiculo" class="form-label">Foto do Veículo:</label>
            <input type="file" id="fotoVeiculo" name="fotoVeiculo" class="form-control" accept="image/*" required>
            <div class="invalid-feedback">Por favor, envie uma foto do veículo.</div>
        </div>

        <div class="row mb-3">
            <!-- Campo para a marca do veículo -->
            <label for="marcaVeiculo" class="form-label">Marca:</label>
            <select id="marcaVeiculo" name="marcaVeiculo" class="form-select" required>
                <option value="">Selecione...</option>
                <option value="chevrolet">Chevrolet</option>
                <option value="fiat">Fiat</option>
                <option value="ford">Ford</option>
                <option value="volkswagen">Volkswagen</option>
            </select>
            <div class="invalid-feedback">Por favor, selecione uma marca.</div>
        </div>

        <div class="row mb-3">
            <!-- Campo para o modelo do veículo -->
            <label for="modeloVeiculo" class="form-label">Modelo:</label>
            <input type="text" id="modeloVeiculo" name="modeloVeiculo" class="form-control" placeholder="Ex: Celta, Uno" required>
            <div class="invalid-feedback">Por favor, insira o modelo do veículo.</div>
        </div>

        <div class="row mb-3">
            <!-- Campo para a placa do veículo -->
            <label for="placaVeiculo" class="form-label">Placa:</label>
            <input type="text" id="placaVeiculo" name="placaVeiculo" class="form-control" placeholder="Ex: ABC-1D23" required>
            <div class="invalid-feedback">Por favor, insira a placa do veículo.</div>
        </div>

        <!-- Botão para enviar o formulário -->
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Cadastrar Veículo</button>
        </div>

    </form>

<?php include "footer.php" ?>