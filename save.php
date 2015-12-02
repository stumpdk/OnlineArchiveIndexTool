<?php

function orgCode(){
    if (isset($_POST['create_xml'])) {
        echo "Links Data Posted";
        /* All Links data from the form is now being stored in variables in string format */
        $urlDoc           = $_POST['urlDoc'];
        $urlAdd           = $_POST['urlAdd'];
        $urlDes           = $_POST['urlDes'];
        $xmlBeg           = "<?xml version='1.0' encoding='ISO-8859-1'?>";
        $rootELementStart = "<$urlDoc>";
        $rootElementEnd   = "</$urlDoc>";
        $xml_document     = $xmlBeg;
        $xml_document .= $rootELementStart;
        $xml_document .= "<site>";
        $xml_document .= $urlAdd;
        $xml_document .= "</site>";
        $xml_document .= "<description>";
        $xml_document .= $urlDes;
        $xml_document .= "</description>";
        $xml_document .= $rootElementEnd;
        $path_dir = "xmlf/";
        $path_dir .= $urlDoc . ".xml";
        /* Data in Variables ready to be written to an XML file */
        $fp    = fopen($path_dir, 'w');
        $write = fwrite($fp, $xml_document);
        /* Loading the created XML file to check contents */
        $sites = simplexml_load_file("$path_dir");
        echo "<br> Checking the loaded file <br>" . $path_dir . "<br>";
        echo "<br><br>Whats inside loaded XML file?<br>";
        print_r($sites);
    }
}

function createXMLFile()
{
    if (isset($_POST['create_xml'])) {
        echo "Links Data Posted";
        
        $xml_document = writeXMLString($fields);
        
        $path_dir = "xmlf/";
        $path_dir .= 'filename' . ".xml";
        /* Data in Variables ready to be written to an XML file */
        $fp    = fopen($path_dir, 'w');
        $write = fwrite($fp, $xml_document);
        /* Loading the created XML file to check contents */
        $sites = simplexml_load_file($path_dir);
        echo "<br> Checking the loaded file <br>" . $path_dir . "<br>";
        echo "<br><br>Whats inside loaded XML file?<br>";
        print_r($sites);
    }
}

function writeXMLString($fields)
{
    $xmlBeg           = "<?xml version='1.0' encoding='ISO-8859-1'?>";
    $rootELementStart = "<archiveIndex>";
    $rootElementEnd   = "</archiveIndex>";
    
    $xml_document   = '';
    $xml_document   .= $xmlBeg;
    $xml_document   .= $rootELementStart;
    
    foreach($fields as $field){
        if(hasData($field['fieldName'])){
            $xml_document .= '<' .$field['fieldName'] . '>';
            $xml_document .= $_POST[$field['fieldName']];
            $xml_document .= '</' . $_POST[$field['fieldName']] . '>';
        }
    }
    
    $xml_document   .= $rootElementEnd;
}

function validate($fields)
{
    foreach($fields as $field){
        if($field['required'] == true && hasData($field['fieldName']))
        {
            return false;
        }
        else if(is_array ($field['required'])){
            foreach($field['required'] as $requiredField){
                if(!hasData($requiredField))
                    return false;
            }
        }
    }
    
    return true;
}

function hasData($fieldName)
{
    return str_len(trim($_POST[$fieldName])) !== 0;
}

?>