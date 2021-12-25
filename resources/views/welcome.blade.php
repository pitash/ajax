<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <title>Laravel Ajax Crud</title>
</head>
<body>
<header>
    <div class="cotainer">
        <div class="row">
            <div class="col-12">
                <h1>Laravel Ajax Crud</h1>
            </div>
        </div>
    </div>
</header>
<section class="body">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">All Task</h3>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#task">Create Task</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Task Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>trr</td>
                            <td style="width: 150px">
                                <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

  <!-- Modal -->
  <div class="modal fade" id="task" tabindex="-1" role="dialog" aria-labelledby="taskLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form id="createTaskForm" action="">
            <div class="modal-header">
            <h5 class="modal-title" id="taskLabel">Create Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div id="createTaskmsg">

                </div>
                <div class="form-group">
                    <label for="">Enter Task Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter task name">

                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>



<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script >
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN' : '{{ csrf_token() }}'
            }
        });
        $('#createTaskForm').submit(function(e){
            e.preventDefault();
            let input = $(this).serialize();
            
            //Form data
            let formData = {
                name: $(input).val();
                // let url = '{{ route('store') }}';
            }

            console.log(formData);
            // return;

            $.ajax({
                type:'POST',
                url: url,
                data: formData,
                success: function(data){
                    // console.log(data);
                    let msg = $('#createTaskmsg');

                    $(msg).append('<div class="alert alert-success">Task Created Successfully</div>');

                    $(input).val('');
                },
                error: function(error){
                    console.log(error);
                }
            })
        });
    })
</script>

</body>
</html>
