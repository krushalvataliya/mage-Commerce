<?php
/**
 * 
 */


class Ccc_Practice_Adminhtml_CsvtController 
{
    protected $_categoryFile = 'C:\Users\a\Downloads\CATEGORY.csv';
    protected $_file = 'C:\Users\a\Downloads\ATTRIBUTE-OPTIONS.csv';
    protected $_data = array();
    
    public function execute()
    {
        $categoryCsvFile = 'C:\Users\a\Downloads\CATEGORY.csv';
        $attributeOptionCsvFile = 'C:\Users\a\Downloads\ATTRIBUTE-OPTIONS.csv';
        $outputCsvFile = 'C:\Users\a\Downloads\category-attribute-option.csv';

        // Read the category CSV file and store the data in an array
        $categoryData = $this->readCsvFile($categoryCsvFile);

        // Read the attribute option CSV file and store the data in an array
        $attributeOptionData = $this->readCsvFile($attributeOptionCsvFile);

        // Process the data and generate the final category-attribute-option CSV file
        $finalData = $this->generateFinalData($categoryData, $attributeOptionData);
        $this->generateCsvFile($outputCsvFile, $finalData);

    }

    private function readCsvFile($csvFile)
    {
       $handler = fopen($this->_categoryFile, "r");
        if($handler)
        {
            $rowCnt = 0;
            while($row = fgetcsv($handler, 4096, ",", "\""))
            {
                if(!$this->_categoryHeader)
                {
                    $this->_categoryHeader = $row;
                }
                else
                {
                    $row = array_combine($this->_categoryHeader, $row);
                    $this->_categoryData[$row["category"]][] = $row["attribute_code"];
                }
            }    
            fclose($handler);
        }
        else
        {
            throw new Exception("Unable to open file");     
        }
        
        $handler = fopen($this->_file, "r");
        if($handler)
        {
            $rowCnt = 0;
            while($row = fgetcsv($handler, 4096, ",", "\""))
            {
                if(!$this->_header)
                {
                    $this->_header = $row;
                }
                else
                {
                    $row = array_combine($this->_header, $row);
                    $this->_data[$row["attribute_code"]][] = $row["option"];
                }
            }    
            fclose($handler);
        }
        else
        {
            throw new Exception("Unable to open file");     
        }
        
    }

    private function generateFinalData($categoryData, $attributeOptionData)
    {
       echo "<pre>";
       print_r($categoryData);
        // return $finalData;
    }

    private function generateCsvFile($csvFile, $data)
    {
        $handle = fopen($csvFile, 'w');
        foreach ($data as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);
    }
}

$obj = new Ccc_Practice_Adminhtml_CsvtController();
$obj->execute();