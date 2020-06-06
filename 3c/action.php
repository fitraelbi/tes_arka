<?php 
    include 'config.php';
    $output= '';

    if(isset($_POST['query'])){
        $search= $_POST['query'];
        $stmt= $conn->prepare("SELECT product.id AS id, cashier.name AS cashier, product.name AS product, category.name AS category, product.price AS price FROM product JOIN cashier ON product.id_cashier = cashier.id JOIN category ON product.id_category = category.id WHERE cashier.name LIKE ?");
        $stmt->bind_param("s", $search);

    }
    else{
        $stmt = $conn->prepare("SELECT product.id AS id, cashier.name AS cashier, product.name AS product, category.name AS category, product.price AS price FROM product JOIN cashier ON product.id_cashier = cashier.id JOIN category ON product.id_category = category.id");
    }
    $stmt->execute();
    $result=$stmt->get_result();

   
        $output .= "<thead>
                    <tr>
                        <th>ID</th>
                        <th>Cashier</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                 </thead>
                 <tbody>";
            while($row=$result->fetch_fetch_array()){
                $output .= "
                <tr>
                    <td>".$row['id']."</td>
                    <td>".$row['cashier']."</td>
                    <td>".$row['product']."</td>
                    <td>".$row['category']."</td>
                    <td>".$row['price']."</td>
                    <td>
                        <a href='#' class='fa fa-edit'></a>
                        <a href='#' class = 'fa fa-trash text-danger'></a>
                    </td>
                </tr>";
            }
            $output .="</tbody>";
            echo $output;
    
    
?>