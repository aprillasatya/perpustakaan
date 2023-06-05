@extends('layouts.dashboard') @section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Book</h1>
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Form Book
                </div>
                <div class="card-body">
                    <form
                        class="row g-3"
                        action="{{ route('admin.store-book') }}"
                        method="POST"
                    >
                        @csrf
                        <div class="col-md-12">
                            <label for="title" class="form-label">Judul</label>
                            <input
                                type="text"
                                name="title"
                                class="form-control"
                                id="title"
                            />
                        </div>
                        <div class="col-12">
                            <label for="publication_year" class="form-label"
                                >Tahun Terbit</label
                            >
                            <input
                                type="text"
                                name="publication_year"
                                class="form-control"
                                id="publication_year"
                                placeholder="1234"
                            />
                        </div>
                        <div class="col-12">
                            <label for="writer" class="form-label"
                                >Penulis</label
                            >
                            <input
                                type="text"
                                name="writer"
                                class="form-control"
                                id="writer"
                                placeholder="Aprilla Satya"
                            />
                        </div>
                        <div class="col-6">
                            <label for="stock" class="form-label">Stok</label>
                            <input
                                type="number"
                                name="stock"
                                class="form-control"
                                id="stock"
                            />
                        </div>
                        <hr />
                        <div class="clearfix">
                            <button
                                type="submit"
                                class="btn btn-primary float-end"
                            >
                                Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                        <th>Code</th>
                        <th>Judul</th>
                        <th>Tahun Terbit</th>
                        <th>Penulis</th>
                        <th>Stok</th>
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
                url: "{{ route('admin.list-book')}}",
            },
            columns: [
                {
                    data: "DT_RowIndex",
                },
                {
                    data: "code",
                },
                {
                    data: "title",
                },
                {
                    data: "publication_year",
                },
                {
                    data: "writer",
                },
                {
                    data: "stock",
                },
            ],
        });
    });
</script>
@endsection
