@extends('back.layout.template')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.bootstrap5.min.css">
@endpush

@section('title', 'Service Perusahaan - Nexus Craft')

@section('content')
{{-- content --}}
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><i class="fa-solid fa-hand-holding-heart"></i> Service</h1>
    </div>

    <div class="mt-3">
        <a href="{{ url('service/create')}}" class="btn btn-success mb-2"><i class="fa-solid fa-plus"></i> Create</a>

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
                    <th>Name Service</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Publish Date</th>
                    <th>Function</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($service as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_service }}</td>
                        <td>{{ $item->category->name}}</td>
                        </td>
                        <td class="text-nowrap">
                            Rp. {{ number_format((float) $item->price, 0, ',', '.') }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($item->publish_date)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->translatedFormat('d M Y') }}</td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-1">
                                <a href="{{ route('service.show', $item->id) }}" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('service.edit', $item->id) }}" class="btn btn-primary">Edit</a>

                                <a href="javascript:void(0)"
                                onclick="deleteService(this)"
                                data-id="{{ $item->id }}"
                                class="btn btn-danger">Delete</a>

                                <form id="delete-form-{{ $item->id }}"
                                    action="{{ route('service.destroy', $item->id) }}"
                                    method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
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

    function deleteService(e) {
    let id = e.getAttribute('data-id');

    Swal.fire({
        title: 'Delete Service',
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
                url: '/service/' + id,
                dataType: "json",
                success: function (response) {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                    }).then(() => {
                        window.location.href = '/service';
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
