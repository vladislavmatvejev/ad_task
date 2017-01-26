        <div class="row">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Product</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr data-order-id="<?=$order['id']?>">
                        <td data-row="user" data-user-id="<?=$order['user_id']?>"><?=$order['user_name']?></td>
                        <td data-row="product" data-product-id="<?=$order['product_id']?>"><?=$order['product_name']?></td>
                        <td><?=$order['date']?></td>
                        <td data-row="quantity" data-quantity="<?=$order['quantity']?>"><?=$order['price']*$order['quantity']?></td>
                        <td><a href="#" onclick="deleteOrder(<?=$order['id'];?>)" id="deleteOrder">DELETE</a> | <a href="#" onclick="editOrder(<?=$order['id'];?>)">EDIT</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>