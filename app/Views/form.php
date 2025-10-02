<!DOCTYPE html>
<html>
<head>
    <title>Novo Produto</title>
</head>
<body>
    <h1>Adicionar Novo Produto</h1>

    <?php 
    // Exibe erros de validação, se houver
    if (session()->getFlashdata('errors')): ?>
        <div style="color: red;">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <?= form_open('/produtos') ?>
        
        <label for="nome">Nome do Produto:</label>
        <input type="text" name="nome" value="<?= old('nome') ?>" required>
        <br><br>

        <label for="preco">Preço:</label>
        <input type="number" step="0.01" name="preco" value="<?= old('preco') ?>" required>
        <br><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao"><?= old('descricao') ?></textarea>
        <br><br>

        <button type="submit">Salvar Produto</button>
    <?= form_close() ?>

</body>
</html>