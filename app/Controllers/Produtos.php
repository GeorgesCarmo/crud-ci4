<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Produtos extends Controller
{
    public function __construct()
    {
        // Carrega o helper de URL para redirecionamentos
        helper('form');
    }
    // Método padrão que será chamado se a URL for /produtos
    public function index()
    {
        // 1. Carrega o Model (interação com BD)
        $produtoModel = model('ProdutoModel');
        // 2. Chama um método do Model para buscar os dados
        $dados['produtos'] = $produtoModel->findAll(); 

        // 3. Carrega a View e passa os dados
        return view('produtos', $dados); 
    }

    protected $helpers = ['form'];

    public function formulario()
    {
        // Carrega a view que contém o formulário HTML
        return view('form'); 
    }

    public function adicionar()
    {
        // 1. Instancia o Model
        $model = model('ProdutoModel');

        // 2. Coleta os dados do POST (o CI4 lida com JSON ou dados de formulário)
        $data = $this->request->getPost();
        
        // Se a requisição for JSON, você pode usar:
        // $data = $this->request->getJSON(true); 

        // 3. Validação Básica (Essencial antes de salvar!)
        if (!$this->validate([
            'nome' => 'required|min_length[3]|max_length[100]',
            'preco' => 'required|numeric',
            // 'descricao' é opcional e pode ser validado se necessário
        ])) {
            // Retorna o erro de validação (HTTP 400 Bad Request)
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 4. Insere o produto usando o método save()
        // O método save() usa os dados e verifica os $allowedFields
        $model->save($data);

        // ... (Se a validação for bem-sucedida, salva e redireciona)
        
        // Se estiver trabalhando com HTML (não API pura), redirecione para a lista
        return redirect()->to('/produtos')->with('success', 'Produto criado com sucesso!');
    }

    public function edit($id = null)
    {
        // 1. Instancia o Model
        $model = model('ProdutoModel');

        // 2. Busca o produto pelo ID
        $produto = $model->find($id);

        // 3. Verifica se o produto existe
        if (empty($produto)) {
            // Retorna um erro 404
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // 4. Carrega a view de formulário, passando os dados do produto
        // Vamos reutilizar a view 'produtos/form.php', mas com o nome 'edit' para clareza
        // Nota: Você pode usar a mesma view 'form.php' ou criar uma 'edit.php'.
        return view('edit', [
            'produto' => $produto
        ]);
    }

    public function update($id = null)
    {
        // 1. Instancia o Model
        $model = model('ProdutoModel');

        // 2. Coleta os dados do POST
        $data = $this->request->getPost();
        
        // 3. Validação (Pode precisar de regras ligeiramente diferentes para update)
        if (!$this->validate([
            'nome' => 'required|min_length[3]|max_length[100]',
            'preco' => 'required|numeric',
        ])) {
            // Redireciona de volta com os erros e dados pré-preenchidos
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 4. Atualiza o produto. 
        // O Model::save() detecta o ID e realiza um UPDATE em vez de INSERT.
        // O ID deve ser adicionado aos dados para que o save() funcione como update.
        $data['id'] = $id; 
        
        $model->save($data);

        // 5. Redireciona para a lista com mensagem de sucesso
        return redirect()->to('/produtos')->with('success', 'Produto atualizado com sucesso!');
    }

    public function delete($id = null)
    {
        // 1. Instancia o Model
        $model = model('ProdutoModel');

        // 2. Chama o método delete() do Model
        // O CodeIgniter lida com o soft delete automaticamente
        if ($model->delete($id)) {
            // Sucesso: Redireciona para a lista com mensagem
            $message = 'Produto deletado com sucesso (Soft Delete).';
            return redirect()->to('/produtos')->with('success', $message);
        } else {
            // Falha (se o ID não foi encontrado)
            $message = 'Falha ao deletar o produto. ID não encontrado.';
            return redirect()->to('/produtos')->with('error', $message);
        }
    }
}
