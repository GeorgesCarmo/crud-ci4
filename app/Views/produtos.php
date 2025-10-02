<?php if (session()->getFlashdata('success')): ?>
    <div style="background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb;">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<h1>Lista de Produtos</h1>

<?php if (empty($produtos)): ?>
    <p>Nenhum produto cadastrado. <a href="<?= site_url('produtos/new') ?>">Adicionar um novo?</a></p>
<?php else: ?>
    
    <table border="1" style="width: 100%; border-collapse: collapse;"> 
        <thead>
            <tr>
                <th style="padding: 10px;">Nome</th>
                <th style="padding: 10px;">Preço</th>
                <th style="padding: 10px;">Descrição</th>
                <th style="padding: 10px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td style="padding: 10px;"><?= esc($produto['nome']) ?></td>
                    <td style="padding: 10px;">R$ <?= esc(number_format($produto['preco'], 2, ',', '.')) ?></td>
                    <td style="padding: 10px;"><?= esc($produto['descricao']) ?></td>
                    <td style="padding: 10px;">
                        <a href="<?= site_url('produtos/' . $produto['id'] . '/edit') ?>" class="btn btn-warning">
                            Editar
                        </a>
                    <?= form_open('produtos/' . $produto['id'], ['class' => 'd-inline', 'onsubmit' => "return confirm('Tem certeza que deseja deletar este produto?');"]) ?>
            
                        <?= form_hidden('_method', 'DELETE') ?> 
            
                        <button type="submit" class="btn btn-danger" style="margin-left: 5px;">
                            Deletar
                        </button>
                    <?= form_close() ?>    
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>