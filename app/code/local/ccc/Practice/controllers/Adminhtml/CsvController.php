<?php
/**
 * 
 */

class Ccc_Practice_Adminhtml_CsvController 
{
    protected $_data = array();
    protected $_header = array();
    
    protected $_categoryData = array();
    protected $_categoryHeader = array();
    
    protected $_dataFinal = array();
    
    protected $_categoryFile = 'C:\Users\a\Downloads\CATEGORY.csv';
    protected $_file = 'C:\Users\a\Downloads\ATTRIBUTE-OPTIONS.csv';
    protected $_fileReport = 'C:\Users\a\Downloads\report.csv';
        
    protected function _loadFile()
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
                    $this->_categoryData[] = $row;
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
                    $attribute = $row['ATTRIBUTE'];
                    $option = $row['OPTION'];
                    if(!array_key_exists($attribute, $this->_data))
                    {
                        $this->_data[$attribute] = array();
                    }
                    $this->_data[$attribute][] = $option;
                }
            }    
            fclose($handler);
        }
        else
        {
            throw new Exception("Unable to open file");     
        }
        
    }
    
    public function run()
    {   
        echo "<pre>"; 
        $this->_loadFile();
        $this->_formatData();
        $this->_generateReport();
        
        echo "DONE";
        
    }
    
    protected function _formatData()
    {
        if(!$this->_data)
        {
            throw new Exception("Data is not available");
        }
        
        if(!$this->_categoryData)
        {
            throw new Exception("Category data is not available");
        }
        $categoryData = array_unique(array_column($this->_categoryData,'CATEGORY'));

        // $this->_data = array_unique($this->_data);
            print_r($this->_data);die;
        $index = 1;
        foreach($categoryData as $_category)
        {
            foreach($this->_data as $attr =>$data)
            {
                $data = array_unique($data);
                foreach ($data as $option) {
                $output = array(
                    'index' => $index,
                    'category' => $_category,
                    'attribute' => $attr,
                    'option' => $option,
                 );
                $this->_dataFinal[] = $output; 
                $index ++;
                }
            }
        }
    }
    
    protected function _generateReport()
    {   
        if($this->_dataFinal)
        {
            $handler = fopen($this->_fileReport, "a"); 
            
            if($handler)
            {   
                $cnt = 0;
                foreach($this->_dataFinal as $key => $_data)
                {
                    if($cnt==0)
                    {
                        fputcsv($handler, array_keys($_data), ",", "\"");
                        $cnt++;
                    }
                    
                    fputcsv($handler, $_data, ",", "\"");
                }
                
                fclose($handler);
            }
            else
            {
                throw new Exception("Unable to open file to write");     
            }
        }
    }    

    public function getDataFinal()
    {
        return $this->_dataFinal;
    }

    public function getData()
    {
        return $this->_data;
    }
}

$obj = new Ccc_Practice_Adminhtml_CsvController();
$obj->run();
die;
print_r($obj->getData());die;
print_r($obj->getDataFinal());die;
