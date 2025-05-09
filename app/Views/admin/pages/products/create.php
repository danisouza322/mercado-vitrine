<?= $this->extend('admin/layouts/default') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Produtos</h2>
        <p>Adicionar um novo produto</p>
    </div>
    <div>
        <a href="<?= base_url('admin/products') ?>" class="btn btn-light rounded">
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

<form action="<?= base_url('admin/products/store') ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Informações Básicas</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label for="name" class="form-label">Nome do Produto *</label>
                        <input type="text" class="form-control" id="name" name="name" required 
                               value="<?= old('name') ?>" placeholder="Nome do produto">
                    </div>
                    
                    <div class="mb-4">
                        <label for="sku" class="form-label">SKU (Código)</label>
                        <input type="text" class="form-control" id="sku" name="sku" 
                               value="<?= old('sku') ?>" placeholder="Ex: PROD-001">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="price" class="form-label">Preço *</label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="number" step="0.01" min="0" class="form-control" id="price" name="price" required 
                                           value="<?= old('price') ?>" placeholder="0.00">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="sale_price" class="form-label">Preço Promocional</label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="number" step="0.01" min="0" class="form-control" id="sale_price" name="sale_price" 
                                           value="<?= old('sale_price') ?>" placeholder="0.00">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="short_description" class="form-label">Descrição Curta</label>
                        <textarea class="form-control" id="short_description" name="short_description" rows="2" 
                                  placeholder="Resumo do produto para exibição em listagens"><?= old('short_description') ?></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="form-label">Descrição Completa *</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required 
                                  placeholder="Descrição detalhada do produto"><?= old('description') ?></textarea>
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Imagens do Produto *</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label for="product_images" class="form-label">Envie uma ou mais imagens (máx. 4MB cada) *</label>
                        <input type="file" class="form-control" id="product_images" name="product_images[]" multiple accept="image/*" required>
                        <small class="text-muted">A primeira imagem será definida como imagem principal.</small>
                    </div>
                    
                    <div class="image-preview mt-3 row" id="image-preview-container">
                        <!-- As imagens selecionadas aparecerão aqui -->
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Organização</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label for="categories" class="form-label">Categorias *</label>
                        <select class="form-select" id="categories" name="categories[]" multiple required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>" <?= in_array($category['id'], old('categories', [])) ? 'selected' : '' ?>>
                                    <?= $category['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted">Segure CTRL para selecionar múltiplas categorias</small>
                    </div>
                    
                    <div class="mb-4">
                        <label for="stock_status" class="form-label">Status de Estoque</label>
                        <select class="form-select" id="stock_status" name="stock_status">
                            <option value="in_stock" <?= old('stock_status') === 'in_stock' || !old('stock_status') ? 'selected' : '' ?>>Em Estoque</option>
                            <option value="out_of_stock" <?= old('stock_status') === 'out_of_stock' ? 'selected' : '' ?>>Fora de Estoque</option>
                            <option value="on_backorder" <?= old('stock_status') === 'on_backorder' ? 'selected' : '' ?>>Em Encomenda</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1" 
                                   <?= old('featured') ? 'checked' : '' ?>>
                            <span class="form-check-label">Produto em Destaque</span>
                        </label>
                        <small class="text-muted d-block">Aparecerá na seção de produtos em destaque</small>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1" 
                                   <?= old('status', '1') ? 'checked' : '' ?>>
                            <span class="form-check-label">Produto Ativo</span>
                        </label>
                        <small class="text-muted d-block">Desmarque para ocultar o produto na loja</small>
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <button type="reset" class="btn btn-outline-danger">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Produto</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Preview das imagens selecionadas
    document.getElementById('product_images').addEventListener('change', function() {
        const previewContainer = document.getElementById('image-preview-container');
        previewContainer.innerHTML = '';
        
        if (this.files) {
            for (let i = 0; i < this.files.length; i++) {
                const file = this.files[i];
                if (!file.type.match('image.*')) {
                    continue;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'col-3 mb-2';
                    
                    const img = document.createElement('img');
                    img.className = 'img-fluid img-thumbnail';
                    img.src = e.target.result;
                    img.title = file.name;
                    
                    div.appendChild(img);
                    previewContainer.appendChild(div);
                };
                
                reader.readAsDataURL(file);
            }
        }
    });
</script>
<?= $this->endSection() ?> 