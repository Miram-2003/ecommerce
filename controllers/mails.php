<?php
require_once("../controllers/product_controller.php");
require_once("../controllers/order_controller.php");

require '../vendor/autoload.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendOrderConfirmationEmail($customer_email, $customer_name, $order_id, $payment_method, $amount, $currency, $date, $date_de)
{
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                          // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to Gmail (or your SMTP provider)
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'miriamappiahnaayeye@gmail.com';         // SMTP username (your email address)
        $mail->Password   = 'sare mndm kspe xecz';                  // SMTP password (your email password or app password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
        $mail->Port       = 587;                                    // TCP port to connect to (Gmail uses 587)

        // Recipients
        $mail->setFrom('noreply@posify.com', 'POSiFy');  // Sender's email address and name
        $mail->addAddress($customer_email, $customer_name);          // Customer's email address and name

        //Generate order summary
        $order_summary = ''; // Initialize the order summary variable
        $items = get_order_items($order_id); 

        foreach ($items as $item) {
            $id = $item['product_id'];
            $product = getProductImageName($id);

            // Check if product details are available
            if (isset($product['img']) && isset($product['name'])) {
                // Add item to order summary
                $order_summary .= "<tr>
                    <td><img src='/product_images/{$product['img']}' alt='" . htmlspecialchars($product['name']) . "' style='max-width: 100px; height: auto;'></td>
                    <td>{$product['name']}</td>
                    <td>{$item['quantity']}</td>
                    <td>{$currency} {$item['price']}</td>
                </tr>";
            } else {
                // Debugging output if product details are missing
                echo "Missing product details for item: " . $item['product_id'];
            }
        }

        //Check if order summary was populated correctly
        echo "<pre>";
        print_r($order_summary); // Debug: Check the populated order summary
        echo "</pre>";

        // Set up the email content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Order Confirmation - Order #' . $order_id; // Subject of the email

        // HTML email body
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; }
                .email-container { width: 100%; max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 8px; }
                .email-header { background-color: #00b050; padding: 20px; color: #fff; text-align: center; border-radius: 8px 8px 0 0; }
                .email-header h2 { margin: 0; font-size: 24px; }
                .order-details { margin: 20px 0; }
                .order-details h3 { font-size: 18px; color: #00b050; }
                .order-details p { font-size: 16px; line-height: 1.5; }
                .order-details .highlight { font-weight: bold; color: #333; }
                .footer { font-size: 14px; color: #666; text-align: center; margin-top: 20px; }
                .footer a { color: #00b050; text-decoration: none; }
                .order-summary { background-color: #f4f4f4; padding: 10px; border-radius: 8px; margin-top: 20px; }
                .order-summary table { width: 100%; border-collapse: collapse; }
                .order-summary th, .order-summary td { padding: 10px; border: 1px solid #ddd; text-align: left; }
                .order-summary th { background-color: #f8f8f8; }
                .btn { background-color: #00b050; color: #fff; padding: 12px 20px; border-radius: 6px; text-decoration: none; }
                img { width: 50px; height: 50px; }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='email-header'>
                    <h2>Order Confirmation</h2>
                    <p>Thank you for shopping with us, {$customer_name}!</p>
                </div>
                
                <div class='order-details'>
                    <h3>Your Order Details</h3>
                    <p><span class='highlight'>Order ID:</span> #{$order_id}</p>
                    <p><span class='highlight'>Payment Method:</span> {$payment_method}</p>
                    <p><span class='highlight'>Amount Paid:</span> {$amount} {$currency}</p>
                    <p><span class='highlight'>Order Date:</span> {$date}</p>


                     <p><span class='highlight'>Your Order is being processed and will delivered on :</span> {$date_de}</p>

                     <p><span class='highlight'>You can cancel you order anytime</span></p>
                </div>
                <div class='footer'>
                    <p>For inquiries, please contact our support team at <a href='mailto:support@POSify.com'>support@POSify.com</a>.</p>
                    <p>Best regards,<br>Your Store Name</p>
                    <p><a href='https://yourstore.com'>Visit our store</a></p>
                </div>
            </div>
        </body>
        </html>";
                
                // <div class='order-summary'>
                //     <h3>Order Summary</h3>
                //     <table>
                //         <thead>
                //             <th>Item</th>
                //             <th>Quantity</th>
                //             <th>Price</th>
                //         </thead>
                        
                //         <tbody>";
                //             echo $order_summary;
            
                //         </tbody>

                //     </table>
                // </div>
    

        // Debugging: Check the final email body
     
        // Send the email
        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        // Handle error and return false
        echo "Error sending email: {$mail->ErrorInfo}";
        return false;
    }
}


function sendOrderNotificationToSeller($seller_email, $order_id, $customer_name, $payment_method, $amount, $currency, $date)
{
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                          // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to Gmail (or your SMTP provider)
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'miriamappiahnaayeye@gmai.com';                 // SMTP username (your email address)
        $mail->Password   = 'sare mndm kspe xecz';                  // SMTP password (your email password or app password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
        $mail->Port       = 587;                                    // TCP port to connect to (Gmail uses 587)

        //Recipients
        $mail->setFrom('noreplay@posify.com', 'Your Store Name');  // Sender's email address and name
        $mail->addAddress($seller_email, 'Seller Name');             // Seller's email address

        //Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'New Order - Order #' . $order_id;         // Subject of the email
        $mail->Body    = "
            <h3>New Order Notification</h3>
            <p>You have received a new order from <strong>{$customer_name}</strong>.</p>
            <p><strong>Order ID:</strong> {$order_id}</p>
            <p><strong>Payment Method:</strong> {$payment_method}</p>
            <p><strong>Total Amount:</strong> {$amount} {$currency}</p>
            <p><strong>Order Date:</strong> {$date}</p>
            <p>Please process the order and prepare it for shipping.</p>
            <footer>Best regards, <br>Your Store Name</footer>
        ";

        // Send the email
        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        // Handle error and return false
        echo "Error sending email: {$mail->ErrorInfo}";
        return false;
    }
}


function sendOrderConfirmationEmailCash($customer_email, $customer_name, $order_id, $payment_method, $amount, $currency, $date, $date_de)
{
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                          // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to Gmail (or your SMTP provider)
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'miriamappiahnaayeye@gmail.com';         // SMTP username (your email address)
        $mail->Password   = 'sare mndm kspe xecz';                  // SMTP password (your email password or app password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
        $mail->Port       = 587;                                    // TCP port to connect to (Gmail uses 587)

        // Recipients
        $mail->setFrom('noreply@posify.com', 'POSiFy');  // Sender's email address and name
        $mail->addAddress($customer_email, $customer_name);          // Customer's email address and name


        // Set up the email content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Order Confirmation - Order #' . $order_id; // Subject of the email

        // HTML email body
        $mail->Body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333; }
                .email-container { width: 100%; max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 8px; }
                .email-header { background-color: #00b050; padding: 20px; color: #fff; text-align: center; border-radius: 8px 8px 0 0; }
                .email-header h2 { margin: 0; font-size: 24px; }
                .order-details { margin: 20px 0; }
                .order-details h3 { font-size: 18px; color: #00b050; }
                .order-details p { font-size: 16px; line-height: 1.5; }
                .order-details .highlight { font-weight: bold; color: #333; }
                .footer { font-size: 14px; color: #666; text-align: center; margin-top: 20px; }
                .footer a { color: #00b050; text-decoration: none; }
                .order-summary { background-color: #f4f4f4; padding: 10px; border-radius: 8px; margin-top: 20px; }
                .order-summary table { width: 100%; border-collapse: collapse; }
                .order-summary th, .order-summary td { padding: 10px; border: 1px solid #ddd; text-align: left; }
                .order-summary th { background-color: #f8f8f8; }
                .btn { background-color: #00b050; color: #fff; padding: 12px 20px; border-radius: 6px; text-decoration: none; }
                img { width: 50px; height: 50px; }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <div class='email-header'>
                    <h2>Order Confirmation</h2>
                    <p>Thank you for shopping with us, {$customer_name}!</p>
                </div>
                
                <div class='order-details'>
                    <h3>Your Order Details</h3>
                    <p><span class='highlight'>Order ID:</span> #{$order_id}</p>
                    <p><span class='highlight'>Payment Method:</span> {$payment_method}</p>
                    <p><span class='highlight'>Amount to be  Paid:</span> {$amount} {$currency}</p>
                    <p><span class='highlight'>Order Date:</span> {$date}</p>


                     <p><span class='highlight'>Your Order is being and will delivered :</span> {$date_de}</p>

                     <p><span class='highlight'>You can cancel you order anytime</span></p>
                </div>
                <div class='footer'>
                    <p>For inquiries, please contact our support team at <a href='mailto:support@POSify.com'>support@POSify.com</a>.</p>
                    <p>Best regards,<br>Your Store Name</p>
                    <p><a href='https://yourstore.com'>Visit our store</a></p>
                </div>
            </div>
        </body>
        </html>";
                
               
     
        // Send the email
        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        // Handle error and return false
        echo "Error sending email: {$mail->ErrorInfo}";
        return false;
    }
}


?>