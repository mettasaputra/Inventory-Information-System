<div class="row">
    <a class="nav-brand text-center" style="display:block; margin-left:auto;margin-right:auto;"><img style="width: 150px;" src="<?= base_url() . 'assets/images/logo.jpg' ?>"></a>
</div>
<nav class="navbar navbar-expand-sm navbar-light bg-success shadow shadow-sm sticky-top">
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon "></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
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

            <li class="nav-item">
                <div class="btn-group mt-1 text-right">
                    <a class="circle  text-white" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="my-auto fa fa-user-circle fa-2x text-white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="triggerId">
                        <p class="dropdown-item font-weigt-bold bg-dark text-white" href="#"> <?= $this->session->userdata('nama') ?></p>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt    "></i> Logout</a>
                    </div>
                </div>
            </li>
        </ul>

    </div>
</nav>