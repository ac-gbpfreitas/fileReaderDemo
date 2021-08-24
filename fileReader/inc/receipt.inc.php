<?php

	//Generate an array of strings. Each line is an Item data
	#Parameter : The huge string extracted from the file
	#Return: Array of items
	function receiptArray_gfr_91($fileContent) {
		$receipt = array();

		//Generates an array of Strings. Each line will be a slot in the array
		$itemLine = explode("\n",$fileContent);
		
		//Startin by 1 (as the first line is the file header)
		for($i=1;$i<count($itemLine);$i++) {
			//Each array slot is a string with data about an unique item
			//Generate an array with each data from that unique item
			$itemAttributes = explode(",",$itemLine[$i]);
			try{
				//If there are more or less data than expected
				if(count($itemAttributes) != 4) {
					//There is an error
					throw new exception("Invalid number of columns on line: ".$i."\n");
				} else { //*Generate a new element (Price)*
					//Verify if the attribute is NOT numeric
					if (!is_numeric($itemAttributes[2])){
						//1 - Extract only the numbers from cost "slot"
						$price = explode("$",$itemAttributes[2]);
						
						//If the second slot it is not a number
						if(!is_numeric($price[1])){
							throw new exception("Invalid cost data on line: ".$i."\n");
						}
						//2 - Assign the cost slot with a float (It was string, before)
						//2 - Due to '$' sign
						$itemAttributes[2] = $price[1];
					} else {
						//There is an error
						throw new exception("Invalid cost data on line: ".$i."\n");
					}

					//Verify if the attribute is numeric
					if(is_numeric($itemAttributes[3])){
						//3 - The totalPrice = price * quantity
						$totalPrice = $price[1]*$itemAttributes[3];
					} else {
						//There is an error
						throw new exception("Invalid quantity data on line: ".$i."\n");
					}
					//4 - Allocate a new slot in the item array (Price)
					$itemAttributes[] = $totalPrice;
					//5 - Insert the data in the receipt array
					$receipt[] = $itemAttributes;
				}
			} catch (Exception $ex) {
				echo $ex->getMessage();
			}
		}
		//Return the Receipt array
		//Each slot it is another array with unique data from each receipt item
		return $receipt;
	}

	//Generate the output data from the receipt (String)
	#Parameter: The Array Receipt (with 5 elements)
	#Return: String
	function generateReceipt_gfr_91($receipt){
		//Create the first line (file header)
		$outputReceipt = "id,item,cost,quantity,price\n";
		//Every single slot from the receipt will become a hu
		for($i=0;$i<count($receipt);$i++){
			//If it is the last element of the array
			if($i == count($receipt)-1) {
				$outputReceipt .= $receipt[$i][0].",";
				$outputReceipt .= $receipt[$i][1].",";
				$outputReceipt .= $receipt[$i][2].",";
				$outputReceipt .= $receipt[$i][3].",";
				$outputReceipt .= $receipt[$i][4];
			//If it is not the last element of the array
			} else {
				$outputReceipt .= $receipt[$i][0].",";
				$outputReceipt .= $receipt[$i][1].",";
				$outputReceipt .= $receipt[$i][2].",";
				$outputReceipt .= $receipt[$i][3].",";
				$outputReceipt .= $receipt[$i][4]."\n";
			}
		}
		//Return a huge string
		return $outputReceipt;
	}