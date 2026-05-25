<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividades Engenharia UFF - PET Tele</title>
    <style>
        /*cores do pet*/
        :root {
            --pet-azul-escuro: #1d527a;
            --pet-laranja: #f15a24;
            --pet-azul-claro: #3ea9f5;
        }

        /*estilos*/
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            
            /*tentativa de copia do gradiente*/
            background: linear-gradient(180deg, var(--pet-azul-claro) 0%, #fcdad0 50%, #ffebdefa 100%) fixed;
            
            margin: 0; 
            padding: 0; 
            color: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /*sumario (contraste forte azul)*/
        .sumario {
            background-color: rgba(29, 82, 122, 0.95);
            color: white;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 40px;
            border-bottom: 5px solid var(--pet-laranja);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }
        .sumario h1 { 
            margin-top: 0; 
            color: #fff;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }
        .sumario ul { font-size: 1.1em; line-height: 1.6; }

        /*titulos das categorias de cada bloco*/
        .categoria-titulo {
            font-size: 1.9em;
            color: var(--pet-azul-escuro);
            margin-top: 30px;
            margin-bottom: 10px;
            border-bottom: 2px solid rgba(29, 82, 122, 0.3);
            padding-bottom: 5px;
            text-shadow: 1px 1px 0px rgba(255,255,255,0.5);
        }

        /*scroller*/
        .carrossel {
            display: flex;
            overflow-x: auto; 
            gap: 20px; 
            padding-bottom: 20px; 
            padding-top: 10px;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        /*estilo da barra*/
        .carrossel::-webkit-scrollbar { height: 8px; }
        .carrossel::-webkit-scrollbar-track { background: rgba(255,255,255,0.4); border-radius: 4px; }
        .carrossel::-webkit-scrollbar-thumb { background: var(--pet-azul-escuro); border-radius: 4px; }

        /*estilo dos cards (itens)*/
        .card {
            background-color: rgba(255, 255, 255, 0.92);
            min-width: 300px; 
            max-width: 300px;
            border: 1px solid rgba(255,255,255,0.5);
            border-radius: 14px;
            padding: 24px;
            text-decoration: none; 
            color: inherit; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s, background-color 0.2s; 
            border-top: 5px solid var(--pet-azul-escuro);
        }

        /*hover do mouse*/
        .card:hover {
            transform: translateY(-8px); 
            background-color: #ffffff; /* Fica 100% branco ao passar o mouse */
            box-shadow: 0 12px 24px rgba(29, 82, 122, 0.25); 
            border-top-color: var(--pet-laranja); 
        }

        /*card SEM SITE*/
        .card.sem-link:hover {
            transform: none;
            background-color: rgba(255, 255, 255, 0.92);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border-top-color: var(--pet-azul-escuro);
            cursor: default;
        }

        .card h3 { 
            margin-top: 0; 
            color: var(--pet-azul-escuro); 
            font-size: 1.4em;
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
        }
        .card p { margin: 10px 0; font-size: 0.95em; line-height: 1.4; }
        .card strong { color: var(--pet-laranja); } 
    </style>
</head>
<body>

<div class="container">

    <div class="sumario">
        <h1>Catálogo de Atividades - Engenharia UFF</h1>
        <p>Bem-vindo! Esta página tem como objetivo mapear e divulgar os diversos grupos e projetos de extensão que atuam na Escola de Engenharia da Universidade Federal Fluminense. Aqui encontrará informações sobre:</p>
        <ul>
            <li>Empresas Juniores</li>
            <li>Coletivos e Associações</li>
            <li>Equipes de Competição (Projetos)</li>
            <li>Órgãos Representativos</li>
        </ul>
        <p><em>Deslize os blocos abaixo para o lado para explorar os grupos e clique num cartão para aceder ao site oficial.</em></p>
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