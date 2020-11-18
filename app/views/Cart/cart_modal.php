<?php if(!empty($_SESSION['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th>Foto</th>
                <th>Denumirea</th>
                <th>Cantitatea</th>
                <th>Prețul</th>
                <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($_SESSION['cart'] as $id => $item): ?>
                <tr>
                    <td><a href="product/<?=$item['alias'];?>"><img src="images/<?=$item['img'];?>" alt=""></a></td>
                    <td><a href="product/<?=$item['alias'];?>"><?=$item['title'];?></td>
                    <td><?=$item['qty'];?></td>
                    <td><?=$item['price'];?><?= $_SESSION['cart.currency']['symbol_left'] . $_SESSION['cart.currency']['symbol_right'];?></td> <!-- simbolul valutei de luat din rindul 29 $_SESSION['cart.currency']['symbol_left'] . $_SESSION['cart.sum'] . $_SESSION['cart.currency']['symbol_right']-->
                    <td><span data-id="<?=$id;?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td>In total:</td>
                <td colspan="4" class="text-right cart-qty"><?=$_SESSION['cart.qty'];?></td>
            </tr>
            <tr>
                <td>De suma:</td>
                <td colspan="4" class="text-right cart-sum"><?= $_SESSION['cart.currency']['symbol_left'] . $_SESSION['cart.sum'] . $_SESSION['cart.currency']['symbol_right'];?></td>
            </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <h3>Coșul e gol</h3>
<?php endif; ?>