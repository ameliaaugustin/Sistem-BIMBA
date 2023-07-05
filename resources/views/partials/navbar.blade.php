<nav class="side-navbar">
    <div class="side-navbar-inner">
        <!-- Sidebar Header    -->
        <div class="sidebar-header d-flex align-items-center justify-content-center p-3 mb-3">
            <!-- User Info-->
            <div class="sidenav-header-inner text-center"><img class="img-fluid rounded-circle avatar mb-3"
                    src="{{ asset('assets') }}/img/logobimba.png" alt="person">
                <h2 class="h5 text-white text-uppercase mb-0">Wellcome {{ auth()->user()->fullname }}</h2>
                <p class="text-sm mb-0 text-muted">Web Pendaftaran Bimba</p>
            </div>
            <!-- Small Brand information, appears on minimized sidebar--><a class="brand-small text-center"
                href="{{ url('/') }}">
                <p class="h6 m-0">BIMBA RAINBOW KIDS</p>
            </a>
        </div>
        <!-- Sidebar Navigation Menus-->
        @if (auth()->user()->user_role_id != 3)
            <span class="text-uppercase text-gray-500 text-sm fw-bold letter-spacing-0 mx-lg-2 heading">Admin</span>
            <ul class="list-unstyled">
                <li class="sidebar-item"><a class="sidebar-link" href="{{ url('/') }}">
                        <svg class="svg-icon svg-icon-sm svg-icon-heavy me-2">
                            <use xlink:href="#real-estate-1"> </use>
                        </svg>Home </a></li>

                <li class="sidebar-item"><a class="sidebar-link" href="#exampledropdownDropdown"
                        data-bs-toggle="collapse">
                        <svg class="svg-icon svg-icon-sm svg-icon-heavy me-2">
                            <use xlink:href="#browser-window-1"> </use>
                        </svg>Master Data</a>
                    <ul class="collapse list-unstyled " id="exampledropdownDropdown">

                        @if (auth()->user()->user_role_id == 1)
                            <li><a class="sidebar-link" href="{{ route('master_role') }}">Master Role</a></li>
                        @endif

                        <li><a class="sidebar-link" href="{{ route('m_agama') }}">Master Agama</a></li>
                        <li><a class="sidebar-link" href="{{ route('m_dokumen') }}">Master Dokumen</a></li>
                        <li><a class="sidebar-link" href="{{ route('m_pekerjaan') }}">Master Pekerjaan</a></li>
                        <li><a class="sidebar-link" href="{{ route('m_jam') }}">Master Jam Pelajaran</a></li>
                        <li><a class="sidebar-link" href="{{ route('m_paket') }}">Master Paket</a></li>
                        <li><a class="sidebar-link" href="{{ route('m_item') }}">Master Item Bayar</a></li>
                    </ul>
                </li>
                @if (auth()->user()->user_role_id == 1)
                    <li class="sidebar-item"><a class="sidebar-link" href="{{ route('manajemen_user') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                class="bi bi-file-earmark-text me-2" viewBox="0 0 18 18">
                                <path
                                    d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                                <path
                                    d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                            </svg>Manajemen User</a>
                    </li>
                @endif
                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('data_pendaftar') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                            class="bi bi-file-earmark-text me-2" viewBox="0 0 18 18">
                            <path
                                d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                            <path
                                d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                        </svg>Data Pendaftar</a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('data_jadwal_buktibayar') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                            class="bi bi-file-earmark-text me-2" viewBox="0 0 18 18">
                            <path
                                d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                            <path
                                d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                        </svg>Data Jadwal Bukti Bayar</a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('data_affiliasi') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                            class="bi bi-file-earmark-text me-2" viewBox="0 0 18 18">
                            <path
                                d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                            <path
                                d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                        </svg>Data Affilasi</a>
                </li>

            </ul>
        @else
            {{-- </ul> --}}
            <span class="text-uppercase text-gray-500 text-sm fw-bold letter-spacing-0 mx-lg-2 heading">Pendaftar</span>
            <ul class="list-unstyled py-4">
                <li class="sidebar-item"><a class="sidebar-link" href="{{ url('/') }}">
                        <svg class="svg-icon svg-icon-sm svg-icon-heavy me-2">
                            <use xlink:href="#real-estate-1"> </use>
                        </svg>Home </a></li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('form_pendaftaran') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                            class="bi bi-file-earmark-text me-2" viewBox="0 0 18 18">
                            <path
                                d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                            <path
                                d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                        </svg>Formulir Pendaftaran</a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('form_dokumen') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-file-earmark-plus me-2" viewBox="0 0 16 16">
                            <path
                                d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z" />
                            <path
                                d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z" />
                        </svg> Form Dokumen</a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('form_pilih_jadwal') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-calendar-check me-2" viewBox="0 0 16 16">
                            <path
                                d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                        </svg>Pemilihan Jadwal KBM dan Pembayaran

                    </a>
                </li>

            </ul>
        @endif

    </div>
</nav>
