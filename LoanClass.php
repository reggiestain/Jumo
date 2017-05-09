<?php

/**
 * Description of LoanClass
 *
 * @author Reginald Bossman
 */
class LoanClass {

    private $file;

    function __construct() {
        $this->file = isset($_POST['file']) ? $_POST['file'] : null;
    }

    //Check if uploaded file is .csv
    public function checkFile() {

        $type = explode(".", $this->file);

        if (strtolower(end($type)) == 'csv') {
            $this->getcsv();
        } else {
            session_start();
            $_SESSION["message"] = "<h3 style='color:red'>Please upload a valid CSV file.</h3>";
            header("Location:index.php");
        }
    }

    //Get Load.csv file and loop through to get number of rows and sum the amount column
    private function getcsv() {
        $amount = 0;
        $row = 0;
        if (($handle = fopen($this->file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = $row;
                $row++;
                $amount+=$data[4];
            }
        }

        $list = array("Count,Amount", "$num,$amount",);
        $this->outputcsv($list);
    }

    //Return array and create Output.csv
    private function outputcsv($list) {
        $file = fopen("Output.csv", "w");

        foreach ($list as $line) {
            fputcsv($file, explode(',', $line));
        }

        if(fclose($file)){
            session_start();
            $_SESSION["message"] = "<h3 style='color:green'>Output.csv has been updated successfully.</h3>";
            header("Location:index.php");
        }
    }
}

//Get an instance of this class
$class = new LoanClass();

//Check if form is post
if (!empty($_POST)) {
    $class->checkFile();
}
