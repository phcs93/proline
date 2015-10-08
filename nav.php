<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://<?= $_SERVER['HTTP_HOST']; ?>">
                <img src="/src/img/brand.png" alt="PROLINE" />&nbsp;
                Proline
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">

                <li class=""><a href="?p=pedidos&d=<?= date('Y-m-d', time()); ?>">Pedidos</a></li>

                <li class=""><a href="?p=caixa&d=<?= date('Y-m-d', time()); ?>&t=date">Caixa</a></li>
                <li class=""><a href="?p=estoque">Estoque</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Produtos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="?p=produtos"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Todos os produtos</a></li>
                        <li><a href="?p=tipos"><span class="glyphicon glyphicon-tag"></span>&nbsp;Tipos</a></li>
                        <li><a href="?p=materiais"><span class="glyphicon glyphicon-tag"></span>&nbsp;Materiais</a></li>
                        <li><a href="?p=quimicas"><span class="glyphicon glyphicon-tag"></span>&nbsp;Quimicas</a></li>
                        <li><a href="?p=medidas"><span class="glyphicon glyphicon-tag"></span>&nbsp;Medidas</a></li>
                    </ul>
                </li>
                
                <li class=""><a href="?p=pessoas">Pessoas</a></li>
                <li class=""><a href="?p=usuarios">Usuários</a></li>
                <li class=""><a href="?p=sair">Sair</a></li>
            
            </ul>
        </div>

    </div>
</nav>