<?php
    include 'config.php';
    if(!empty($_POST)){
        $output= '';
        $cashier = mysqli_real_escape_string($conn, $_POST["cashier"]);
        $product = mysqli_real_escape_string($conn, $_POST["product"]);
        $category = mysqli_real_escape_string($conn, $_POST["category"]);
        $price = mysqli_real_escape_string($conn, $_POST["price"]);
        
        $stmt = $conn->prepare("INSERT INTO cashier(name) VALUES('$cashier')");
        $stmt = $conn->prepare("INSERT INTO product(name) VALUES('$product')");
        $stmt = $conn->prepare("INSERT INTO product(name, price) VALUES('$product', '$price')");
        $stmt->execute();
        $result=$stmt->get_result();

        if($result->num_rows>0){
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
                while($row=$result->fetch_assoc()){
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
        }
        else{
            echo "<h3>No Records Found!</h3>";
        }
    }
?>