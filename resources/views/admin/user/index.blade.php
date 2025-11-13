@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{($title ?? '')}}</h3>
        </div>
        <div class="card-body">
            <div align="right" class="mb-3">
                <a href="{{ route('user.create') }}" class="btn btn-primary">Create User</a>
            </div>
            <table class="table table-bordered">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-white">No</th>
                        <th class="text-white">Name</th>
                        <th class="text-white">Email</th>
                        <th class="text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $key=> $data)

                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>
                            <a href="{{route('user.edit', $data->id)}}" class="btn btn-sm btn-success btn-icon">
                                <span class="tf-icons bx bx-pencil bx-22px"></span>
                            </a>
                            <form action="{{ route('user.destroy', $data->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn btn-danger btn-sm btn-icon">
                                    <span class="tf-icons bx bx-trash bx-22px"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function() {
        $('.btn-danger').click(function(e){
            e.preventDefault();
            let form = $(this).closest('form');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
