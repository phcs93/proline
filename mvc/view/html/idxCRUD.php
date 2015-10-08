<div class='row'>
    <?php if ($_GET['p'] == "pedidos"): ?>
        <div class='col-xs-12 col-md-4'>
            <input id="data" type="date" class="form-control" value="<?= isset($_GET['d']) ? $_GET['d'] : '' ?>" />
        </div>
        <div class='col-xs-12 col-md-6 col-md-offset-2'>
            <div class="has-feedback">
                <input id="busca" type="search" class="form-control" placeholder="digite algo para pesquisar..." />
                <span class="glyphicon glyphicon-search form-control-feedback search-icon"></span>
            </div>
        </div>
    <?php else: ?>
        <div class='col-xs-12 col-md-6 col-md-offset-6'>
            <div class="has-feedback">
                <input id="busca" type="search" class="form-control" placeholder="digite algo para pesquisar..." />
                <span class="glyphicon glyphicon-search form-control-feedback search-icon"></span>
            </div>
        </div>
    <?php endif; ?>
</div>

<br />

<div class='row'>
    <div class='col-xs-12'>
        <button id="btnNovo" class="btn btn-primary pull-right">
            <span class="glyphicon glyphicon-file"></span>&nbsp;Novo
        </button>
    </div>
</div>

<br />