<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">POS Toko</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block"><center><h2>{{ auth()->user()->role }}</h2></center></a>
            </div>
        </div>

        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('category') || Request::is('stock-unit') ? 'active' : null }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-database"></i>
                        <p>
                            Produk
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('stock-unit') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Satuan Stok</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('category') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori Produk</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('product') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Produk</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('cashier') }}" class="nav-link">
                        <i class="fas fa-shopping-cart"></i>
                        <p>
                            Kasir
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('user') }}" class="nav-link">
                        <i class="fas fa-user"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-clipboard"></i>
                        <p>
                            Penjualan
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-alt"></i>
                        <p>
                            Laporan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kasir</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Terlaris</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Berkala</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
