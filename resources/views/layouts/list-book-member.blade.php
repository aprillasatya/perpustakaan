@extends('layouts.dashboard') @section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Book</h1>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div
    class="modal fade"
    id="borrowingModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form action="{{ route('borrowing-book') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" class="bookId" name="book_id" />
                        <label for="borrowingDate" class="form-label"
                            >Tanggal Peminjaman</label
                        >
                        <input
                            type="date"
                            name="borrowing_date"
                            class="form-control borrowingDate"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="returnDate" class="form-label"
                            >Tanggal Pengembalian</label
                        >
                        <input
                            type="date"
                            name="return_date"
                            class="form-control returnDate"
                        />
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary pinjamSave">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#datatables").DataTable({
            lengthChange: false,
            ajax: {
                url: "{{ route('list-book')}}",
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
                {
                    data: "action",
                    name: "action",
                    render: function (data, type, row) {
                        action =
                            '<button type="button" class="btn btn-success pinjamBtn" data-id="' +
                            data.id +
                            '">Pinjam</button>';
                        return action;
                    },
                },
            ],
        });
        $(document).on("click", ".pinjamBtn", function () {
            $(".bookId").val($(this).data("id"));
            $("#borrowingModal").modal("show");
        });

        // $(document).on("click", ".pinjamSave", function () {
        //     let bookId = $(".bookId").val();
        //     let borrowingDate = $(".borrowingDate").val();
        //     let returnDate = $(".returnDate").val();
        //     console.log(bookId + borrowingDate + returnDate);
        // });
    });
</script>
@endsection
