@extends('layouts.dashboard') @section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Peminjaman Buku</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Example
        </div>
        <div class="card-body">
            <table id="datatables" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#datatables").DataTable({
            lengthChange: false,
            ajax: {
                url: "{{ route('admin.list-borrowing-book')}}",
            },
            columns: [
                {
                    data: "DT_RowIndex",
                },
                {
                    data: "name",
                },
                {
                    data: "code",
                },
                {
                    data: "title",
                },
                {
                    data: "status",
                },
                {
                    data: "action",
                    name: "action",
                    render: function (data, type, row) {
                        action =
                            '<button type="button" class="btn btn-success" data-id="' +
                            data.id +
                            '">Approve</button><button type="button" class="btn btn-danger" data-id="' +
                            data.id +
                            '">Reject</button>';
                        return action;
                    },
                },
            ],
        });
    });
</script>
@endsection
