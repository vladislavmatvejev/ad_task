<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="./static/js/jquery-3.1.1.min.js"></script>
    <link href="./static/css/bootstrap.min.css" rel="stylesheet">
    <script src="./static/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row col-md-12">
        <h1>Get orders from <?=date('Y-m-d', strtotime('-7 days'))?></h1>
        <div class="row">
            <label class="col-md-2 control-label" for="todayRadio">Today</label>
            <div class="col-md-10">
                <input class="form-check-input" type="radio" name="filterRadios" id="todayRadio" value="today">
            </div>
        </div>
        <div class="row">
            <label class="col-md-2 control-label" for="weekRadio">This week</label>
            <div class="col-md-10">
                <input class="form-check-input" type="radio" name="filterRadios" id="weekRadio" value="week">
            </div>

        </div>
        <div class="row">
            <label class="col-md-2 control-label" for="allTimeRadio">All time</label>
            <div class="col-md-10">
                <input class="form-check-input" type="radio" name="filterRadios" id="allTimeRadio" value="all" checked>
            </div>
        </div>
    </div>
    <div class="row col-md-12">
        <h1>Add/Edit order</h1>
        <form class="form-horizontal" id="newOrder" method="post">
            <div class="form-group">
                <label for="selectUser" class="col-md-2 control-label">User</label>
                <div class="col-md-5">
                    <select class="form-control" id="selectUser" name="user_id">
                        <?php foreach ($users as $user): ?>
                            <option value="<?=$user['id']; ?>"><?=$user['name']; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="selectProduct" class="col-md-2 control-label">Product</label>
                <div class="col-md-5">
                    <select class="form-control" id="selectProduct" name="product_id">
                        <?php foreach ($products as $product) : ?>
                            <option value="<?=$product['id']?>"><?=$product['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputQuantity" class="col-md-2 control-label">Quantity</label>
                <div class="col-md-5">
                    <input type="number" class="form-control" id="inputQuantity" name="quantity">
                </div>
            </div>
            <input type="hidden" name="edit_id" value="" id="inputEditId">
            <div class="form-group">
                <div class="col-md-offset-6 col-md-5">
                    <button class="btn btn-primary" id="save">Save</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row col-md-12">
        <input class="form-control" placeholder="Search for names" name="like" id="searchBar">
    </div>
    <div class="row col-md-12" id="orders">
    </div>
</div>
<script src="./static/js/main.js" type="text/javascript"></script>
</body>
</html>