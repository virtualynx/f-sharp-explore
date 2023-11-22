<!-- Left Sidebar Menu -->
<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header pt-15">
            <span>Main Menus</span> 
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a class="{{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}"><div class="pull-left"><i class="zmdi zmdi-view-dashboard mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
        </li>
        {{-- <li>
            <a href="#"><div class="pull-left"><i class="zmdi zmdi-trending-up mr-20"></i><span class="right-nav-text">Monitoring</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="#"><div class="pull-left"><i class="zmdi zmdi-card-membership mr-20"></i><span class="right-nav-text">Status Lisensi</span></div><div class="clearfix"></div></a>
        </li> --}}
        <li><hr class="light-grey-hr mb-10"/></li>

        <li class="navigation-header">
            <span>E-KTP</span> 
            <i class="zmdi zmdi-more"></i>
        </li>
        {{-- <li>
            <a href="search_e_ktp.html"><div class="pull-left"><i class="zmdi zmdi-search-in-file mr-20"></i><span class="right-nav-text">Search E-KTP</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="blank.html"><div class="pull-left"><i class="zmdi zmdi-accounts-list mr-20"></i><span class="right-nav-text">Data E-KTP</span></div><div class="clearfix"></div></a>
        </li> --}}
        <li>
            <a class="{{ request()->is('e-ktp/*') ? 'active' : '' }}" href="javascript:void(0);" data-toggle="collapse" data-target="#ui_dr"><div class="pull-left"><i class="zmdi zmdi-accounts mr-20"></i><span class="right-nav-text">Search Dukcapil</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="ui_dr" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a href="{{ url('e-ktp/search-by-profile') }}">Search By Profile</a>
                </li>
                <li>
                    <a href="{{ url('e-ktp/search-by-nkk') }}">Search By NKK</a>
                </li> 
                <li>
                    <a href="{{ url('e-ktp/search-by-nik') }}">Search By NIK</a>
                </li>
            </ul>
        </li>
        {{-- <li>
            <a href="blank.html"><div class="pull-left"><i class="zmdi zmdi-time-restore mr-20"></i><span class="right-nav-text">History</span></div><div class="clearfix"></div></a>
        </li> --}}
        <li><hr class="light-grey-hr mb-10"/></li>

        <li class="navigation-header">
            <span>Telekomunikasi</span> 
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a class="{{ request()->is('telecommunication/locate-number') ? 'active' : '' }}" href="/telecommunication/locate-number"><div class="pull-left"><i class="zmdi zmdi-smartphone-info mr-20"></i><span class="right-nav-text">Locate Number</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a class="{{ request()->is('telecommunication/tracking-number') ? 'active' : '' }}" href="/telecommunication/tracking-number"><div class="pull-left"><i class="zmdi zmdi-phone-setting mr-20"></i><span class="right-nav-text">Tracking Number</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a class="{{ request()->is('telecommunication/telco_registration') ? 'active' : '' }}" href="/telecommunication/telco_registration"><div class="pull-left"><i class="zmdi zmdi-accounts-list-alt mr-20"></i><span class="right-nav-text">Telco Registration</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a class="{{ request()->is('telecommunication/tracking_imsi_imei') ? 'active' : '' }}" href="/telecommunication/tracking_imsi_imei"><div class="pull-left"><i class="zmdi zmdi-smartphone-setup mr-20"></i><span class="right-nav-text">IMEI / IMSI</span></div><div class="clearfix"></div></a>
        </li>
        {{--
        <li>
            <a href="blank.html"><div class="pull-left"><i class="zmdi zmdi-smartphone-info mr-20"></i><span class="right-nav-text">Device Tracking</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="blank.html"><div class="pull-left"><i class="zmdi zmdi-input-antenna mr-20"></i><span class="right-nav-text">CDR</span></div><div class="clearfix"></div></a>
        </li>
        
        <li>
            <a href="blank.html"><div class="pull-left"><i class="zmdi zmdi-phone-ring mr-20"></i><span class="right-nav-text">Multi Tracking Number</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="blank.html"><div class="pull-left"><i class="zmdi zmdi-accounts-list-alt mr-20"></i><span class="right-nav-text">Phonebook</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="blank.html"><div class="pull-left"><i class="zmdi zmdi-time-restore mr-20"></i><span class="right-nav-text">History</span></div><div class="clearfix"></div></a>
        </li> --}}
        <li><hr class="light-grey-hr mb-10"/></li>

        <li class="navigation-header">
            <span>Transportation</span> 
            <i class="zmdi zmdi-more"></i>
        </li>
        {{-- <li>
            <a href="blank.html"><div class="pull-left"><i class="zmdi zmdi-bike mr-20"></i><span class="right-nav-text">Gojek</span></div><div class="clearfix"></div></a>
        </li> --}}
        <li>
            <a class="{{ request()->is('transportasi/cek_kendaraan') ? 'active' : '' }}" href="/transportasi/cek_kendaraan"><div class="pull-left"><i class="zmdi zmdi-car mr-20"></i><span class="right-nav-text">Cek Kendaraan</span></div><div class="clearfix"></div></a>
        </li>
        {{-- <li>
            <a href="blank.html"><div class="pull-left"><i class="zmdi zmdi-time-restore mr-20"></i><span class="right-nav-text">History</span></div><div class="clearfix"></div></a>
        </li> --}}
        <li><hr class="light-grey-hr mb-10"/></li>

        {{-- <li class="navigation-header">
            <span>E-Commerce</span> 
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="blank.html"><div class="pull-left"><i class="zmdi zmdi-shopping-cart mr-20"></i><span class="right-nav-text">Tokopedia</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="blank.html"><div class="pull-left"><i class="zmdi zmdi-time-restore mr-20"></i><span class="right-nav-text">History</span></div><div class="clearfix"></div></a>
        </li>
        <li><hr class="light-grey-hr mb-10"/></li> --}}

        {{-- <li class="navigation-header">
            <span>Bank</span> 
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="blank.html"><div class="pull-left"><i class="zmdi zmdi-money-box mr-20"></i><span class="right-nav-text">Cek Rekening</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="blank.html"><div class="pull-left"><i class="zmdi zmdi-time-restore mr-20"></i><span class="right-nav-text">History</span></div><div class="clearfix"></div></a>
        </li>
        <li><hr class="light-grey-hr mb-10"/></li> --}}

        {{-- <li class="navigation-header">
            <span>Face Detection</span> 
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="blank.html"><div class="pull-left"><i class="zmdi zmdi-face mr-20"></i><span class="right-nav-text">Tracking Identification</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="blank.html"><div class="pull-left"><i class="zmdi zmdi-transform mr-20"></i><span class="right-nav-text">Photo Editor</span></div><div class="clearfix"></div></a>
        </li>
        <li>
            <a href="blank.html"><div class="pull-left"><i class="zmdi zmdi-time-restore mr-20"></i><span class="right-nav-text">History</span></div><div class="clearfix"></div></a>
        </li>
        <li><hr class="light-grey-hr mb-30"/></li> --}}

        <li class="navigation-header">
            <span>Data Leak</span> 
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a class="{{ request()->is('dataleak/data-leak') ? 'active' : '' }}" href="/dataleak/data-leak"><div class="pull-left"><i class="zmdi zmdi-folder-star-alt mr-20"></i><span class="right-nav-text">Leak</span></div><div class="clearfix"></div></a>
        </li> 
        <li>
            <a class="{{ request()->is('transportasi/data-gmail') ? 'active' : '' }}" href="/dataleak/data-gmail"><div class="pull-left"><i class="zmdi zmdi-email-open mr-20"></i><span class="right-nav-text">Gmail</span></div><div class="clearfix"></div></a>
        </li> 
        <li>
            <a class="{{ request()->is('transportasi/data-sosmed') ? 'active' : '' }}" href="/dataleak/data-sosmed"><div class="pull-left"><i class="zmdi zmdi-device-hub mr-20"></i><span class="right-nav-text">Media Social</span></div><div class="clearfix"></div></a>
        </li> 

        <li><hr class="light-grey-hr mb-10"/></li>

        <li class="navigation-header">
            <span>Tools</span> 
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="{{url('webtools/index.html')}}" target="_blank"><div class="pull-left"><i class="zmdi zmdi-globe mr-20"></i><span class="right-nav-text">Web Tools</span></div><div class="clearfix"></div></a>
        </li>
        <li><hr class="light-grey-hr mb-10"/></li>
    </ul>
</div>
<!-- /Left Sidebar Menu -->