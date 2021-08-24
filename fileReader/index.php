<?php
	require_once("inc/config.inc.php");
	require_once("inc/file.inc.php");
	require_once("inc/receipt.inc.php");
	require_once("inc/html.inc.php");

	htmlHeader_gfr_91();
	
	if(!empty($_FILES)) {
		$errors = validateFile_gfr_91();

		if (empty($errors)) {
			$fileContent = readFile_gfr_91($_FILES['receiptFile']['tmp_name']);
			//Generate the receipt and Create a new file with new data (price)
			$receipt = receiptArray_gfr_91($fileContent);
    	}
	}
	

	//If the files is empty or errors exist
    if (!empty($_FILES) && !empty($errors))  {
		//Show the errors
		htmlErrors_gfr_91($errors);
		//show the upload form
		htmlFormFile_gfr_91();

    } else if (!empty($_FILES) && empty($errors))   {
		//Write in the new File
		createNewFile_gfr_91($receipt);
        //Read from the File
		tableReceipt_gfr_91($receipt);

    } else {
        htmlFormFile_gfr_91();
	}
	
	htmlFooter_gfr_91();
?>