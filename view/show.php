<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style/show.css">
    <title>User Info</title>
</head>
<body>
    <div class="container d-flex justify-content-between p-4 border border-5 my-4">
        <h3>User Information</h3>
        <button  class="btn btn-outline-primary" id="open_add" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-plus"></i>  Add User</button>
    </div>
    <div class="container">
        <table class="table table-hover align-middle" style="table-layout: fixed;">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Profile</th>
                <th>Action</th>
            </tr>
            <?php 
                include '../shared/connection.php';
                $sql  =   "SELECT * FROM `user` WHERE 1 ORDER BY `id` DESC";
                $result_show = $connection -> query($sql);
                while($row = mysqli_fetch_assoc($result_show)){
                    echo '
                        <tr>
                            <td>'.$row['id'].'</td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['gender'].'</td>
                            <td>
                                <img src="../image/'.$row['image'].'" alt="'.$row['image'].'">
                            </td>
                            <td>
                                <button id="open_edit" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button id="accept_delete" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    ';
                }
            ?>
            
        </table>
    </div>
    <?php 
        include 'modal.php';
    ?>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
        $("#file").on('change',function(){
            var formData = new FormData(); //store file in formData

            var imageFile  = $("#file")[0].files;
            console.log(imageFile);
            formData.append('_file',imageFile[0]);
            //_file = image name

            $.ajax({
                method : 'POST',
                url : 'save-image.php',
                data : formData,
                cache :false,
                processData :false,
                contentType : false,
                success :function(image){ // image = $file
                    $("#image-choose").attr('src','../image/'+image);
                    $('#image').val(image);
                }
            })
        })
        $('#accept_add').on('click',function(){
            var name  =  $('#name').val();
            var gender=  $('#gender').val();
            var image =  $('#image').val();
            

            $.ajax({
                method : 'POST',
                url : 'insert.php',
                data : {
                    insert_name : name,
                    insert_gender :gender,
                    insert_image : image
                },
                cache : false,
                success : function(response){
                    if(response == "Ok"){
                        alert('Success');
                    }
                    else{
                        alert('Error');
                    }
                }
            })
        })
        $('#open_add').on('click',function(){
            $('#accept_add').show();
            $('#accept_edit').hide();
        })
        $('body').on('click','#open_edit',function(){
            $('#accept_add').hide();
            $('#accept_edit').show();

            var id      =    $(this).parents('tr').find('td').eq(0).text();
            var name    =    $(this).parents('tr').find('td').eq(1).text();
            var gender  =    $(this).parents('tr').find('td').eq(2).text();
            var image   =    $(this).parents('tr').find('td:eq(3) img').attr('alt');
            
            $('#id').val(id);
            $('#name').val(name);
            $('#gender').val(gender);
            $('#image-choose').attr('src','../image/'+image);
            $('#image').val(image);     

            $('#save-change').on('click',function(){
                id     = $('#id').val();
                name   = $('#name').val();
                gender = $('#gender').val();
                image  = $('#image').val();

                $.ajax({
                    method : "POST",
                    url   : 'update.php',
                    data   : {
                        up_id     : id,
                        up_name   : name,
                        up_gender : gender ,
                        up_image  : image 
                    },
                    cache : false,
                    success : function(response){
                        if(response == "OK"){
                            alert("OK");
                        }
                        else{
                            alert("Error");
                        }
                    }
                })
                $('#close').click();
                $('#close1').click();   
            })
            $('#reset').click(function(){
                $('#close').click();
                $('#close1').click();
            })
        })
        $('#accept_delete').on('click',function(){
            var id = $(this).parents('tr').find('td').eq(0).text();
            

            $.ajax({
                method : "post",
                url : 'delete.php',
                data : {
                    delete_id : id
                },
                cache : false,
                success : function(response){
                    if(response == "OK"){
                        alert('Success');
                    }
                    else{
                        alert('error');
                    }
                }
            })
        })

    })
</script>

