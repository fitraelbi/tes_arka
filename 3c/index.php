<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 bg-light mt-2 rounded">
                <div class="form-inline">
                    <input type="text" name='search' id="search_text" class="form-control form-control-lg rounder-0 border-primary" placeholder="Search...">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-success">Add</button>
                </div>
                <hr>
                <?php
                    include 'config.php';
                    $stmt = $conn->prepare("SELECT product.id AS id, cashier.name AS cashier, product.name AS product, category.name AS category, product.price AS price FROM product JOIN cashier ON product.id_cashier = cashier.id JOIN category ON product.id_category = category.id");
                    $stmt->execute();
                    $result = $stmt->get_result();
                ?>
                <table class="table table-hover table-light table-striped" id="table-data">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cashier</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row=$result->fetch_assoc()){ ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td><?= $row['cashier']; ?></td>
                                <td><?= $row['product']; ?></td>
                                <td><?= $row['category']; ?></td>
                                <td><?= $row['price']; ?></td>
                                <td>
                                    <a href="#" class="fa fa-edit"></a>
                                    <a href="#" class = "fa fa-trash text-danger"></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div id="add_data_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">ADD</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id = "insert_form">
                        <div class="form-group">
                            <input type="text" name="cashier"  id = "cashier" class="form-control" placeholder="Raisa Andriana">
                        </div>
                        <div class="form-group">
                            <input type="text" name="product" id="product" class="form-control" placeholder="Latte">
                        </div>
                        <div class="form-group">
                            <input type="text" name="category" id="category" class="form-control" placeholder="Drink">
                        </div>
                        <div class="form-group">
                            <input type="text" name="price" id="price" class="form-control" placeholder="10000">
                        </div>
                        <input type="submit" name="insert" id="insert" value="insert" class="btn btn-success"/>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>                 

    <script type="text/javascript">
        $(document).ready(function(){
            $('#insert_form').on('submit', function(event){
                event.preventDefault();
                if($('#cashier').val== ""){
                    alert("Cashier is required!");
                }
                else if($('#product').val== ""){
                    alert("Product is required!");
                }
                else if($('#category').val== ""){
                    alert("Category is required!");
                }
                else if($('#price').val== ""){
                    alert("Price is required!");
                }
                else{
                    $.ajax({
                        url: "insert.php",
                        method:"POST",
                        data: $('#insert_form').serialize(),
                        success:function(data){
                            $("#table-data").html(data);    
                        }
                    });
                }
            });
            $("#search_text").keyup(function(){
                var search = $(this).val();
                $.ajax({
                    url:'action.php',
                    method: 'post',
                    data:{query:search},
                    success:function(response){
                        $('#insert_form')[0].reset();
                        $('add_data_Modal').modal('hide')
                        $("#table-data").html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>