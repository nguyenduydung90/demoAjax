<!doctype html>
<html lang="en">
  <head>
    <title>CRUD BY AJAX</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
{{--  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>  --}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"
        integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf"
        crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="card">

        <table class="table table-hover table-primary" id="customerTable">
          <thead>
            <tr>
              <th>Name</th>
              <th>Phone</th>
              <th>Address</th>

              <th>Acction</th>
            </tr>
          </thead>
          <tbody id="result">
               @foreach($customers as $key => $value)
            <tr id="{{ $value->id }}">
              <td>{{ $value->name }}</td>
              <td>{{ $value->phone }}</td>

              <td>{{ $value->address }}</td>

              <td>
                <a class="btn btn-danger btnDel" data-id={{ $value->id }} >Delete</a>
                <a class="btn btn-primary btnEdit ml-3" data-id={{ $value->id }} >Edit</a>
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
    </div>
    </div>

    {{--  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">  --}}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <p>Name: <input type="text" name="name" id="name" class="form-control"/> <span
                                id="first_name"></span></p>
                        <p>Phone: <input type="text" name="phone" id="phone" class="form-control"/> <span
                                id="last_name"></span></p>
                        <p>Address: <input type="text" name="address" id="address" class="form-control"/> <span
                                id="last_name"></span></p>
                        <button id="addCustomer">ADD</button>
                    </div>
                </div>

            </div>
        </div>
    {{--  </div>  --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#addCustomer').click(function(){
            addCustomer()


        })


        $('body').on('click', '.btnDel', function(){
            alert(100);
            var data_id=$(this).attr('data-id');
            $.get('/delete/'+data_id, function(response){
             $('#customerTable tbody #'+ data_id).remove();

            })
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var addCustomer=function(){
            var name=$('#name').val();
            var phone=$('#phone').val();
            var address=$('#address').val();
            var result = $('#result').html();

            console.log(location.origin)
            $.ajax(
                {
                    url:location.origin+"/add",
                    type: 'POST',
                    data:{name,phone,address},
                    success: function(response){
                        console.log(response)
                        $('#result').html(result +
                        `<tr id="${response[0].id}">
                            <td>${response[0].name}</td>
                            <td>${response[0].phone}</td>
                            <td>${response[0].address}</td>
                            <td>
                                <a class="btn btn-danger btnDel" data-id="${response[0].id}" >Delete</a>
                                <a class="btn btn-primary btnEdit ml-3" data-id="${response[0].id}" >Edit</a>
                            </td></tr>`);

                             $('#name').val('');
             $('#phone').val('');
             $('#address').val('');
                    }
                })
    }





   });

</script>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{--  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>  --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
    crossorigin="anonymous"></script>
  </body>

</html>
