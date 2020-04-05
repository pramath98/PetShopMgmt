<?php


echo '
    
<div class="row mt-5 pt-3 d-flex">
<div class="col-md-6 d-flex">
    <div class="cart-detail cart-total bg-light p-3 p-md-4">
        <h3 class="billing-heading mb-4">Cart Total</h3>
        <p class="d-flex">
                  <span>Subtotal</span>
                  <span>₹'.$_GET["total"].'</span>
              </p>
              <p class="d-flex">
                  <span>Delivery</span>
                  <span>$0.00</span>
              </p>
              <hr>
              <p class="d-flex total-price">
                  <span>Total</span>
                  <span>₹'.$_GET["total"].'</span>
              </p>
              </div>
</div>

';

?>