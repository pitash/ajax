<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" /

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">

    

    <title>Laravel Ajax</title>
  </head>
  <body>
    <div class="container">
        <h1>Student List</h1>
        <a class="btn btn-success" href="javascript:void(0)" id="createStudent" style="float: right" >Add</a>
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action </th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="studentForm" name="studentForm" class="form-horizontal">
                        <input type="hidden" name="student_id" id="student_id">
                        <div class="form-group">
                            Name: <br>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="">
                        </div>
                        <div class="form-group">
                            Email: <br>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary" id="saveButton" value="Create">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" ></script>

    <script type="text/javascript">
    $(function(){
        $.ajaxSetup({
            headers: {
                // 'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $(".data-table").DataTable({
            processing:true,
            serverSide:true,
            ajax:"{{ route('students.index') }}",
                columns:[
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'name', name:'name'},
                    {data: 'email', name:'email'},
                    {data: 'action', name:'action'},
                ]
        });

        $("#createStudent").click(function(){
            $("#student_id").val('');
            
            //Form Reset
            $("#studentForm").trigger("reset");

            $("#modalHeading").html('Add Student');
             $('#ajaxModel').modal('show');
        });

        // Save for the button
        $("#saveButton").click(function(e){
            e.preventDefault();
            $(this).html('Save');

            $.ajax({
                data: $("#studentForm").serialize(),
                url: "{{ route('students.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data){
                    $("#studentForm").trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                },
                //if any error required
                error: function(data){
                    console.log('Error:',data);
                    $("#saveButton.").html('Save');
                }
            });
        });
        $('body').on('click','.deleteStudent', function(){
            var student_id = $(this).data("id");
            confirm("Are You Sure Want To Delete!");
            $.ajax({
                type: "DELETE",
                url: "{{ route('students.store') }}"+ '/'+ student_id,
                success: function(data){
                    table.draw();
                },
                error: function(data){
                    console.log('Error:',data);
                }
            });
        });

        $('body').on('click','.editStudent', function(){
            var student_id = $(this).data('id');
            $.get("{{ route('students.index') }}" + "/" + student_id + "/edit", function(data){
                $("#modalHeading").html("Edit Student");
                $('#ajaxModel').modal('show');
                $("#student_id").val(data.id);
                $("#name").val(data.name);
                $("#email").val(data.email);
            });
        });
    });
    </script>

  </body>
</html>