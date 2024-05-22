@extends('layouts.master')
@section('title','User')
@section('content')
<div class="main">

    <!-- BOF Breadcrumb -->
    <div class="row">
        <div class="col">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="ti-home"></i> Master Data</a></li>
                <li class="breadcrumb-item active">User Management</li>
            </ol>
        </div>
    </div>
    <!-- EOF Breadcrumb -->
    
    <!-- BOF Basic Datatable -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="caption uppercase">
                        <i class="ti-file"></i> User Management
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="btn btn-sm btn-success exampleModalSize" data-size="lg" data-toggle="modal" data-target="#addModal"><i class="ti-plus"></i> Add User</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover init-datatable" id="user_table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->role_id }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="javascript:void(0);" onclick="edit('{{ $item->id }}')">Edit</a>
                                            <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="hapus('{{ $item->id }}')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    <form method="post" action="{{url('user/store')}}" novalidate enctype="multipart/form-data">
                        @csrf
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Name</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Email</label>
                                    <div class="col">
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Password</label>
                                    <div class="col">
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Role</label>
                                    <div class="col">
                                        <select class="form-control" name="role_id">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Role</label>
                                    <div class="col">
                                        <input type="text" class="form-control" name="role_id">
                                    </div>
                                </div>
                            </li>
                        </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-3">
                    <form method="post" action="{{url('user/update')}}" novalidate enctype="multipart/form-data">
                        @csrf
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Name</label>
                                    <div class="col">
                                        <input type="hidden" class="form-control" name="id" id="id_edit">
                                        <input type="text" class="form-control" name="name" id="name_edit">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Email</label>
                                    <div class="col">
                                        <input type="email" class="form-control" name="email" id="email_edit">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Password</label>
                                    <div class="col">
                                        <input type="password" class="form-control" name="password" id="password_edit">
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Role</label>
                                    <div class="col">
                                        <select class="form-control" name="role_id" id="role_id_edit">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Role</label>
                                    <div class="col">
                                        <input type="password" class="form-control" name="role_id" id="role_id_edit">
                                    </div>
                                </div>
                            </li>
                        </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    function hapus(id) {
        Swal.fire({
            title: 'Yakin?',
            text: "Mau menghapus data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#FF2C2C',
            confirmButtonText: 'Ya, Hapus saja !'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{url('user/delete')}}",
                    type: "post",
                    data: {
                        _token: '{{csrf_token()}}',
                        id: id
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            Swal.fire('Deleted!', 'User has been deleted.', 'success');
                            location.reload();
                        } else {
                            Swal.fire('Failed!', 'Failed to delete user, please try again later.', 'error');
                            location.reload();
                        }
                    },
                    error: function(err) {
                        Swal.fire('Error!', 'There was an error, please check the console for details.', 'error');
                        console.error(err);
                        location.reload();
                    }
                });
            }
        });
    }

    function edit(id) {
        $.ajax({
            url: "{{url('user/getDetail')}}",
            type: "get",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $('#id_edit').val(id);
                $('#name_edit').val(data.name);
                $('#email_edit').val(data.email);
                $('#role_id_edit').val(data.role_id);
                $("#editModal").modal("show");
            },
            error: function(err) {
                console.error(err);
            }
        });
    }
</script>
@if(session('Save'))
<script>
    Swal.fire('Success!', 'Data has been saved.', 'success');
</script>
@endif
@endsection
