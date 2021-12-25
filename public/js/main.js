 //
 //
 //
 // $(function(){
 //    $.ajaxSetup({
 //        headers: {
 //            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
 //        }
 //    });
 //    $('#createTaskForm').submit(function(e){
 //        e.preventDefault();
 //
 //        //Form data
 //        let formData = $(this).serialize();
 //        let url = '{{ route('store') }}';
 //
 //        console.log(formData);
 //        // return;
 //
 //        $.ajax({
 //            type:'POST',
 //            url: url,
 //            data: formData,
 //            success: function(data){
 //                consolel.log(data);
 //            },
 //            error: function(error){
 //                console.log(error);
 //            }
 //        })
 //     });
 // })
