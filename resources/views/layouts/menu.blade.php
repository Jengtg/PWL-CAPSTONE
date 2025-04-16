<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ 
      Auth::user()->role->name === 'Master Admin' ? route('admin.dashboard') : 
      (Auth::user()->role->name === 'Tata Usaha' ? route('tataUsaha.dashboard') : 
      (Auth::user()->role->name === 'Kepala Prodi' ? route('kaprodi.dashboard') : 
      (Auth::user()->role->name === 'Mahasiswa' ? route('mahasiswa.dashboard') : '#')))
    }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <svg
        width="25"
        viewBox="0 0 25 42"
        version="1.1"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
      >
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2">Capstone</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  @php
    $role = Auth::user()->role->name;
    $dashboardRoute = match($role) {
      'Master Admin' => route('admin.dashboard'),
      'Tata Usaha' => route('tataUsaha.dashboard'),
      'Kepala Prodi' => route('kaprodi.dashboard'),
      'Mahasiswa' => route('mahasiswa.dashboard'),
      default => '#'
    };
  @endphp

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ Request::url() === $dashboardRoute ? 'active' : '' }}">
      <a href="{{ $dashboardRoute }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>

    {{-- Master Admin --}}
    @if ($role == 'Master Admin')
      <li class="menu-item {{ Request::routeIs('users.index') ? 'active' : '' }}">
        <a href="{{ route('users.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-collection"></i>
          <div data-i18n="Basic">User</div>
        </a>
      </li>

      <li class="menu-item {{ Request::routeIs('program-studi.index') ? 'active' : '' }}">
        <a href="{{ route('program-studi.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-collection"></i>
          <div data-i18n="Basic">Menambah Prodi</div>
        </a>
      </li>
    @endif

    {{-- Mahasiswa --}}
    @if ($role == 'Mahasiswa')
      <li class="menu-item {{ Request::routeIs('surat.create') ? 'active' : '' }}">
          <a href="{{ route('surat.create') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-collection"></i>
            <div data-i18n="Basic">Pengajuan Surat</div>
          </a>
      </li>


      <li class="menu-item {{ Request::routeIs('statuses.index') ? 'active' : '' }}">
        <a href="{{ route('statuses.index') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-collection"></i>
          <div data-i18n="Basic">Status Pengajuan</div>
        </a>
      </li>
    @endif

    {{-- Kepala Prodi --}}
    @if ($role == 'Kepala Prodi')
      <li class="menu-item {{ Request::is('surat-diajukan') ? 'active' : '' }}">
        <a href="{{ url('surat-diajukan') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-collection"></i>
          <div data-i18n="Basic">Surat Diajukan</div>
        </a>
      </li>
    @endif

    {{-- Tata Usaha --}}
    @if ($role == 'Tata Usaha')
        <li class="menu-item {{ Request::is('tu/surat') ? 'active' : '' }}">
            <a href="{{ route('tu.surat.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Daftar Surat Disetujui</div>
            </a>
        </li>
    @endif


  </ul>
</aside>