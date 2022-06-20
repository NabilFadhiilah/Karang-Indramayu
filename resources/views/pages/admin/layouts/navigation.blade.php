<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-center">
                <div class="logo">
                    <a href="{{ route('admin.') }}"><img src="{{ url('/Frontend/Asset/Images/Logo-Gokarang.png') }}"
                            style="height: 50px;" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ request()->is('admin') ? 'active' : '' }} ">
                    <a href="{{ route('admin.') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li
                    class="sidebar-item has-sub {{ (request()->is('admin/paket*') ? 'active' : request()->is('admin/wisata*')) ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-life-preserver"></i>
                        <span>Kelola Wisata</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ request()->is('admin/paket*') ? 'active' : '' }}">
                            <a href="{{ route('admin.paket.index') }}">Paket Wisata</a>
                        </li>
                        <li class="submenu-item {{ request()->is('admin/wisata*') ? 'active' : '' }}">
                            <a href="{{ route('admin.wisata.index') }}">Wisata</a>
                        </li>
                        <li class="submenu-item {{ request()->is('admin/gallery*') ? 'active' : '' }}">
                            <a href="{{ route('admin.gallery.index') }}">Gallery</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('admin.verifikasi-wisata.index') }}">Verifikasi Wisata</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('admin.verifikasi-paket.index') }}">Verifikasi Paket Wisata</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub {{ request()->is('admin/pengembanganWisata') ? 'active' : '' }}  ">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-puzzle"></i>
                        <span>Kelola Pengembangan</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ request()->is('admin/pengembanganWisata*') ? 'active' : '' }}">
                            <a href="{{ route('admin.pengembanganWisata.index') }}">Pengembangan</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('admin.verifikasi-pengembangan.index') }}">Verifikasi Pengembangan</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Kelola Laporan</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="layout-default.html">Laporan Paket Wisata</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="layout-vertical-1-column.html">Laporan Wisata</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="layout-vertical-navbar.html">Laporan Pengembangan</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{ request()->is('admin/rekening*') ? 'active' : '' }}">
                    <a href="{{ route('admin.rekening.index') }}" class='sidebar-link'>
                        <i class="bi bi-cash"></i>
                        <span>Kelola Rekening</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger col-12">Logout</button>
                    </form>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
