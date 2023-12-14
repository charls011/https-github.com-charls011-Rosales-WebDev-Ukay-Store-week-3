<link rel="stylesheet" href="styles.css">
<?php
        function displayOrderSummary() {
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            echo "<div class = 'container'>";
            echo "<h2>📝 Order Summary</h2>";
            
            $Clothe_prices = [
                "Trousers" => 350.00,
                "T-shirts" => 150.00,
                "Shorts" => 120.00,
                "Jackets" => 200.00,
                "Jeans" => 250.00,
            ];

            $Size_prices = [
                "Small" => 0.00,
                "Medium" => 0.00,
                "Large" => 0.00,
                "Extra Large" => 50.00,
                "Double Extra Large" => 50.00,
            ];

            $Location_prices = [
                "Luzon"     => 50,
                "Visayas"   => 100,
                "Mindanao"  => 150,
            ];

            $Clothe_type = $_POST["Clothe"];
            $Size = $_POST["Size"];
            $Location = $_POST["Location"];
            $Name = $_POST["Name"];
            $Notes = $_POST["Notes"];
            
            // Calculate the total price
            $Total_price = $Clothe_prices[$Clothe_type] + $Size_prices[$Size] + $Location_prices[$Location];
           
            // Display the detailed order information
            displayOrderDetails($Name,$Clothe_type,$Clothe_prices,$Size,$Size_prices, $Location,$Location_prices,$Total_price,$Notes);
           
            // Generate the receipt content based on the order details
            $receiptContent = generateReceiptContent($Name, $Clothe_type, $Clothe_prices, $Size, $Size_prices, $Location, $Location_prices, $Total_price, $Notes);

            // Save the receipt content to a text file
            saveReceiptToFile($receiptContent);
            
            echo "</div>";
    }
         }  
           function displayOrderDetails($Name,$Clothe_type,$Clothe_prices,$Size,$Size_prices, $Location,$Location_prices,$Total_price,$Notes) { 
        // Start the order summary table
             echo "<table>";

             echo "<tr><td>Name</td><td>" . htmlspecialchars($Name) . "</td></tr>";

            
             echo "<tr><td>clothe type</td><td>" . htmlspecialchars($Clothe_type) . " (₱" . number_format($Clothe_prices[$Clothe_type], 2) . ")</td></tr>";

            
             echo "<tr><td>size</td><td>" . htmlspecialchars($Size) . " (₱" . number_format($Size_prices[$Size], 2) . ")</td></tr>";
             
             echo "<tr><td>location</td><td>" . htmlspecialchars($Location) . " (₱" . number_format($Location_prices[$Location], 2) . ")</td></tr>";

            
             echo "<tr><td>Total Price</td><td>₱" . number_format($Total_price, 2) . "</td></tr>";
             
             echo "<tr><td>notes</td><td>" . htmlspecialchars($Notes) . "</td></tr>";
             
             echo "</table>";
        
             
        }
        
             function generateReceiptContent ($Name, $Clothe_type, $Clothe_prices, $Size, $Size_prices, $Location, $Location_prices, $Total_price, $Notes){
                
                // Initialize the receipt content with a title and separator
             $receiptContent = "Order Summary\n";
             $receiptContent .= "-----------------\n";
             
             // Add customer name to the receipt content
             $receiptContent .= "Name: " . $Name . "\n";
             
             // Add clothe type with its price to the receipt content
             $receiptContent .= "Clothe Type: " . $Clothe_type . " (₱" . number_format($Clothe_prices[$Clothe_type], 2) . ")\n";
              
             // Add clothe size with its price to the receipt content
             $receiptContent .= "Size: " . $Size . " (₱" . number_format($Size_prices[$Size], 2) . ")\n";
   
             // Add the total price to the receipt content
             $receiptContent .= "Total Price: ₱" . number_format($Total_price, 2) . "\n";

             // Add any notes to the receipt content
             $receiptContent .= "notes: " . $Notes . "\n";

             // Add a thank you message to the receipt content
             $receiptContent .= "\n";
             $receiptContent .= "Thank you for your order!";

             // Return the complete receipt content
             return $receiptContent;
         }

         function saveReceiptToFile($receiptContent){
            // Open a file for writing. If the file does not exist, it will be created.
            // If the file cannot be opened, display an error message and terminate the script.
            $file = fopen("Ukay Shop Order Summary.txt", "w") or die("Unable to open file!");
    
            // Write the receipt content to the file.
            fwrite($file, $receiptContent);
    
            // Close the file after writing is complete.
            fclose($file);
    
            // Display a success message indicating that the receipt was created.
            echo "<br> Receipt created successfully as Ukay Shop Order Summary.txt!";
        }
            // Call the displayOrderSummary function
            displayOrderSummary();
        
        
            // End the order summary table
            
            


            ?>
