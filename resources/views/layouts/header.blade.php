<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="#" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/logo_sekolah.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/logo_sekolah.png') }}" alt="" height="75">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-backburger"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (Auth::user()->foto)
                        <img class="rounded-circle header-profile-user"
                            src="{{ asset('files/foto/' . Auth::user()->foto) }}" alt="Header Avatar">
                    @else
                        <img class="rounded-circle header-profile-user"
                            src="{{ URL::asset('assets/images/users/avatar-1.jpg') }}" alt="Header Avatar">
                    @endif
                    <span class="d-none d-sm-inline-block ml-1">{{ ucwords(strtolower(Auth::user()->name)) }}</span>
                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <?php $id = Crypt::encryptString(Auth::user()->id); ?>
                    <a class="dropdown-item" href="{{ route('admin.user_profile', ['id' => $id]) }}"><i
                            class="mdi mdi-face-profile font-size-16 align-middle mr-1"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <form class="logout" action="{{ route('login.logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item"><i class="mdi mdi-logout font-size-16 align-middle mr-1"></i>
                            Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</header>
<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/alert.js') }}"></script>
<script>
    $('.logout').on('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Keluar Aplikasi',
            text: 'Ingin keluar aplikasi?',
            icon: 'question',
            showCloseButton: true,
            showCancelButton: true,
            cancelButtonText: "Batal",
            focusConfirm: false,
        }).then((value) => {
            if (value.isConfirmed) {
                $(this).closest("form").submit()
            }
        });
    });
</script>
