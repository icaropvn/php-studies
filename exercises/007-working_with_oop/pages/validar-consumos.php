<?php
    require_once "../models/Hospedagem.php";
    require_once "../models/Hospede.php";
    require_once "../models/Aposento.php";
    require_once "../models/Conta.php";
    require_once "../models/Consumo.php";
    session_start();

    $hospedagemAEditar = getHospedagemByCodigo($_GET["hospCode"]);

    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $novoItemConsumo = getConsumoByName($_POST["item-consumo"]);
        $consumosHospedagem = $hospedagemAEditar->getConta()->getConsumos();
        $itemJaExiste = false;

        // verifica se um produto do tipo ja foi adicionado (só atualiza os valores)
        foreach($consumosHospedagem as $consumo) {
            if($consumo->getCodigo() == $novoItemConsumo->getCodigo()) {
                $consumo->setQuantidade($consumo->getQuantidade() + (int)($_POST["quantidade-consumo"] ?? 0));
                $itemJaExiste = true;
            }
        }

        if(!$itemJaExiste) {
            $codigo = $novoItemConsumo->getCodigo();
            $descricao = $novoItemConsumo->getDescricao();
            $quantidade = (int)($_POST["quantidade-consumo"] ?? 0);
            $valorUnitario = $novoItemConsumo->getValorUnitario();

            $hospedagemAEditar->adicionarConsumo(
                new Consumo(
                    $codigo,
                    $descricao,
                    $quantidade,
                    $valorUnitario
                )
            ); 
        }
    }

    function getConsumoByName($nome) {
        foreach($_SESSION["consumos"] as $consumo) {
            if($consumo->getDescricao() == $nome)
                return $consumo;
        }
    }

    function getHospedagemByCodigo($codigo) {
        foreach($_SESSION["hospedagens"] as $hospedagem) {
            if($hospedagem->getCodigo() == $codigo)
                return $hospedagem;
        }
    }

    function exibirDadosHospedagem($hospedagem) {
        echo "<span>Código: {$hospedagem->getCodigo()}</span>";
        echo "<span>Data de entrada: {$hospedagem->getDataEntrada()->format("d/m/Y")}</span>";
        echo "<span>Data de saída: {$hospedagem->getDataSaida()->format("d/m/Y")}</span>";
        echo "<span>Hóspede: {$hospedagem->getHospede()->getNome()}</span>";
        echo "<span>Aposento: {$hospedagem->getAposento()->getNome()}</span>";
        echo "<span>Total a pagar: R\${$hospedagem->getConta()->getTotalAPagar()}</span>";
    }

    function criarConsumos() {
        $proximoCodigo = count($_SESSION['consumos']) + 1;
        $_SESSION['consumos'][] = new Consumo(
            $proximoCodigo,
            "Água Mineral 500ml",
            0,
            4.00
        );

        $proximoCodigo = count($_SESSION['consumos']) + 1;
        $_SESSION['consumos'][] = new Consumo(
            $proximoCodigo,
            "Refrigerante Lata",
            0,
            6.50
        );

        $proximoCodigo = count($_SESSION['consumos']) + 1;
        $_SESSION['consumos'][] = new Consumo(
            $proximoCodigo,
            "Suco Natural 300ml",
            0,
            8.00
        );

        $proximoCodigo = count($_SESSION['consumos']) + 1;
        $_SESSION['consumos'][] = new Consumo(
            $proximoCodigo,
            "Sanduíche Natural",
            0,
            12.00
        );

        $proximoCodigo = count($_SESSION['consumos']) + 1;
        $_SESSION['consumos'][] = new Consumo(
            $proximoCodigo,
            "Barra de chocolate",
            0,
            5.50
        );

        $proximoCodigo = count($_SESSION['consumos']) + 1;
        $_SESSION['consumos'][] = new Consumo(
            $proximoCodigo,
            "Cerveja Long Neck",
            0,
            9.00
        );

        $proximoCodigo = count($_SESSION['consumos']) + 1;
        $_SESSION['consumos'][] = new Consumo(
            $proximoCodigo,
            "Vinho (taça)",
            0,
            18.00
        );

        $proximoCodigo = count($_SESSION['consumos']) + 1;
        $_SESSION['consumos'][] = new Consumo(
            $proximoCodigo,
            "Kit Higiene",
            0,
            10.00
        );
    }

    function listarConsumos($listaConsumos) {
        foreach($listaConsumos as $consumo) {
            echo "<div class=\"consumo-card\">";

            echo "<span>Código do produto: {$consumo->getCodigo()}</span>";
            echo "<span>Produto: <strong>{$consumo->getDescricao()}</strong></span>";
            echo "<span>Quantidade: {$consumo->getQuantidade()}</span>";
            echo "<span>Valor unitário: R\${$consumo->getValorUnitario()}</span>";
            echo "<span>Total: R\${$consumo->getValorTotal()}</span>";

            echo "</div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Validar Consumos - Refúgio das Estrelas</title>

    <style>
        .dados-hospedagem span {
            display: block;
            margin-top: 5px;
        }

        form {
            width: fit-content;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        form button {
            width: fit-content;
            padding: 6px 12px;
            cursor: pointer;
        }

        .consumos-card-container {
            display: flex;
            flex-wrap: wrap;
            column-gap: 20px;
            row-gap: 30px;
        }

        .consumo-card {
            width: 200px;
            display: flex;
            flex-direction: column;
            gap: 5px;
            background-color: #d3d3d3ff;
            border: 1px solid #acacacff;
            padding: 10px 12px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <a href="../index.php">Voltar</a>
    <h1>Refúgio das Estrelas</h1>
    <p>Validar consumos</p>
    <hr>

    <h2>Dados da hospedagem</h2>
    <div class="dados-hospedagem">
        <?php
            exibirDadosHospedagem($hospedagemAEditar);
        ?>
    </div>
    <hr>

    <h2>Registrar consumos</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?hospCode=' . urlencode($_GET["hospCode"])); ?>" method="POST">
        <label>
            Item:
            <select name="item-consumo">
                <?php
                    if(!isset($_SESSION["consumos"]) or empty($_SESSION["consumos"])) {
                        $_SESSION["consumos"] = [];
                        criarConsumos();
                    }

                    foreach($_SESSION["consumos"] as $itemConsumo) {
                        echo "<option>{$itemConsumo->getDescricao()}</option>";
                    }
                ?>
            </select>
        </label>
        <label>
            Quantidade:
            <input type="number" name="quantidade-consumo">
        </label>
        <button type="submit">Registrar</button>
    </form>
    <hr>

    <h2>Consumos registrados nessa hospedagem</h2>
    <div class="consumos-card-container">
        <?php
            if(empty($hospedagemAEditar->getConta()->getConsumos())) {
                echo "<p>Não há consumos registrados nesta hospedagem.</p>";
            }
            else {
                listarConsumos($hospedagemAEditar->getConta()->getConsumos());
            }
        ?>
    </div>
</body>
</html>