<!DOCTYPE html>
<html>
<head>
    <title>Studednt Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" >
   <!--  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" />
</head>
<body>
    
<div class="container">
    <h1 class="text-center" style="margin-top:20px">Student Management</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewBook"> Create Student</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
               <th>Mobile</th>
               <th>Class</th>
               <th>Father Name</th>
               <th>Mother Name</th>
                <th width="500px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="bookForm" name="bookForm" class="form-horizontal">
                   <input type="hidden" name="book_id" id="book_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="" maxlength="50" required="">
                        </div>
                    </div>
                      <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Mobile</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile" value="" maxlength="50" required="">
                        </div>
                    </div>
                       <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Class</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="class" name="class" placeholder="Enter Class" value="" maxlength="50" required="">
                        </div>
                    </div>
                       <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Father Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Enter Father Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                       <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Mother Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="mother_name" name="mother_name" placeholder="Enter Mother Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                   
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  
<script type="text/javascript">
  $(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('books.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
             {data: 'mobile', name: 'mobile'},
              {data: 'class', name: 'class'},
              {data: 'father_name', name: 'father_name'},
              {data: 'mother_name', name: 'mother_name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    $('#createNewBook').click(function () {
        $('#saveBtn').val("create-book");
        $('#book_id').val('');
        $('#bookForm').trigger("reset");
        $('#modelHeading').html("Create New Student");
        $('#ajaxModel').modal('show');
    });
    $('body').on('click', '.editBook', function () {
      var book_id = $(this).data('id');
      $.get("{{ route('books.index') }}" +'/' + book_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Student");
          $('#saveBtn').val("edit-book");
          $('#ajaxModel').modal('show');
          $('#book_id').val(data.id);
          $('#name').val(data.name);
          $('#email').val(data.email);
          $('#mobile').val(data.mobile);
          $('#class').val(data.class);
          $('#father_name').val(data.father_name);
          $('#mother_name').val(data.mother_name);
      })
   });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Save');
    
        $.ajax({
          data: $('#bookForm').serialize(),
          url: "{{ route('books.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
     
              $('#bookForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    
    $('body').on('click', '.deleteBook', function () {
     
        var book_id = $(this).data("id");
        confirm("Are You sure want to delete !");
      
        $.ajax({
            type: "DELETE",
            url: "{{ route('books.store') }}"+'/'+book_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
     
  });
</script>
</body>
</html>