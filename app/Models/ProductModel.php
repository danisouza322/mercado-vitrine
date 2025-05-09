<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name', 'slug', 'description', 'short_description', 'price', 
        'sale_price', 'sku', 'stock_status', 'featured', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    protected $validationRules = [
        'name'     => 'required|min_length[3]|max_length[255]',
        'slug'     => 'permit_empty|is_unique[products.slug,id,{id}]',
        'price'    => 'required|numeric|greater_than[0]',
        'status'   => 'required|in_list[0,1]',
    ];
    
    protected $validationMessages = [];
    protected $skipValidation     = false;

    // Método para criar slug automaticamente
    protected function beforeInsert(array $data)
    {
        if (empty($data['data']['slug'])) {
            $data['data']['slug'] = url_title($data['data']['name'], '-', true);
        }
        
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        if (empty($data['data']['slug'])) {
            $data['data']['slug'] = url_title($data['data']['name'], '-', true);
        }
        
        return $data;
    }
    
    // Método para buscar produtos em destaque
    public function getFeaturedProducts($limit = 8)
    {
        return $this->where('featured', 1)
                    ->where('status', 1)
                    ->orderBy('id', 'DESC')
                    ->limit($limit)
                    ->find();
    }
    
    // Método para buscar produtos por categoria
    public function getProductsByCategory($categoryId, $limit = 12, $offset = 0)
    {
        $productCategoryModel = new ProductCategoryModel();
        
        $productIds = $productCategoryModel->select('product_id')
                                         ->where('category_id', $categoryId)
                                         ->findAll();
                                         
        $ids = array_column($productIds, 'product_id');
        
        if (empty($ids)) {
            return [];
        }
        
        return $this->whereIn('id', $ids)
                    ->where('status', 1)
                    ->orderBy('id', 'DESC')
                    ->limit($limit, $offset)
                    ->find();
    }
    
    // Método para buscar um produto pelo slug
    public function getProductBySlug($slug)
    {
        $product = $this->where('slug', $slug)
                       ->where('status', 1)
                       ->first();
                       
        if (!$product) {
            return null;
        }
        
        // Buscar categorias do produto
        $productCategoryModel = new ProductCategoryModel();
        $categoryModel = new CategoryModel();
        
        $categoryIds = $productCategoryModel->select('category_id')
                                           ->where('product_id', $product['id'])
                                           ->findAll();
                                           
        $ids = array_column($categoryIds, 'category_id');
        
        $categories = [];
        if (!empty($ids)) {
            $categories = $categoryModel->whereIn('id', $ids)->findAll();
        }
        
        // Buscar imagens do produto
        $productImageModel = new ProductImageModel();
        $images = $productImageModel->where('product_id', $product['id'])
                                  ->findAll();
        
        $product['categories'] = $categories;
        $product['images'] = $images;
        
        return $product;
    }
    
    // Método para buscar produtos relacionados
    public function getRelatedProducts($productId, $limit = 4)
    {
        $productCategoryModel = new ProductCategoryModel();
        
        // Buscar categorias do produto
        $categoryIds = $productCategoryModel->select('category_id')
                                           ->where('product_id', $productId)
                                           ->findAll();
                                           
        $ids = array_column($categoryIds, 'category_id');
        
        if (empty($ids)) {
            return $this->getFeaturedProducts($limit);
        }
        
        // Buscar produtos da mesma categoria, exceto o produto atual
        $relatedProductIds = $productCategoryModel->select('product_id')
                                               ->whereIn('category_id', $ids)
                                               ->where('product_id !=', $productId)
                                               ->findAll();
                                               
        $relatedIds = array_column($relatedProductIds, 'product_id');
        
        if (empty($relatedIds)) {
            return $this->getFeaturedProducts($limit);
        }
        
        return $this->whereIn('id', $relatedIds)
                    ->where('status', 1)
                    ->orderBy('id', 'DESC')
                    ->limit($limit)
                    ->find();
    }
    
    // Método para buscar a primeira imagem de um produto
    public function getProductFirstImage($productId)
    {
        $productImageModel = new ProductImageModel();
        
        // Procurar primeiro por uma imagem marcada como primária
        $primaryImage = $productImageModel->where('product_id', $productId)
                                         ->where('is_main', 1)
                                         ->first();
        
        if ($primaryImage) {
            return $primaryImage;
        }
        
        // Se não encontrar imagem primária, retornar a primeira imagem do produto
        return $productImageModel->where('product_id', $productId)
                               ->first();
    }
}
