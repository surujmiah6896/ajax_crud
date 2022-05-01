<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <h2 style="color: rgb(7, 156, 37)">
            <marquee behavior="" direction=""> Laravel 9 Ajax Crud Application</marquee>
        </h2>
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <span id="addStudent">Add New Student</span>
                        <span id="updateStudent">Update Student</span>
                    </div>
                    <div class="card-body">
                        {{-- <form > --}}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name"  placeholder="Enter Student Name">
                            <span class="text-danger" id="name_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <input type="text" class="form-control" id="department" placeholder="Enter Department Name">
                            <span class="text-danger" id="depertment_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <input type="text" class="form-control" id="semester" placeholder="Enter Semester">
                            <span class="text-danger" id="semester_error"></span>
                        </div>
                        <input type="hidden" id="student_id">

                        <button type="submit" id="add_btn" onclick="addData()" class="btn btn-primary">Add</button>
                        <button type="submit" id="update_btn" onclick="updateData()" class="btn btn-primary">Update</button>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>

            {{-- -------Add field------- --}}
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        All Students Info
                    </div>
                    <div class="text-danger">
                        <span id="error" ></span>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>Otto</td>
                                    <td>
                                        <button type="editbutton" class="btn btn-sm btn-primary mr-2">Edit</button>
                                        <button type="deletebutton" class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr> --}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>



    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    -->
<script>
    $('#addStudent').show();
    $('#add_btn').show();
    $('#updateStudent').hide();
    $('#update_btn').hide();
    //-------setup ajax-------
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//-------setup end ajax-------
    function allData(){
    //----start data------
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/student/all",
            // data: {},
            success: function(result){
                var data = '';
                $.each(result,function(key, value){
                    console.log(value.name);
                    console.log(value.depertment);
                    console.log(value.semester);
                    data = data + '<tr>'
                    data = data + '<td>'+value.id+'</td>'
                    data = data + '<td>'+value.name+'</td>'
                    data = data + '<td>'+value.depertment+'</td>'
                    data = data + '<td>'+value.semester+'</td>'
                    data = data + '<td>'
                    data = data + '<button type="editbutton" class="btn btn-sm btn-primary mr-2" onclick="editData('+value.id+')">Edit</button>'
                    data = data + '<button type="deletebutton" class="btn btn-sm btn-danger" onclick="deletData('+value.id+')">Delete</button>'
                    data = data + '</td>'
                    data = data + '</td>'
                });
                $('tbody').html(data);
            }
        });
    }
    allData();

    // -------Clear Data--------
    function clearData(){
        //filed data clear
        $('#name').val('');
        $('#department').val('');
        $('#semester').val('');

        //error data clear
        $('#name_error').text('');
        $('#semester_error').text('');
        $('#depertment_error').text('');


    }

    // -------addData---------
    function addData(){
        var name = $('#name').val();
        var depertment = $('#department').val();
        var semester = $('#semester').val();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {name:name,depertment:depertment,semester:semester},
            url: '/add/student',
            success:function(data){
                clearData();
                allData();
                //success alert message
                const msg = Swal.mixin({
                        toast: true,
                        position:'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                })
                msg.fire({
                    type: 'success',
                    title: 'Data Added Successfully!',
                })
                 //success alert end message
            },

            error: function(error){
                $('#name_error').text(error.responseJSON.errors.name);
                $('#depertment_error').text(error.responseJSON.errors.depertment);
                $('#semester_error').text(error.responseJSON.errors.semester);
            }

        });
    }

      // -------editData---------
      function editData(id){
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/edit/student/'+id,
                success: function(data){
                    //hide addbtn show updatebtn
                    $('#addStudent').hide();
                    $('#add_btn').hide();
                    $('#updateStudent').show();
                    $('#update_btn').show();
                    //technic recevie data
                    $('#student_id').val(data.id);
                    //set data in edit filed
                    $('#name').val(data.name);
                    $('#department').val(data.depertment);
                    $('#semester').val(data.semester);
                }
            });
      }

      //--------update data------
      function updateData(){
        var id = $('#student_id').val();
        var name = $('#name').val();
        var depertment = $('#department').val();
        var semester = $('#semester').val();
          $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
               name:name,depertment:depertment,semester:semester
            },
            url: 'update/student/'+id,
            success: function(data){

                clearData();
                allData();
                $('#addStudent').show();
                $('#add_btn').show();
                $('#updateStudent').hide();
                $('#update_btn').hide();
                // console.log('');
                 //success alert message
                const msg = Swal.mixin({
                        toast: true,
                        position:'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                })
                msg.fire({
                    type: 'success',
                    title: 'Successfully Data Updated!',
                })
                 //success alert end message
            },
            error: function(error){
                $('#name_error').text(error.responseJSON.errors.name);
                $('#depertment_error').text(error.responseJSON.errors.depertment);
                $('#semester_error').text(error.responseJSON.errors.semester);
            }
          });
      }


      //----------deleteData----------
      function deletData(id){
        // swal({
        //     title: "Are You Shure To Delete?",
        //     text: "Once Deleted,you will not be able to recover this inaginary file!",
        //     icon: 'warning',
        //     buttons: true,
        //     dangerMode: true,
        // })
        // .then((willDelete)=>{
        //     if(willDelete){
        //         // $.ajax({
        //         //         type: 'GET',
        //         //         dataType: 'json',
        //         //         url : 'delete/student/'+id,
        //         //         success: function(data){
        //         //             allData();
        //         //             // console.log('Successfully Data Deleted!');
        //         //             $('#error').text('Successfully Data Deleted!');
        //         //             //  //success alert message
        //         //             //     const msg = Swal.mixin({
        //         //             //         toast: true,
        //         //             //         position:'top-end',
        //         //             //         icon: 'success',
        //         //             //         showConfirmButton: false,
        //         //             //         timer: 1500,
        //         //             // })
        //         //             // msg.fire({
        //         //             //     type: 'danger',
        //         //             //     title: 'Successfully Data Deleted!',
        //         //             // })
        //         //             // //success alert end message
        //         //         }
        //         //     });
        //     }else{
        //         swal('Canceled');
        //     }
        // });
                    $.ajax({
                        type: 'GET',
                        dataType: 'json',
                        url : 'delete/student/'+id,
                        success: function(data){
                            allData();
                            // console.log('Successfully Data Deleted!');
                            $('#error').text('Successfully Data Deleted!');
                             //success alert message
                                const msg = Swal.mixin({
                                    toast: true,
                                    position:'top-end',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500,
                            })
                            msg.fire({
                                type: 'danger',
                                title: 'Successfully Data Deleted!',
                            })
                            //success alert end message
                        }
                    });

      }
</script>

</body>

</html>
