<!DOCTYPE html>
<html>
<head>
    <title>Editar Produto: <?= esc($produto['nome']) ?></title>
</head>
<body>
    <h1>Editar Produto</h1>

    <?php if (session()->getFlashdata('errors')): /* ... */ endif; ?>

    <?= form_open('produtos/' . $produto['id']) ?>

        <?= form_hidden('_method', 'PUT') ?> 
        
        <label for="nome">Nome do Produto:</label>
        <input type="text" name="nome" value="<?= old('nome', $produto['nome']) ?>" required>
        <br><br>

        <label for="preco">Preço:</label>
        <input type="number" step="0.01" name="preco" value="<?= old('preco', $produto['preco']) ?>" required>
        <br><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao"><?= old('descricao', $produto['descricao']) ?></textarea>
        <br><br>

        <button type="submit">Salvar Alterações</button>
    <?= form_close() ?>

</body>
</html>