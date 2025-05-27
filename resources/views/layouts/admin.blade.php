@extends('layouts.app')

@section('sidebar')
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        
        <li class="nav-item {{ request()->routeIs('admin.beasiswa.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('admin.beasiswa.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-graduation-cap"></i>
                <p>
                    Kelola Beasiswa
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.beasiswa.index') }}" class="nav-link {{ request()->routeIs('admin.beasiswa.index') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Daftar Beasiswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.beasiswa.create') }}" class="nav-link {{ request()->routeIs('admin.beasiswa.create') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tambah Beasiswa</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.pendaftaran.index') }}" class="nav-link {{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>Kelola Pendaftaran</p>
            </a>
        </li>
    </ul>
@endsection