<style>
    /* Header */
    .header {
        background-color: #ffffff;
        border-bottom: 1px solid #e9ecef;
    }

    .user-area .dropdown-toggle {
        transition: all 0.3s ease;
    }

    .user-area .dropdown-toggle:hover {
        opacity: 0.8;
    }

    .user-menu .dropdown-item {
        padding: 0.5rem 1rem;
        transition: background-color 0.3s ease;
    }

    .user-menu .dropdown-item:hover {
        background-color: #f8f9fa;
    }

    /* Modal */
    .modal-content {
        border-radius: 10px;
    }

    .modal-header {
        border-bottom: 1px solid #e9ecef;
        border-radius: 10px 10px 0 0;
    }

    .modal-footer {
        border-top: 1px solid #e9ecef;
        border-radius: 0 0 10px 10px;
    }
</style>

<header id="header" class="header shadow-sm">
    <div class="header-menu d-flex justify-content-between align-items-center p-3">
        <!-- Menu Toggle -->
        <div class="col-sm-7">
            <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
        </div>

        <!-- User Area -->
        <div>
            <div class="user-area dropdown">
                <a href="#" class="dropdown-toggle d-flex align-items-center text-decoration-none" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-info text-right mr-2">
                        <p class="mb-0 font-weight-bold">{{ auth()->user()->nama }}</p>
                        <small class="text-muted">{{ auth()->user()->role }}</small>
                    </div>
                    <i class="fa fa-user-circle fa-2x text-primary"></i>
                </a>
                <div class="user-menu dropdown-menu dropdown-menu-right shadow border-0">
                    <a class="dropdown-item d-flex align-items-center" href="{{ url('/profil/'.auth()->user()->id_user) }}">
                        <i class="fa fa-user mr-2"></i> My Profile
                    </a>
                    <a class="dropdown-item d-flex align-items-center" data-toggle="modal" data-target="#staticModal" href="#">
                        <i class="fa fa-power-off mr-2"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Modal Logout -->
<div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title font-weight-bold" id="staticModalLabel">Konfirmasi Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Apakah Anda yakin ingin keluar dari aplikasi ini?</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
