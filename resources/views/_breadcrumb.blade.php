@php
    $breadcrumbs_parents = [
        'Telekomunikasi' => [
            'Locate Number',
            'Tracking Number'.
            'Telco Registration'
        ],
        'Search Dukcapil' => [
            'Search By NKK',
            'Search By NIK'
        ], 
        'Transportation' => [
            'Cek Kendaraan'
        ]
    ];

    $breadcrumbs_links = [
        'Search Number' => 'telecommunication/search-number',
        'Locate Number' => 'telecommunication/tracking-number',
        'Telco Registration' => 'telecommunication/telco_registration',
        'Search By NKK' => 'e-ktp/search-by-nkk',
        'Search By NIK' => 'e-ktp/search-by-nik',
        'Cek Kendaraan' => 'transportasi/cek_kendaraan'
    ];

    $page_title = app()->view->getSections()['page-title'];
    $page_title = trim($page_title);
    // $parent = !empty($breadcrumbs_parents[$page_title])? $breadcrumbs_parents[$page_title]: null;
    $parent = null;

    foreach ($breadcrumbs_parents as $parent_value => $arr) {
        foreach ($arr as $title) {
            if($title === $page_title){
                $parent = $parent_value;
                break;
            }
        }
        if($parent !== null)break;
    }

    $link = !empty($breadcrumbs_links[$page_title])? url($breadcrumbs_links[$page_title]): '#';
@endphp

<!-- Breadcrumb -->
@if ($parent !== null) 
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li>{{ $parent }}</li>
            <li><a href="{{ $link }}"><span>{{ $page_title }}</span></a></li>
        </ol>
    </div>
@endif
<!-- /Breadcrumb -->