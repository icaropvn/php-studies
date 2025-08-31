<?php
    require_once "./models/Aposento.php";
    require_once "./models/Hospede.php";
    require_once "./models/Hospedagem.php";
    require_once "./models/Conta.php";
    require_once "./models/Consumo.php";
    session_start();

    function criarAposentos() {
        $proximoCodigo = count($_SESSION['aposentos']) + 1;
        $_SESSION['aposentos'][] = new Aposento(
            $proximoCodigo,
            120.00,
            "Quarto Econômico",
            "Simples, ideal para viajantes individuais.",
            101,
            true
        );
        
        $proximoCodigo = count($_SESSION['aposentos']) + 1;
        $_SESSION['aposentos'][] = new Aposento(
            $proximoCodigo,
            180.00,
            "Quarto Família",
            "Comporta até 4 pessoas, frigobar e varanda.",
            103,
            true
        );
        
        $proximoCodigo = count($_SESSION['aposentos']) + 1;
        $_SESSION['aposentos'][] = new Aposento(
            $proximoCodigo,
            200.00,
            "Quarto Executivo",
            "Voltado a negócios, espaço para trabalho e internet rápida.",
            107,
            true
        );

        $proximoCodigo = count($_SESSION['aposentos']) + 1;
        $_SESSION['aposentos'][] = new Aposento(
            $proximoCodigo,
            160.00,
            "Suíte Standard",
            "Confortável para duas pessoas, ar-condicionado e TV a cabo.",
            204,
            true
        );
        
        $proximoCodigo = count($_SESSION['aposentos']) + 1;
        $_SESSION['aposentos'][] = new Aposento(
            $proximoCodigo,
            240.00,
            "Suíte Luxo",
            "Quarto espaçoso com banheira de hidromassagem.",
            208,
            true
        );
        
        $proximoCodigo = count($_SESSION['aposentos']) + 1;
        $_SESSION['aposentos'][] = new Aposento(
            $proximoCodigo,
            320.00,
            "Suíte Master",
            "Ampla, cama king, vista para o mar e área de estar.",
            215,
            true
        );
        
        $proximoCodigo = count($_SESSION['aposentos']) + 1;
        $_SESSION['aposentos'][] = new Aposento(
            $proximoCodigo,
            280.00,
            "Bangalô Jardim",
            "Entrada privativa, varanda com rede e vista para o jardim.",
            91,
            true
        );
    }

    function listarAposentos() {
        foreach($_SESSION["aposentos"] as $aposento) {
            echo "<div class=\"aposento-card\">";
            echo "<span>#{$aposento->getCodigo()}</span>";
            echo "<span class=\"aposento-card_nome\">{$aposento->getNome()}</span>";
            echo "<span>{$aposento->getDescricao()}</span>";
            echo "<span>R\${$aposento->getValor()}</span>";
            echo "<span>Número: {$aposento->getNumero()}</span>";

            if($aposento->isVago())
                echo "<span class=\"aposento-card_disponivel\">Disponível</span>";
            else
                echo "<span class=\"aposento-card_ocupado\">Ocupado</span>";

            echo "</div>";
        }
    }

    function listarHospedes() {
        foreach($_SESSION["hospedes"] as $hospede) {
            echo "<div class=\"hospede-card\">";
            echo "<span>#{$hospede->getCodigo()}</span>";
            echo "<span class=\"hospede-card_nome\">{$hospede->getNome()}</span>";
            echo "<span>CPF: {$hospede->getCpf()}</span>";
            echo "<span>RG: {$hospede->getRg()}</span>";
            echo "<span>Telefone: {$hospede->getTelefone()}</span>";
            echo "</div>";
        }
    }

    function listarHospedagens() {
        foreach($_SESSION["hospedagens"] as $hospedagem) {
            echo "<div class=\"hospedagem-card\">";

            echo "<span class=\"hospedagem-card-nome\">Hospedagem #{$hospedagem->getCodigo()}</span>";
            echo "<span>{$hospedagem->getDataEntrada()->format("d/m/Y")} - {$hospedagem->getDataSaida()->format("d/m/Y")}</span>";
            echo "<span><strong>Hóspede:</strong> {$hospedagem->getHospede()->getNome()}</span>";
            echo "<span><strong>Aposento:</strong> {$hospedagem->getAposento()->getNome()}</span>";
            echo "<span><strong>Total a cobrar:</strong> R\${$hospedagem->getConta()->getTotalAPagar()}</span>";
            
            echo "<a href=\"pages/validar-consumos.php?hospCode={$hospedagem->getCodigo()}\" class=\"hospedagem-card-btn-consumos\">Validar consumos</a>";
            echo "<a href=\"pages/encerrar-hospedagem.php?hospCode={$hospedagem->getCodigo()}\" class=\"hospedagem-card-btn-encerrar\">Encerrar</a>";

            echo "</div>";
        }
    }

    function listarHospedagensEncerradas() {
        foreach($_SESSION["hospedagens-encerradas"] as $hospedagem) {
            echo "<div class=\"hospedagem_encerrada-card\">";
            
            echo "<span class=\"hospedagem_encerrada-card-nome\">Hospedagem #{$hospedagem->getCodigo()}</span>";
            echo "<span><strong>Período:</strong> {$hospedagem->getDataEntrada()->format("d/m/Y")} - {$hospedagem->getDataSaida()->format("d/m/Y")}</span>";
            echo "<span><strong>Hóspede:</strong> {$hospedagem->getHospede()->getNome()}</span>";
            echo "<span><strong>Aposento:</strong> {$hospedagem->getAposento()->getNome()}</span>";
            echo "<span><strong>Total cobrado:</strong> R\${$hospedagem->getConta()->getTotalAPagar()}</span>";

            echo "</div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gerenciamento - Refúgio das Estrelas</title>

    <style>
        .actions {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .acao-principal {
            text-decoration: none;
            background-color: #d4d4d4ff;
            color: #000000;
            padding: 10px;
        }

        .acao-principal:hover {
            background-color: #b9b9b9ff;
        }

        .aposentos-cards-container,
        .hospede-cards-container,
        .hospedagem-cards-container,
        .hospedagem_encerrada-cards-container {
            display: flex;
            flex-wrap: wrap;
            column-gap: 20px;
            row-gap: 30px;
        }

        .aposento-card,
        .hospede-card,
        .hospedagem-card,
        .hospedagem_encerrada-card {
            width: 200px;
            display: flex;
            flex-direction: column;
            gap: 5px;
            background-color: #d3d3d3ff;
            border: 1px solid #acacacff;
            padding: 10px 12px;
            border-radius: 5px;
        }

        .hospedagem_encerrada-card {
            background-color: #c3ceffff;
            border: 1px solid #9ea4ffff;
        }

        .aposento-card_nome,
        .hospede-card_nome,
        .hospedagem-card-nome,
        .hospedagem_encerrada-card-nome {
            font-weight: bold;
        }

        .aposento-card_disponivel, .aposento-card_ocupado {
            width: fit-content;
            font-weight: bold;
            padding: 6px 12px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .aposento-card_disponivel {
            background-color: #91ecadff;
            color: #0f5e26ff;
        }

        .aposento-card_ocupado {
            background-color: #ff9dadff;
            color: #5e0f20ff;
        }

        .hospedagem-card-btn-consumos,
        .hospedagem-card-btn-encerrar {
            width: fit-content;
            text-decoration: none;
            color: #000000;
            padding: 8px 12px;
            border-radius: 5px;
            margin-top: 5px;
        }

        .hospedagem-card-btn-consumos {
            background-color: #ffdea1ff;
        }

        .hospedagem-card-btn-consumos:hover {
            background-color: #ffd382ff;
        }

        .hospedagem-card-btn-encerrar {
            background-color: #ffb4c7ff;
        }

        .hospedagem-card-btn-encerrar:hover {
            background-color: #ff8ca9ff;
        }
    </style>
</head>
<body>
    <h1>Hotel Refúgio das Estrelas</h1>
    <p>Sistema de cadastro de hospedagens e gerenciamento</p>
    <hr>

    <h2>Ações</h2>
    <div class="actions">
        <a href="pages/cadastrar-hospede.html" class="acao-principal">Cadastrar hóspede</a>
        <a href="pages/cadastrar-hospedagem.php" class="acao-principal">Cadastrar hospedagem</a>
    </div>
    <hr>

    <h2>Lista de aposentos</h2>
    <div class="aposentos-cards-container">
        <?php
            if(!isset($_SESSION["aposentos"]) or empty($_SESSION["aposentos"])) {
                $_SESSION["aposentos"] = [];
                criarAposentos();
            }

            listarAposentos();
        ?>
    </div>
    <hr>

    <h2>Hóspedes cadastrados</h2>
    <div class="hospede-cards-container">
        <?php
            if(empty($_SESSION["hospedes"])) {
                echo "<p>Não há hóspedes cadastrados no sistema.</p>";
            }
            else {
                listarHospedes();
            }
        ?>
    </div>
    <hr>

    <h2>Hospedagens ativas</h2>
    <div class="hospedagem-cards-container">
        <?php
            if(empty($_SESSION["hospedagens"])) {
                echo "<p>Não há hospedagens ativas no momento.</p>";
            }
            else {
                listarHospedagens();
            }
        ?>
    </div>
    <hr>

    <h2>Hospedagens encerradas</h2>
    <div class="hospedagem_encerrada-cards-container">
        <?php
            if(empty($_SESSION["hospedagens-encerradas"])) {
                echo "<p>Não há hospedagens encerradas no sistema.</p>";
            }
            else {
                listarHospedagensEncerradas();
            }
        ?>
    </div>
</body>
</html>