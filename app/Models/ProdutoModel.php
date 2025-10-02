<?php namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{
    protected $table      = 'produtos'; // Nome da tabela no banco de dados
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; // Define o tipo de retorno (array ou object)
    protected $useSoftDeletes = true; // Se quiser usar Soft Deletes

    protected $allowedFields = ['nome', 'preco', 'descricao']; // Campos permitidos para escrita (INSERT/UPDATE)

    // Os métodos findAll(), find(), save() etc. são herdados da classe Model.
    protected $useTimestamps = true; 
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}