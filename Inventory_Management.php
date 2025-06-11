<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
</head>
<body>
    <?php
    //declare variable dashses
    $dashes = 50;
    // simple do while loop to print out dashes to break up the page
    function print_dashes($dashes){
        do {
            echo"-";
            $dashes-=1;
        } while ($dashes>0);
        echo"<br>";
    }

    // declare inventory
    $inventory = [
        "Grape" => ["Name" => "grape", "Quantity"=> 300, "Price"=> 0.36], 
        "Apple" => ["Name" => "apple", "Quantity"=> 25, "Price"=> 0.93], 
        "Orange" => ["Name" => "orange", "Quantity"=> 65, "Price"=> 0.36]
    ];
    
    //print out a formatted inventory and calculate totals
    function display_inventory($inventory) {
        $grand_total = 0;
        echo "<br><strong> name - quantity - price - total </strong><br>";
        //use a for each loop to display each product in the inventory array
        foreach ($inventory as $name => $details) {
            $total = $details["Quantity"] * $details["Price"];
            echo "<br> $name - ". $details["Quantity"] . " - £" . number_format($details["Price"],2) . " - £" . number_format($total,2) . "<br>"; 
            $grand_total += $total;
        }
        echo "<br><strong>Grand Total:</strong> £" . number_format($grand_total,2) . "<br>"; 
    }
    


    // alter the quanity of apples 
    $delta_quanities = -19;
    $item_to_update = "Apple";
    //take inventory, change in quantities, and an item and then update that item in the inventory
    function update_quantities(&$inventory, $delta_quanities, $item_to_update) {
        if (array_key_exists($item_to_update, $inventory)) {
            $inventory[$item_to_update]['Quantity'] += $delta_quanities;
        } else {
            echo "Cannot find a product called $item_to_update.";
        }
    }



    //Low stock alert 
    $low_stock = 10;
    //perform a stock check
    function low_stock($inventory, $low_stock) {
        //by defualt do not display a warning
        $warning = 0;
        //check the stock of each item in the inventory
        foreach ($inventory as $name => $details) {
            //if the quantity is less than the low stock alert, inform the user and increasing the warning number
            if ($details["Quantity"] < $low_stock) {
                echo "<strong>Low stock alert</strong> on $name only " . $details['Quantity'] .  " remaining. <br>";
                $warning++;
            }
        }
        if ($warning == 0){ //if the warning number is still 0 after the loop inform user
            echo "<br>Stock check complete, adequate stock available on all items.<br>";
        } 
    }




    // Discount ammount
    $discount_ammount = 0.1; //10%

    //discount items in inventory
    function discount_items($inventory, $discount_ammount) {
        //set total to none
        $grand_total = 0;
        echo "prices have been discounted by " . $discount_ammount*100 . "%.<br>";
        echo "<br> name - quantity - price - total <br>";
        //recalculate the inventory with the discount and display it to the user
        foreach ($inventory as $name => $details) {
            $total = ($details["Quantity"] * $details["Price"])*(1-$discount_ammount);
            echo "<br> $name - ". $details["Quantity"] . " - £" . number_format($details["Price"],2) . " - £" . number_format($total,2) . "<br>"; 
            //increase the grand total by the total each run through
            $grand_total += $total;
        }
        //display the formatted grand total tot he user
        echo "<br>Discounted Grand Total: £" . number_format($grand_total,2); 
    }




    // Main programme
    echo "<h1> Welcome to the Inventory Management System</h1>";
    print_dashes($dashes);
    display_inventory($inventory);
    print_dashes($dashes);
    update_quantities($inventory, $delta_quanities, $item_to_update);
    echo "<br><br><h2>Stock updated.</h2>";
    print_dashes($dashes);
    display_inventory($inventory);
    echo "<br><br><h2>Reviewing stock</h2>";
    print_dashes($dashes);
    low_stock($inventory, $low_stock);
    echo "<br><h2>Sale</h2>";
    print_dashes($dashes);
    discount_items($inventory, $discount_ammount);


    ?>
</body>
</html>



