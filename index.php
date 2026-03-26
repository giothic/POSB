<?php
session_start();

function formatarMoeda($valor) {
    return "R$ " . number_format($valor, 2, ',', '.');
}

function analisarDesempenho($vendaItem, $faturamentoTotal) {

    if ($faturamentoTotal == 0) {
        return "Sem dados";
    }

    $porcentagem = ($vendaItem / $faturamentoTotal) * 100;

    return ($porcentagem < 10)
        ? "Baixa Conversão"
        : "Produto Estrela";
}

if (!isset($_SESSION["produtos"])) {
    $_SESSION["produtos"] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $novoProduto = [
        "nome" => htmlspecialchars($_POST["nome"]),
        "preco" => floatval($_POST["preco"]),
        "venda" => floatval($_POST["venda"])
    ];

    $_SESSION["produtos"][] = $novoProduto;
}

$faturamentoTotal = 0;
foreach ($_SESSION["produtos"] as $p) {
    $faturamentoTotal += $p["venda"];
}

$cards = "";

foreach ($_SESSION["produtos"] as $produto) {

    $precoFormatado = formatarMoeda($produto["preco"]);
    $status = analisarDesempenho($produto["venda"], $faturamentoTotal);

    $classe = ($status == "Baixa Conversão") ? "alerta" : "estrela";

    $cards .= "
    <div class='col-md-4'>
        <div class='card mb-4 shadow {$classe}'>
            <div class='card-body'>
                <h5>{$produto["nome"]}</h5>
                <p><strong>Preço:</strong> {$precoFormatado}</p>
                <p><strong>Status:</strong> {$status}</p>
            </div>
        </div>
    </div>
    ";
}

// ===== INJETA NO HTML =====
$html = file_get_contents("dashboard.html");
$html = str_replace("{{CARD}}", $cards, $html);

echo $html;