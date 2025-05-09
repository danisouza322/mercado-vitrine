<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\ProductCategoryModel;
use App\Models\ProductImageModel;

class Products extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $productCategoryModel;
    protected $productImageModel;
    
    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->productCategoryModel = new ProductCategoryModel();
        $this->productImageModel = new ProductImageModel();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Gerenciar Produtos - Painel Admin',
            'description' => 'Lista e gerenciamento de produtos',
            'products' => $this->productModel->findAll()
        ];
        
        return view('admin/pages/products/index', $data);
    }
    
    public function create()
    {
        $data = [
            'title' => 'Adicionar Produto - Painel Admin',
            'description' => 'Formulário para adicionar um novo produto',
            'categories' => $this->categoryModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        
        return view('admin/pages/products/create', $data);
    }
    
    public function store()
    {
        // Regras de validação
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'price' => 'required|numeric|greater_than[0]',
            'description' => 'required',
            'categories' => 'required',
            'product_images' => 'uploaded[product_images.0]|max_size[product_images,4096]|is_image[product_images]',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Preparar dados do produto
        $productData = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'sale_price' => $this->request->getPost('sale_price') ?: null,
            'description' => $this->request->getPost('description'),
            'short_description' => $this->request->getPost('short_description'),
            'sku' => $this->request->getPost('sku'),
            'stock_status' => $this->request->getPost('stock_status') ?: 'in_stock',
            'featured' => $this->request->getPost('featured') ? 1 : 0,
            'status' => $this->request->getPost('status') ? 1 : 0,
        ];
        
        // Inserir produto no banco
        $this->productModel->insert($productData);
        $productId = $this->productModel->getInsertID();
        
        // Relacionar produto com categorias
        $categories = $this->request->getPost('categories');
        if (is_array($categories)) {
            foreach ($categories as $categoryId) {
                $this->productCategoryModel->insert([
                    'product_id' => $productId,
                    'category_id' => $categoryId
                ]);
            }
        }
        
        // Upload de imagens
        $uploadedFiles = $this->request->getFiles('product_images');
        
        foreach ($uploadedFiles['product_images'] as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads/products', $newName);
                
                // Salvar referência no banco
                $this->productImageModel->insert([
                    'product_id' => $productId,
                    'image' => 'uploads/products/' . $newName,
                    'is_main' => $this->productImageModel->where('product_id', $productId)->countAllResults() == 0 ? 1 : 0
                ]);
            }
        }
        
        return redirect()->to('admin/products')
            ->with('message', 'Produto adicionado com sucesso');
    }
    
    public function edit($id)
    {
        $product = $this->productModel->find($id);
        
        if (!$product) {
            return redirect()->to('admin/products')
                ->with('error', 'Produto não encontrado');
        }
        
        // Buscar categorias do produto
        $productCategories = $this->productCategoryModel
            ->where('product_id', $id)
            ->findAll();
        
        $selectedCategories = array_column($productCategories, 'category_id');
        
        // Buscar imagens do produto
        $productImages = $this->productImageModel
            ->where('product_id', $id)
            ->findAll();
        
        $data = [
            'title' => 'Editar Produto - Painel Admin',
            'description' => 'Formulário para editar um produto existente',
            'product' => $product,
            'categories' => $this->categoryModel->findAll(),
            'selectedCategories' => $selectedCategories,
            'productImages' => $productImages,
            'validation' => \Config\Services::validation()
        ];
        
        return view('admin/pages/products/edit', $data);
    }
    
    public function update($id)
    {
        // Regras de validação
        $rules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'price' => 'required|numeric|greater_than[0]',
            'description' => 'required',
            'categories' => 'required',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Preparar dados do produto
        $productData = [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'sale_price' => $this->request->getPost('sale_price') ?: null,
            'description' => $this->request->getPost('description'),
            'short_description' => $this->request->getPost('short_description'),
            'sku' => $this->request->getPost('sku'),
            'stock_status' => $this->request->getPost('stock_status') ?: 'in_stock',
            'featured' => $this->request->getPost('featured') ? 1 : 0,
            'status' => $this->request->getPost('status') ? 1 : 0,
        ];
        
        // Atualizar produto no banco
        $this->productModel->update($id, $productData);
        
        // Atualizar relação com categorias
        // Primeiro, remover todas as relações existentes
        $this->productCategoryModel->where('product_id', $id)->delete();
        
        // Depois, adicionar as novas relações
        $categories = $this->request->getPost('categories');
        if (is_array($categories)) {
            foreach ($categories as $categoryId) {
                $this->productCategoryModel->insert([
                    'product_id' => $id,
                    'category_id' => $categoryId
                ]);
            }
        }
        
        // Upload de novas imagens, se houver
        $uploadedFiles = $this->request->getFiles();
        
        if (isset($uploadedFiles['product_images'])) {
            foreach ($uploadedFiles['product_images'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(ROOTPATH . 'public/uploads/products', $newName);
                    
                    // Salvar referência no banco
                    $this->productImageModel->insert([
                        'product_id' => $id,
                        'image' => 'uploads/products/' . $newName,
                        'is_main' => $this->productImageModel->where('product_id', $id)->countAllResults() == 0 ? 1 : 0
                    ]);
                }
            }
        }
        
        return redirect()->to('admin/products')
            ->with('message', 'Produto atualizado com sucesso');
    }
    
    public function delete($id)
    {
        // Verificar se o produto existe
        $product = $this->productModel->find($id);
        
        if (!$product) {
            return redirect()->to('admin/products')
                ->with('error', 'Produto não encontrado');
        }
        
        // Remover relações com categorias
        $this->productCategoryModel->where('product_id', $id)->delete();
        
        // Remover imagens do produto (arquivos físicos e registros no banco)
        $productImages = $this->productImageModel->where('product_id', $id)->findAll();
        
        foreach ($productImages as $image) {
            $filePath = ROOTPATH . 'public/' . $image['image'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        $this->productImageModel->where('product_id', $id)->delete();
        
        // Finalmente, remover o produto
        $this->productModel->delete($id);
        
        return redirect()->to('admin/products')
            ->with('message', 'Produto excluído com sucesso');
    }
    
    public function deleteImage($imageId)
    {
        $image = $this->productImageModel->find($imageId);
        
        if (!$image) {
            return $this->response->setJSON(['success' => false, 'message' => 'Imagem não encontrada']);
        }
        
        $productId = $image['product_id'];
        
        // Remover arquivo físico
        $filePath = ROOTPATH . 'public/' . $image['image'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        
        // Remover registro do banco
        $this->productImageModel->delete($imageId);
        
        // Se a imagem removida era primária, definir outra imagem como primária
        if ($image['is_main']) {
            $nextImage = $this->productImageModel->where('product_id', $productId)->first();
            if ($nextImage) {
                $this->productImageModel->update($nextImage['id'], ['is_main' => 1]);
            }
        }
        
        return $this->response->setJSON(['success' => true, 'message' => 'Imagem removida com sucesso']);
    }
    
    public function setPrimaryImage($imageId)
    {
        $image = $this->productImageModel->find($imageId);
        
        if (!$image) {
            return $this->response->setJSON(['success' => false, 'message' => 'Imagem não encontrada']);
        }
        
        $productId = $image['product_id'];
        
        // Redefinir todas as imagens como não primárias
        $this->productImageModel->where('product_id', $productId)
            ->set(['is_main' => 0])
            ->update();
        
        // Definir a imagem selecionada como primária
        $this->productImageModel->update($imageId, ['is_main' => 1]);
        
        return $this->response->setJSON(['success' => true, 'message' => 'Imagem principal definida com sucesso']);
    }
} 