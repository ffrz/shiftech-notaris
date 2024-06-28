@php
  use App\Models\AclResource;

  if (!isset($menu_active)) {
      $menu_active = null;
  }
@endphp

<aside class="main-sidebar sidebar-light-primary elevation-4">
  <a class="brand-link" href="{{ url('admin/') }}">
    <img class="brand-image img-circle elevation-3" src="{{ url('dist/img/logo.png') }}" alt="App Logo" style="opacity: .8">
    <span class="brand-text font-weight-light">{{ App\Models\Setting::value('company.name', 'Notaris / PPAT') }}</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-flat nav-collapse-hide-child" data-widget="treeview" data-accordion="false" role="menu">
        <li class="nav-item">
          <a class="nav-link {{ $nav_active == 'dashboard' ? 'active' : '' }}" href="{{ url('admin/') }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        {{-- Expense Menu Begin --}}
        @if (Auth::user()->canAccess(AclResource::EXPENSE_MENU))
          <li class="nav-item {{ $menu_active == 'expense' ? 'menu-open' : '' }}">
            <a class="nav-link {{ $menu_active == 'expense' ? 'active' : '' }}" href="#">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                Pengeluaran
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link {{ $nav_active == 'expense' ? 'active' : '' }}" href="{{ url('/admin/expense') }}">
                  <i class="nav-icon fas fa-money-bills"></i>
                  <p>Pengeluaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ $nav_active == 'expense-category' ? 'active' : '' }}" href="{{ url('/admin/expense-category') }}">
                  <i class="nav-icon fas fa-boxes"></i>
                  <p>Kategori Pengeluaran</p>
                </a>
              </li>
            </ul>
          </li>
        @endif
        {{-- End of Expense Menu --}}

        {{-- Expense Menu Begin --}}
        @if (Auth::user()->canAccess(AclResource::FINANCE_MENU))
          <li class="nav-item {{ $menu_active == 'finance' ? 'menu-open' : '' }}">
            <a class="nav-link {{ $menu_active == 'finance' ? 'active' : '' }}" href="#">
              <i class="nav-icon fas fa-money-bill-transfer"></i>
              <p>
                Keuangan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link {{ $nav_active == 'cash-transaction' ? 'active' : '' }}" href="{{ url('/admin/cash-transaction') }}">
                  <i class="nav-icon fas fa-money-bill-transfer"></i>
                  <p>Transaksi</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ $nav_active == 'cash-transaction-category' ? 'active' : '' }}" href="{{ url('/admin/cash-transaction-category') }}">
                  <i class="nav-icon fas fa-boxes"></i>
                  <p>Kategori Transaksi</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ $nav_active == 'cash-account' ? 'active' : '' }}" href="{{ url('/admin/cash-account') }}">
                  <i class="nav-icon fas fa-money-check"></i>
                  <p>Akun / Rek</p>
                </a>
              </li>
            </ul>
          </li>
        @endif
        {{-- End of Expense Menu --}}

        {{-- Report Menu --}}
        @if (Auth::user()->canAccess(AclResource::REPORT_MENU))
          <li class="nav-item {{ $menu_active == 'report' ? 'menu-open' : '' }}">
            <a class="nav-link {{ $menu_active == 'report' ? 'active' : '' }}" href="/admin/report/">
              <i class="nav-icon fas fa-file-waveform"></i>
              <p>Laporan</p>
            </a>
          </li>
        @endif
        {{-- End Report Menu --}}

        {{-- System Menu --}}
        @if (Auth::user()->canAccess(AclResource::SYSTEM_MENU))
          <li class="nav-item {{ $menu_active == 'system' ? 'menu-open' : '' }}">
            <a class="nav-link {{ $menu_active == 'system' ? 'active' : '' }}" href="#">
              <i class="nav-icon fas fa-gears"></i>
              <p>
                Sistem
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if (Auth::user()->canAccess(AclResource::USER_ACTIVITY))
                <li class="nav-item">
                  <a class="nav-link {{ $nav_active == 'user-activity' ? 'active' : '' }}" href="{{ url('/admin/user-activity') }}">
                    <i class="nav-icon fas fa-file-waveform"></i>
                    <p>Log Aktifitas</p>
                  </a>
                </li>
              @endif
              @if (Auth::user()->canAccess(AclResource::SERVICE_MANAGEMENT))
                <li class="nav-item">
                  <a class="nav-link {{ $nav_active == 'service' ? 'active' : '' }}" href="{{ url('/admin/service') }}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>Layanan</p>
                  </a>
                </li>
              @endif
              @if (Auth::user()->canAccess(AclResource::WITNESS_MANAGEMENT))
                <li class="nav-item">
                  <a class="nav-link {{ $nav_active == 'witness' ? 'active' : '' }}" href="{{ url('/admin/witness') }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Saksi</p>
                  </a>
                </li>
              @endif
              @if (Auth::user()->canAccess(AclResource::OFFICER_MANAGEMENT))
                <li class="nav-item">
                  <a class="nav-link {{ $nav_active == 'officer' ? 'active' : '' }}" href="{{ url('/admin/officer') }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Karyawan</p>
                  </a>
                </li>
              @endif
              @if (Auth::user()->canAccess(AclResource::PARTNER_MANAGEMENT))
                <li class="nav-item">
                  <a class="nav-link {{ $nav_active == 'partner' ? 'active' : '' }}" href="{{ url('/admin/partner') }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Partner</p>
                  </a>
                </li>
              @endif
              @if (Auth::user()->canAccess(AclResource::USER_MANAGEMENT))
                <li class="nav-item">
                  <a class="nav-link {{ $nav_active == 'user' ? 'active' : '' }}" href="{{ url('/admin/user') }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Pengguna</p>
                  </a>
                </li>
              @endif
              @if (Auth::user()->canAccess(AclResource::SETTINGS))
                <li class="nav-item">
                  <a class="nav-link {{ $nav_active == 'settings' ? 'active' : '' }}" href="{{ url('/admin/settings') }}">
                    <i class="nav-icon fas fa-gear"></i>
                    <p>Pengaturan</p>
                  </a>
                </li>
              @endif
            </ul>
          </li>
        @endif
        {{-- End of System  menu --}}

        <li class="nav-item">
          <a class="nav-link {{ $nav_active == 'profile' ? 'active' : '' }}" href="{{ url('/admin/user/profile/') }}">
            <i class="nav-icon fas fa-user"></i>
            <p>{{ Auth::user()->username }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('admin/logout') }}">
            <i class="nav-icon fas fa-right-from-bracket"></i>
            <p>Keluar</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
