<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laravel 8 AJAX CRUD using DataTable sss</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Laravel 8 Ajax CRUD DataTables </h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="card-body">
            <table class="table table-bordered" id="ajax-crud-datatable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- boostrap company model -->
    <div class="modal fade" id="company-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="CompanyModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="CompanyForm" name="CompanyForm" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="category"
                                    placeholder="Enter Category" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save">Save changes
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- end bootstrap model -->
</body>
<script type="text/javascript">
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#ajax-crud-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('category-crud-datatable') }}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'category',
                name: 'category'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            },
        ],
        order: [
            [0, 'desc']
        ]
    });
});

function add() {
    $('#CompanyForm').trigger("reset");
    $('#CompanyModal').html("Add Company");
    $('#company-modal').modal('show');
    $('#id').val('');
}

function editFunc(id) {
    $.ajax({
        type: "POST",
        url: "{{ url('categoryedit') }}",
        data: {
            id: id
        },
        dataType: 'json',
        success: function(res) {
            $('#CompanyModal').html("Edit Company");
            $('#company-modal').modal('show');
            $('#id').val(res.id);
            $('#category').val(res.category);
        }
    });
}

function deleteFunc(id) {
    if (confirm("Delete Record?") == true) {
        var id = id;
        // ajax
        $.ajax({
            type: "POST",
            url: "{{ url('categorydeletesss') }}",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(res) {
                var oTable = $('#ajax-crud-datatable').dataTable();
                oTable.fnDraw(false);
            }
        });
    }
}
$('#CompanyForm').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "{{ url('categorystore')}}",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            $("#company-modal").modal('hide');
            var oTable = $('#ajax-crud-datatable').dataTable();
            oTable.fnDraw(false);
            $("#btn-save").html('Submit');
            $("#btn-save").attr("disabled", false);
        },
        error: function(data) {
            console.log(data);
        }
    });
});
</script>

</html>ss