<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-color sidebar-dark-primary elevation-4" style="background-color:#cf0404 !important">
    <!-- Brand Logo -->
    <a class="brand-link">
      <img src="{{ asset ('dist/img/mainlogo-2022.png') }}" class="w-5" alt="Telkomsel Logo" style="width: 210px; justify-content: center ">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset ('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> --}}

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline mt-3">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{url('/')}}" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
          <li class="nav-header">DATA MASTER</li>    
          <li class="nav-item">
            <a href="{{url('/cluster')}}" class="nav-link">
              <i class="nav-icon fas fa-circle-nodes"></i>
              <p>
                Cluster
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/cluster')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Cluster</p>
                </a>
              </li>
            </ul> --}}
          </li>  
          <li class="nav-item">
            <a href="{{url('/kota')}}" class="nav-link">
              <i class="nav-icon fas fa-city"></i>
              <p>
                Kota
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/kota')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kota</p>
                </a>
              </li>
            </ul> --}}
          </li>
          <li class="nav-item">
            <a href="{{url('/kecamatan')}}" class="nav-link">
              <i class="nav-icon fas fa-building-columns"></i>
              <p>
                Kecamatan
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/kecamatan')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kecamatan</p>
                </a>
              </li>
            </ul> --}}
          </li>
          {{-- <li class="nav-item">
            <a href="{{url('/dls')}}" class="nav-link">
              <i class="nav-icon fas fa-money-bill-1-wave"></i>
              <p>
                Dls
                {{-- <i class="right fas fa-angle-left"></i> --}}
              {{-- </p>
            </a> --}}
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/dls')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Dls</p>
                </a>
              </li>
            </ul> --}}
          {{-- </li>}} --}}
          <li class="nav-item">
            <a href="{{url('/product')}}" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Product
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/product')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Product</p>
                </a>
              </li>
            </ul> --}}
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bullseye"></i>
              <p>
                Revenue
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/revenue/form_tahun')}}" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Revenue Kecamatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/revenue/form_tahun_dls')}}" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Revenue DLS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/revenue/import')}}" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Import Rev Kecamatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/revenue/import/dls')}}" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Import Rev DLS</p>
                </a>
              </li>
            </ul>
          </li> 
          <li class="nav-header">SETTING</li> 
          <li class="nav-item">
            <a href="{{url('/user')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
               User
              </p>
            </a>
          </li>
        </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
