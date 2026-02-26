<?php
// VitaRevive - Child Theme Functions

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('blocksy-parent', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@400;500;600;700;800&display=swap', [], null);
    wp_enqueue_style('blocksy-child', get_stylesheet_uri(), array('blocksy-parent', 'google-fonts'));
});

// Trust badges below Add to Cart
add_action('woocommerce_single_product_summary', function() {
    echo '<div class="product-trust-strip">
        <div class="pts-item"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#5d8161" stroke-width="2"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg> COA Included</div>
        <div class="pts-item"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#5d8161" stroke-width="2"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg> 99%+ Purity</div>
        <div class="pts-item"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#5d8161" stroke-width="2"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg> Ships in 24-48h</div>
    </div>';
}, 35);

// Research disclaimer
add_action('woocommerce_after_single_product_summary', function() {
    echo '<div class="research-disclaimer">
        <strong>Research Use Only</strong> — This product is intended solely for in-vitro research and laboratory use. Not for human consumption. By purchasing, you confirm this product will be used exclusively for legitimate research purposes.
    </div>';
}, 15);

// Product badges
add_action('woocommerce_before_shop_loop_item_title', function() {
    global $product;
    $limited = ['Semaglutide 5mg', 'Tirzepatide 10mg'];
    if (in_array($product->get_name(), $limited)) {
        echo '<span class="limited-batch-badge">Limited Batch</span>';
    }
    $popular = ['BPC-157 5mg', 'NAD+ 500mg'];
    if (in_array($product->get_name(), $popular)) {
        echo '<span class="popular-badge">Best Seller</span>';
    }
}, 9);

// Free shipping notice
add_action('woocommerce_before_cart', function() {
    $cart_total = WC()->cart->get_subtotal();
    if ($cart_total < 150) {
        $remaining = 150 - $cart_total;
        echo '<div class="free-ship-notice">Add $' . number_format($remaining, 2) . ' more for FREE shipping</div>';
    } else {
        echo '<div class="free-ship-notice free-ship-qualified">You have earned FREE shipping</div>';
    }
});
