@extends('back.layout.template')

@section('title', 'Dashboard Perusahaan - Nexus Craft')

@section('content')
{{-- contentt --}}
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="fa-solid fa-shop-lock"></i> Dashboard</h1>
    </div>

    <div class="row g-3 mb-4">
        <!-- Total Article Card (Info/Blue Gradient) -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-white" style="background: linear-gradient(135deg, #0dcaf0 0%, #035b71 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-uppercase fs-7 fw-semibold text-white-50 tracking-wide">Total Articles</span>
                            <h2 class="fw-bold mb-1 mt-2 text-white">{{ $total_articles }}</h2>
                            <span class="text-white-50 fs-7">Published Posts</span>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3 d-flex align-items-center justify-content-center backdrop-blur" style="width: 55px; height: 55px;">
                            <i class="fa-solid fa-newspaper fs-4 text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-black bg-opacity-10 border-0 px-4 py-2 rounded-bottom-4">
                    <a href="{{ url('article') }}" class="text-white text-decoration-none fw-semibold fs-7 d-flex align-items-center justify-content-between">
                        <span>View Details</span> <i class="fa-solid fa-arrow-right fs-8"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Service Card (Warning/Yellow-Orange Gradient) -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-white" style="background: linear-gradient(135deg, #ffc107 0%, #b37d00 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-uppercase fs-7 fw-semibold text-white-50 tracking-wide">Total Services</span>
                            <h2 class="fw-bold mb-1 mt-2 text-white">{{ $total_services }}</h2>
                            <span class="text-white-50 fs-7">Active Services</span>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3 d-flex align-items-center justify-content-center backdrop-blur" style="width: 55px; height: 55px;">
                            <i class="fa-solid fa-briefcase fs-4 text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-black bg-opacity-10 border-0 px-4 py-2 rounded-bottom-4">
                    <a href="{{ url('service') }}" class="text-white text-decoration-none fw-semibold fs-7 d-flex align-items-center justify-content-between">
                        <span>View Details</span> <i class="fa-solid fa-arrow-right fs-8"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Portofolio Card (Success/Green Gradient) -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-white" style="background: linear-gradient(135deg, #198754 0%, #0a3622 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-uppercase fs-7 fw-semibold text-white-50 tracking-wide">Total Portofolios</span>
                            <h2 class="fw-bold mb-1 mt-2 text-white">{{ $total_portofolios }}</h2>
                            <span class="text-white-50 fs-7">Completed Projects</span>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3 d-flex align-items-center justify-content-center backdrop-blur" style="width: 55px; height: 55px;">
                            <i class="fa-solid fa-layer-group fs-4 text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-black bg-opacity-10 border-0 px-4 py-2 rounded-bottom-4">
                    <a href="{{ url('portofolio') }}" class="text-white text-decoration-none fw-semibold fs-7 d-flex align-items-center justify-content-between">
                        <span>View Details</span> <i class="fa-solid fa-arrow-right fs-8"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Consultation Card (Danger/Red-Pink Gradient) -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-white" style="background: linear-gradient(135deg, #dc3545 0%, #58151c 100%);">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-uppercase fs-7 fw-semibold text-white-50 tracking-wide">Total Consultations</span>
                            <h2 class="fw-bold mb-1 mt-2 text-white">{{ $total_consultations }}</h2>
                            <span class="text-white-50 fs-7">Client Requests</span>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3 d-flex align-items-center justify-content-center backdrop-blur" style="width: 55px; height: 55px;">
                            <i class="fa-solid fa-comments fs-4 text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-black bg-opacity-10 border-0 px-4 py-2 rounded-bottom-4">
                    <a href="{{ url('consultation') }}" class="text-white text-decoration-none fw-semibold fs-7 d-flex align-items-center justify-content-between">
                        <span>View Details</span> <i class="fa-solid fa-arrow-right fs-8"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <h4>Latest Articles</h4>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Create At</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($latest_article as $item)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $item->title}}</td>
                            <td>{{ $item->Category->name }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td class="text-center">
                                <a href="{{ url('article/'. $item->id)}}" class="btn btn-sm btn-secondary">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-6">
            <h4>Latest Consultations</h4>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Service</th>
                        <th>Create At</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($latest_consultation as $item)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->service->nama_service }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td class="text-center">
                                <a href="{{ url('service/'. $item->id)}}" class="btn btn-sm btn-secondary">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</main>
@endsection
