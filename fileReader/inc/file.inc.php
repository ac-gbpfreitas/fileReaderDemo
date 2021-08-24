<?php
	//Function that will read the upload file from the user
	#Parameter: Temporary FilePath
	#Return: A String
	function readFile_gfr_91($file) {

		try{
			//Opens the file to read
			$fileHandle = fopen($file,'r');
			if(!$fileHandle){
				throw new Exception("Erro Reading the file: $file");
			}
			//Extract all the data as a huge string, from the file
			$fileContent = fread($fileHandle,filesize($file));
			//*IMPORTANT* Close the file
			fclose($fileHandle);
		} catch (Exception $ex) {
			echo $ex->getMessage();
		}
		//Return the file content as a String
		return $fileContent;
	}

	//Create a new File with uploaded file.
	//New Data included (Price = QT*Cost)
	#Paramenter: Receipt Array(Item,Description,Cost,Quantity)
	function createNewFile_gfr_91($receipt) {
		//Generate a String with (Item,Description,Cost,Quantity,Price)
		$outputReceipt = generateReceipt_gfr_91($receipt);

		try{
			//Open the file to write
			$fileHandle = fopen(DATA_FILE_OUTPUT,'w');
			if(!$fileHandle){
				throw new Exception("Error writing the file: DATA_FILE_OUTPUT");
			}
			//Write the String inside the file
			fwrite($fileHandle, $outputReceipt);
			//*IMPORTANT* Close the file
			fclose($fileHandle);		

		} catch (Exception $ex) {
			echo $ex->getMessage();
		}
	}

	//Validates the uploaded file
	#Return: An Array of String - string[]
	function validateFile_gfr_91()  {
		//Create an array with errors
		$errors = array();

		//If the button upload was click with no file uploaded
		if (empty($_FILES['receiptFile']['name'])) {
			
			$message = "There are no files available! Please select a file to upload!";
			$errors[] = $message;
		
		//If there is file uploaded
		} elseif (!empty($_FILES['receiptFile']['name'])) {
			$fileName = explode(".",$_FILES['receiptFile']['name']);
			$fileType = $fileName[count($fileName)-1];

			//But the uploaded file was not a csv
			if ($fileType != "csv") {
				$message = "The file is not CSV type! Please, select another file!";
				$errors[] = $message;
			}
		}
		//Return the array of errors : String
		return $errors;
	}