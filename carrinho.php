<?php session_start(); $totalGeral = 0; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Checkout | TechStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4">
                <h4 class="fw-bold mb-4">Seu Carrinho</h4>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-muted small">
                                <th>PRODUTO</th>
                                <th class="text-center">QTD</th>
                                <th class="text-end">SUBTOTAL</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($_SESSION['carrinho'])): ?>
                                <?php foreach ($_SESSION['carrinho'] as $id => $item): 
                                    $subtotal = $item['preco'] * $item['qtd'];
                                    $totalGeral += $subtotal;
                                ?>
                                <tr>
                                    <td>
                                        <p class="mb-0 fw-bold"><?= $item['nome'] ?></p>
                                        <small class="text-muted">R$ <?= number_format($item['preco'], 2, ',', '.') ?></small>
                                    </td>
                                    <td class="text-center"><?= $item['qtd'] ?></td>
                                    <td class="text-end fw-bold">R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
                                    <td class="text-end">
                                        <a href="limpar.php?remover=<?= $id ?>" class="text-danger text-decoration-none small">Remover</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center py-4">Carrinho vazio</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <a href="index.php" class="text-primary fw-bold text-decoration-none mt-3">← Continuar Comprando</a>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 bg-dark text-white">
                <h5 class="fw-bold mb-4">Resumo do Pedido</h5>
                <div class="d-flex justify-content-between mb-3">
                    <span>Total:</span>
                    <span class="fs-4 fw-bold">R$ <?= number_format($totalGeral, 2, ',', '.') ?></span>
                </div>
                <button class="btn btn-primary w-100 py-2 fw-bold" onclick="alert('Pedido Finalizado!')">Finalizar Compra</button>
                <a href="limpar.php?limpar_tudo=1" class="btn btn-link btn-sm text-white-50 mt-2">Esvaziar Carrinho</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>