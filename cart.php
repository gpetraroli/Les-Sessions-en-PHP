<?php

session_start();

if(!isset($_SESSION['name']))
{
    header("Location: login.php");
    exit;
}

require 'inc/head.php';

if(isset($_GET['remove_from_cart']))
{
    if($_SESSION['cart'][$_GET['remove_from_cart']]['qta'] > 0)
    {
        $_SESSION['cart'][$_GET['remove_from_cart']]['qta']--;
    }
    header("Location: cart.php");
    exit;
}

?>

<section class="cookies container-fluid">
    <div class="row">
        <ul class="cart-list">
            <?php foreach ($_SESSION['cart'] as $id => $product): ?>
                <?php if($product['qta'] !== 0): ?>
                    <li class="cart-list__item list-unstyled">
                        <a href="?remove_from_cart=<?= $id; ?>" class="btn btn-primary">
                            <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                        </a>
                        <p class="cart-list__text">
                            <?= $product['qta'] ?>
                            x
                            <?= $product['name'] ?>
                        </p>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if(array_sum(array_column($_SESSION['cart'], 'qta')) === 0): ?>
                <li class="cart-list__item list-unstyled">
                    <p>Your cart is empty! <a href="index.php">Continue shopping</a></p>
                </li>
            <?php endif; ?>
        </ul>

    </div>
</section>
<?php require 'inc/foot.php'; ?>
