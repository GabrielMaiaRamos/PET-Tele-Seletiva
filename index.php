<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividades Engenharia UFF - PET Tele</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <div class="sumario">
        <h1>Catálogo de Atividades - Engenharia UFF</h1>
        <p>Esta página tem como objetivo mapear os diversos grupos e projetos de extensão que atuam na Escola de Engenharia da Universidade Federal Fluminense. Aqui encontrará informações sobre:</p>
        <ul>
            <li>Associações e Coletivos</li>
            <li>Empresas Juniores</li>
            <li>Organizações</li>
            <li>Órgãos Representativos</li>
            <li>Projetos</li>
        </ul>
        <p><em>Clique num cartão para direcionar ao site oficial.</em></p>
    </div>

    <?php
    $categorias = [
        "Associações"            => "dados/associacoes.json",
        "Coletivos"              => "dados/coletivos.json",
        "Empresas Juniores"      => "dados/empresas_juniores.json",
        "Organizações"           => "dados/organizacoes.json",
        "Órgãos Representativos" => "dados/orgaos_representativos.json",
        "Projetos"               => "dados/projetos.json"
    ];
    foreach ($categorias as $titulo_bloco => $caminho_arquivo) {
        
        if (file_exists($caminho_arquivo)) {
            
            echo "<h2 class='categoria-titulo'>" . $titulo_bloco . "</h2>";
            echo "<div class='carrossel'>";
            
            $json_puro = file_get_contents($caminho_arquivo);
            $grupos = json_decode($json_puro, true);

            if($grupos != null){
                foreach ($grupos as $grupo) {
                    
                    $site = isset($grupo['website']) ? trim($grupo['website']) : '';
                    
                    if (!empty($site) && $site != "Não informado" && $site != "Não possui" && $site != "-") {
                        if (strpos($site, 'http://') !== 0 && strpos($site, 'https://') !== 0) {
                            $link_destino = "https://" . $site;
                        } else {
                            $link_destino = $site;
                        }
                        $classe_css = "card";
                        $target = "target='_blank'";
                    } else {
                        $link_destino = "#";
                        $classe_css = "card sem-link";
                        $target = "";
                    }
                    
                    echo "<a href='" . $link_destino . "' " . $target . " class='" . $classe_css . "'>";
                    
                    echo "<h3>" . $grupo['nome'] . "</h3>";
                    echo "<p><strong>Morada:</strong> " . $grupo['endereco'] . "</p>";
                    echo "<p><strong>Telefone:</strong> " . $grupo['telefone'] . "</p>";
                    echo "<p><strong>E-mail:</strong> " . $grupo['email'] . "</p>";
                    echo "<p><strong>Facebook:</strong> " . $grupo['facebook'] . "</p>";
                    
                    echo "</a>"; 
                }
            } else {
                echo "<p>Nenhum dado encontrado neste ficheiro.</p>";
            }
            
            echo "</div>";
        }
    }
    ?>

</div>

</body>
</html>