<?= $this->extend('admin/layouts/default') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Categorias</h2>
        <p>Adicionar uma nova categoria</p>
    </div>
    <div>
        <a href="<?= base_url('admin/categories') ?>" class="btn btn-light rounded">
            <i class="material-icons md-arrow_back"></i> Voltar
        </a>
    </div>
</div>

<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= base_url('admin/categories/store') ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Informações da Categoria</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label for="name" class="form-label">Nome da Categoria *</label>
                        <input type="text" class="form-control" id="name" name="name" required 
                               value="<?= old('name') ?>" placeholder="Nome da categoria">
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="description" name="description" rows="3" 
                                  placeholder="Descrição da categoria"><?= old('description') ?></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="parent_id" class="form-label">Categoria Pai</label>
                        <select class="form-select" id="parent_id" name="parent_id">
                            <option value="">Nenhuma (categoria principal)</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= old('parent_id') == $category['id'] ? 'selected' : '' ?>>
                                    <?= $category['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted">Selecione se esta categoria pertence a outra categoria</small>
                    </div>
                    
                    <div class="mb-4">
                        <label for="image" class="form-label">Imagem da Categoria</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="text-muted">Tamanho recomendado: 300x300px (Máx 2MB)</small>
                    </div>
                    
                    <div class="mb-4">
                        <div id="image-preview" class="mt-2" style="display: none;">
                            <img src="" alt="Preview da imagem" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" 
                                   <?= old('status', '1') ? 'checked' : '' ?>>
                            <span class="form-check-label">Categoria Ativa</span>
                        </label>
                        <small class="text-muted d-block">Desmarque para ocultar esta categoria na loja</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-outline-danger">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Categoria</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Preview da imagem selecionada
    document.getElementById('image').addEventListener('change', function() {
        const file = this.files[0];
        const previewContainer = document.getElementById('image-preview');
        const previewImage = previewContainer.querySelector('img');
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.style.display = 'block';
            };
            
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    });
</script>
<?= $this->endSection() ?> 