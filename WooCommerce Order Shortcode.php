<?php


function custom_thank_you_page_shortcode( $atts ) {
    // কুকি থেকে অর্ডার আইডি গ্রহণ করা
    if ( isset( $_COOKIE['custom_order_id'] ) ) {
        $order_id = intval( $_COOKIE['custom_order_id'] );
        $order = wc_get_order( $order_id );

        if ( $order ) {
            ob_start();

            echo '<h2>Thank you for your purchase!</h2>';
            echo 'Order Number: ' . $order->get_order_number() . '<br>';
            echo 'Purchase Date: ' . date_i18n( get_option( 'date_format' ), strtotime( $order->get_date_created() ) ) . '<br>';
            echo 'Total Amount: ' . $order->get_formatted_order_total() . '<br>';
            echo 'Payment Method: ' . $order->get_payment_method_title() . '<br>';
            
            echo '<h3>Order Details:</h3>';
            foreach( $order->get_items() as $item_id => $item ) {
                echo $item->get_name() . ' x ' . $item->get_quantity() . ' - ' . wc_price( $item->get_total() ) . '<br>';
            }
            
            echo '<h3>Billing Details:</h3>';
            echo $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() . '<br>';
            echo $order->get_billing_address_1() . '<br>';
            echo $order->get_billing_city() . ', ' . $order->get_billing_state() . '<br>';
            echo $order->get_billing_postcode() . '<br>';
            echo $order->get_billing_country() . '<br>';
            echo $order->get_billing_email() . '<br>';
            echo $order->get_billing_phone() . '<br>';
            
            // কুকি রিমুভ করা
            setcookie( 'custom_order_id', '', time() - 3600, '/' );

            return ob_get_clean();
        } else {
            return 'Order not found.';
        }
    } else {
        return 'Order not found.';
    }
}
add_shortcode( 'custom_thank_you', 'custom_thank_you_page_shortcode' );




// Order number Shortcode 
function custom_order_number(){
    
    // get order ID from cookies
    if ( isset( $_COOKIE['custom_order_id'] ) ) {
        $order_id = intval( $_COOKIE['custom_order_id'] );
        $order = wc_get_order( $order_id );

        if ( $order ) {
            ob_start();

            echo 'Order Number: ' . $order->get_order_number();
            
            // cookies remove
            setcookie( 'custom_order_id', '', time() - 3600, '/' );

            return ob_get_clean();
        } else {
            return 'Order not found.';
        }
    } else {
        return 'Order not found.';
    }
}
add_shortcode('gp_it_order_number', 'custom_order_number');





// Purchace Order Date
function custom_purchace_order_date() {
        
    // get order ID from cookies
    if ( isset( $_COOKIE['custom_order_id'] ) ) {
        $order_id = intval( $_COOKIE['custom_order_id'] );
        $order = wc_get_order( $order_id );

        if ( $order ) {
            ob_start();

            echo 'Purchase Date: ' . date_i18n( get_option( 'date_format' ), strtotime( $order->get_date_created() ) );
            
            // cookies remove
            setcookie( 'custom_order_id', '', time() - 3600, '/' );

            return ob_get_clean();
        } else {
            return 'Order not found.';
        }
    } else {
        return 'Order not found.';
    }
}

add_shortcode( 'gp_it_order_date', 'custom_purchace_order_date' );



// Total Ammount
function custom_total_ammount() {
        
    // get order ID from cookies
    if ( isset( $_COOKIE['custom_order_id'] ) ) {
        $order_id = intval( $_COOKIE['custom_order_id'] );
        $order = wc_get_order( $order_id );

        if ( $order ) {
            ob_start();

            echo 'Total Amount: ' . $order->get_formatted_order_total() . '<br>';
            
            // cookies remove
            setcookie( 'custom_order_id', '', time() - 3600, '/' );

            return ob_get_clean();
        } else {
            return 'Total Ammount not Found OR Order not found.';
        }
    } else {
        return 'Total Ammount not Found OR Order not found.';
    }
}

add_shortcode( 'gp_it_total_ammount', 'custom_total_ammount' );



// Payment method title
function custom_payment_method_title() {
    
    // get order form cookies
    if ( isset( $_COOKIE['custom_order_id'] ) ){
        $order_id = intval( $_COOKIE['custom_order_id'] );
        $order = wc_get_order( $order_id );

        if ( $order ) {
            ob_start();
    
            echo "Payment Mehod:". $order->get_payment_method_title();
    
            // cookies remove
            setcookie( 'custom_order_id', '', time() - 3600, '/' );
    
            return ob_get_clean();
        } else {
            return "Payment method Not found or Order not created";
        }
    } else {
        return "Payment method Not found or Order not created";
    }

    
}

add_shortcode( 'gp_it_payment_method_title', 'custom_payment_method_title' );



// email title
function custom_email() {
    
    // get order form cookies
    if ( isset( $_COOKIE['custom_order_id'] ) ){
        $order_id = intval( $_COOKIE['custom_order_id'] );
        $order = wc_get_order( $order_id );

        if ( $order ) {
            ob_start();
    
            echo $order->get_billing_email();;
    
            // cookies remove
            setcookie( 'custom_order_id', '', time() - 3600, '/' );
    
            return ob_get_clean();
        } else {
            return "Payment method Not found or Order not created";
        }
    } else {
        return "Payment method Not found or Order not created";
    }

    
}

add_shortcode( 'gp_it_email', 'custom_email' );


// order detail
function custom_order_details() {
    
    // get order form cookies
    if ( isset( $_COOKIE['custom_order_id'] ) ){
        $order_id = intval( $_COOKIE['custom_order_id'] );
        $order = wc_get_order( $order_id );

        if ( $order ) {
            ob_start();
            ?>
<table class="styled-table">
    <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach( $order->get_items() as $item_id => $item ) : ?>
        <tr>
            <td><?php echo $item->get_name()  ?></td>
            <td><?php echo $item->get_quantity(); ?></td>
            <td><?php echo $order->get_item_total(). $order->get_currency();?>$</td>
            <td><?php echo wc_price( $item->get_total() ) . $order->get_currency();?></td>
        </tr>
        <?php endforeach;
        ?>
    </tbody>
</table>


<?php    
            // cookies remove
            setcookie( 'custom_order_id', '', time() - 3600, '/' );
    
            return ob_get_clean();
        } else {
            return "Payment method Not found or Order not created";
        }
    } else {
        return "Payment method Not found or Order not created";
    }

    
}

add_shortcode( 'gp_it_order_details', 'custom_order_details' );