<nav class="navbar navbar-expand-sm navbar-light shadow shadow-sm sticky-top p-2" style="background-color: #000066;">
    <button class="navbar-toggler bg-white d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon "></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link text-white mx-2" href="<?= base_url() . 'dashboard' ?>"><i class="fas fa-utensils    "></i> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url() . 'dashboard' ?>">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url() . 'master' ?>">Data Master</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url() . 'penerimaan' ?>">Penerimaan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url() . 'pengeluaran' ?>">Pengeluaran</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url() . 'permintaan' ?>">Permintaan</a>
            </li>
        </ul>

    </div>
    <div class='navbar-collapse collapse  order-3 dual-collapse2' id="collapsibleNavId">
        <ul class='navbar-nav ml-auto'>
            <div class="dropdown open ">
                <a class="dropdown-left" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user-circle text-white" style="font-size: 14pt !important;">
                    </i>
                    <span class="text-uppercase text-white font-weight-bold">
                        <?= $this->session->userdata('nama') ?>

                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-left w-50" aria-labelledby="triggerId">
                    <a class='nav-link' href="<?= Base_url() . 'administrator/logout' ?>">Logout</a>
                    <div class="dropdown-divider"></div>
                </div>
            </div>
        </ul>
    </div>

</nav>