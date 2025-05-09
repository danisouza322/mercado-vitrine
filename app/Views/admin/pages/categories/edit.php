<?= $this->extend('admin/layouts/default') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Categorias</h2>
        <p>Editar categoria: <?= $category['name'] ?></p>
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

<?php if (session()->has('error')): ?>
    <div class="alert alert-danger"><?= session('error') ?></div>
<?php endif; ?>

<form action="<?= base_url('admin/categories/update/' . $category['id']) ?>" method="post" enctype="multipart/form-data">
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
                               value="<?= old('name', $category['name']) ?>" placeholder="Nome da categoria">
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="description" name="description" rows="3" 
                                  placeholder="Descrição da categoria"><?= old('description', $category['description']) ?></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="parent_id" class="form-label">Categoria Pai</label>
                        <select class="form-select" id="parent_id" name="parent_id">
                            <option value="">Nenhuma (categoria principal)</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= old('parent_id', $category['parent_id']) == $cat['id'] ? 'selected' : '' ?>>
                                    <?= $cat['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted">Selecione se esta categoria pertence a outra categoria</small>
                    </div>
                    
                    <div class="mb-4">
                        <label for="image" class="form-label">Imagem da Categoria</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="text-muted">Tamanho recomendado: 300x300px (Máx 2MB). Deixe em branco para manter a imagem atual.</small>
                    </div>
                    
                    <div class="mb-4">
                        <div id="image-preview" class="mt-2" <?= empty($category['image']) ? 'style="display: none;"' : '' ?>>
                            <img src="<?= !empty($category['image']) ? base_url($category['image']) : '' ?>" alt="Preview da imagem" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" 
                                   <?= old('status', $category['status']) ? 'checked' : '' ?>>
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
                        <a href="<?= base_url('admin/categories') ?>" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Atualizar Categoria</button>
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
            <?php if (!empty($category['image'])): ?>
                // Se não houver nova imagem selecionada, manter a imagem atual
                previewImage.src = '<?= base_url($category['image']) ?>';
                previewContainer.style.display = 'block';
            <?php else: ?>
                // Se não houver imagem atual nem nova, esconder o preview
                previewContainer.style.display = 'none';
            <?php endif; ?>
        }
    });
</script>
<?= $this->endSection() ?> 