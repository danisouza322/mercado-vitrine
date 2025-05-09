<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductImageModel extends Model
{
    protected $table            = 'product_images';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['product_id', 'image', 'is_main'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
    protected $deletedField  = '';

    // Validation
    protected $validationRules = [
        'product_id'  => 'required|numeric',
        'image'       => 'required',
        'is_main'     => 'numeric|in_list[0,1]',
    ];
    
    protected $validationMessages = [];
    protected $skipValidation     = false;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Método para obter a imagem principal de um produto
    public function getMainImage($productId)
    {
        $mainImage = $this->where('product_id', $productId)
                         ->where('is_main', 1)
                         ->first();
                         
        // Se não tiver imagem principal, pegar a primeira imagem disponível
        if (!$mainImage) {
            $mainImage = $this->where('product_id', $productId)
                             ->first();
        }
        
        return $mainImage;
    }
    
    // Método para definir uma imagem como principal
    public function setMainImage($imageId, $productId)
    {
        // Primeiro, remover status de imagem principal das outras imagens
        $this->where('product_id', $productId)
             ->where('is_main', 1)
             ->set('is_main', 0)
             ->update();
             
        // Definir a nova imagem principal
        return $this->update($imageId, ['is_main' => 1]);
    }
}
