@extends('back.layout.template')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.min.css">
@endpush

@section('title', 'Consultation Perusahaan - Nexus Craft')

@section('content')
{{-- content --}}
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fa-regular fa-file-lines"></i> Consultation</h1>
    </div>

    <div class="mt-3">
    <!-- Container Flexbox untuk tombol bersampingan -->
    <div class="d-flex align-items-center gap-2 mb-3">
        <a href="{{ url('consultation/create')}}" class="btn btn-success">
            <i class="fa-solid fa-plus me-1"></i> Create
        </a>

        <!-- Tombol Modal Export -->
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exportModal">
            <i class="fa-solid fa-file-excel me-1"></i> Download Recap Excel
        </button>
    </div>

            <!-- Modal Filter Bulan -->
    <!-- Modal Filter Tanggal (Start Date - End Date) -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('consultation.export-excel') }}" method="GET">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">
                        <i class="fa-solid fa-file-excel text-success me-2"></i>Download Recap Consultation
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ date('Y-m-01') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-download me-1"></i> Download
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

        @if ($errors->any())
        <div class="my-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <div class="swal" data-swal="{{ session('success')}}"></div>

        <table class="table table-striped table-bordered" id="dataTable">
           <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Function</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($consultations as $item)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $item->name}}</td>
                    <td>{{ $item->email}}</td>
                    <td class="text-center">{{ $item->phone}}</td>
                    <td class="text-center">
                        <span class="badge bg-info text-dark">
                            {{ $item->service->nama_service}}
                        </span>
                    </td>
                    <td class="text-center">
                        @if ($item->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif ($item->status == 'processed')
                            <span class="badge bg-primary">Processed</span>
                        @elseif ($item->status == 'completed')
                            <span class="badge bg-success">Completed</span>
                        @elseif ($item->status == 'cancelled')
                            <span class="badge bg-danger">Cancelled</span>
                        @else
                            <span class="badge bg-secondary">{{ $item->status }}</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <a href="{{ route('consultation.show', $item->id) }}" class="btn btn-secondary">Detail</a>
                        <a href="{{ route('consultation.edit', $item->id) }}" class="btn btn-primary">Edit</a>

                        <a href="javascript:void(0)"
                        onclick="deleteConsultation(this)"
                        data-id="{{ $item->id }}"
                        class="btn btn-danger">Delete</a>

                        <form id="delete-form-{{ $item->id }}"
                            action="{{ route('consultation.destroy', $item->id) }}"
                            method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const swal = $('.swal').data('swal');
    if (swal) {
        Swal.fire({
            'title': 'Success',
            'text': swal,
            'icon': 'success',
            'showConfirmButton': false,
            'timer' : 2000
        })
    }

    function deleteConsultation(e) {
    let id = e.getAttribute('data-id');

    Swal.fire({
        title: 'Delete Consultation',
        text: "Are You Sure.?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Delete!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'DELETE',
                url: '/consultation/' + id,
                dataType: "json",
                success: function (response) {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                    }).then(() => {
                        window.location.href = '/consultation';
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    });
}
</script>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable()
    });
</script>

{{-- <script>
//     $(document).ready(function () {
//         $('#dataTable').DataTable({
//             processing: true,
//             serverSide: true,
//             ajax: '{{ url()->current() }}',
//             columns: [{
//                     data: 'DT_RowIndex',
//                     name: 'DT_RowIndex',
//                 },
//                 {
//                     data: 'title',
//                     name: 'title',
//                 },
//                 {
//                     data: 'category_id',
//                     name: 'category_id',
//                 },
//                 {
//                     data: 'views',
//                     name: 'views',
//                 },
//                 {
//                     data: 'status',
//                     name: 'status',
//                 },
//                 {
//                     data: 'publish_date',
//                     name: 'publish_date',
//                 },
//                 {
//                     data: 'button',
//                     name: 'button',
//                 }
//             ]
//         });
//     });
</script> --}}
@endpush
