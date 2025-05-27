@extends('layouts.app')

@section('sidebar')
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item">
            <a href="{{ route('peserta.dashboard') }}" class="nav-link {{ request()->routeIs('peserta.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('peserta.beasiswa.index') }}" class="nav-link {{ request()->routeIs('peserta.beasiswa.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-search"></i>
                <p>Cari Beasiswa</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('peserta.pendaftaran.index') }}" class="nav-link {{ request()->routeIs('peserta.pendaftaran.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>Pendaftaran Saya</p>
            </a>
        </li>
    </ul>
@endsection