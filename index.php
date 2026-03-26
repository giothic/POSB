<?php
$produtos = [
    101 => ['nome' => 'Teclado Mecânico RGB', 'preco' => 250.00, 'cat' => 'Periféricos'],
    102 => ['nome' => 'Mouse Gamer 12000 DPI', 'preco' => 120.00, 'cat' => 'Periféricos'],
    103 => ['nome' => 'Monitor 144Hz IPS', 'preco' => 1250.00, 'cat' => 'Monitores'],
    104 => ['nome' => 'Headset 7.1 Surround', 'preco' => 320.00, 'cat' => 'Áudio']
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>TechStore | Vitrine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">TECH<span class="text-primary">STORE</span></a>
        <a href="carrinho.php" class="btn btn-primary btn-sm px-4">Meu Carrinho 🛒</a>
    </div>
</nav>

<div class="container">
    <div class="row g-4">
        <?php foreach ($produtos as $id => $info): ?>
        <div class="col-md-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <span class="badge bg-soft-primary text-primary mb-2"><?= $info['cat'] ?></span>
                    <h5 class="card-title fw-bold"><?= $info['nome'] ?></h5>
                    <p class="text-muted small">ID: #<?= $id ?></p>
                    <h4 class="text-dark fw-bold mb-3">R$ <?= number_format($info['preco'], 2, ',', '.') ?></h4>
                    
                    <form action="processar.php" method="POST">
                        <input type="hidden" name="codproduto" value="<?= $id ?>">
                        <input type="hidden" name="nome" value="<?= $info['nome'] ?>">
                        <input type="hidden" name="preco" value="<?= $info['preco'] ?>">
                        
                        <div class="input-group mb-3">
                            <button class="btn btn-outline-secondary btn-sm" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">-</button>
                            <input type="number" name="qtd" class="form-control form-control-sm text-center" value="1" min="1">
                            <button class="btn btn-outline-secondary btn-sm" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">+</button>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 fw-semibold">Adicionar</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>