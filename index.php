<?php
//Array of fields. Format: fieldName (as in the XML), description, type (text, date, boolean, if boolean, an array of two values), required (true, false, or, if required because of another field, the field name)

$fields = [
    ['fieldName' => 'archiveInformationPackageID', 'description' => 'AVID', 'type' => 'text', 'required' => true, 'count' => 1],
    ['fieldName' => 'archiveInformationPackageIDPrevious', 'description' => 'Tidligere aflevering', 'type' => 'text', 'required' => true, 'count' => 1],
    ['fieldName' => 'archivePeriodStart', 'description' => 'Startdato', 'type' => 'date', 'required' => true, 'count' => 1],
    ['fieldName' => 'archivePeriodEnd', 'description' => 'Slutdato', 'type' => 'date', 'required' => true, 'count' => 1],
    ['fieldName' => 'archiveInformationPacketType', 'description' => 'Slutaflevering', 'type' => 'bool', 'data'=> [['value'=> 'true', 'description' => 'Ja'],['value'=> 'false', 'description' => 'Nej']], 'required' => true, 'count' => 1],
   
    ['fieldName' => 'archiveType', 'description' => 'Afleveringstype', 'type' => 'bool', 'data'=> [['value'=> 'true', 'description' => 'Afsluttet periode'],['value'=> 'false', 'description' => 'Øjebliksbillede']], 'required' => true, 'count' => 1],        
    ['fieldName' => 'systemName', 'description' => '', 'type' => 'text', 'required' => true, 'count' => 1],
    ['fieldName' => 'alternativeName', 'description' => '', 'type' => 'text', 'required' => false, 'count' => 'm'],
    ['fieldName' => 'systemPurpose', 'description' => '', 'type' => 'text', 'required' => true, 'count' => 1],
    ['fieldName' => 'systemContent', 'description' => '', 'type' => 'text', 'required' => true, 'count' => 1],
    
    ['fieldName' => 'regionNum', 'description' => '', 'type' => 'bool', 'data'=> [['value'=> 'true', 'description' => 'Ja'],['value'=> 'false', 'description' => 'Nej']], 'required' => true, 'count' => 1],
    ['fieldName' => 'komNum', 'description' => '', 'type' => 'bool', 'data'=> [['value'=> 'true', 'description' => 'Ja'],['value'=> 'false', 'description' => 'Nej']], 'required' => true, 'count' => 1],
    ['fieldName' => 'cprNum', 'description' => '', 'type' => 'bool', 'data'=> [['value'=> 'true', 'description' => 'Ja'],['value'=> 'false', 'description' => 'Nej']], 'required' => true, 'count' => 1],
    ['fieldName' => 'matrikNum', 'description' => '', 'type' => 'bool', 'data'=> [['value'=> 'true', 'description' => 'Ja'],['value'=> 'false', 'description' => 'Nej']], 'required' => true, 'count' => 1],
    ['fieldName' => 'bbrNum', 'description' => '', 'type' => 'bool', 'data'=> [['value'=> 'true', 'description' => 'Ja'],['value'=> 'false', 'description' => 'Nej']], 'required' => true, 'count' => 1],
    ['fieldName' => 'whoSygKod', 'description' => '', 'type' => 'bool', 'data'=> [['value'=> 'true', 'description' => 'Ja'],['value'=> 'false', 'description' => 'Nej']], 'required' => true, 'count' => 1],
    
    ['fieldName' => 'sourceName', 'description' => '', 'type' => 'text', 'required' => ['multipleDataCollection'], 'count' => 'm'],
    ['fieldName' => 'userName', 'description' => '', 'type' => 'text', 'required' => false, 'count' => 'm'],
    ['fieldName' => 'predecessorName', 'description' => '', 'type' => 'text', 'required' => false, 'count' => 'm'],
    ['fieldName' => 'containsDigitalDocuments', 'description' => '', 'type' => 'bool', 'data'=> [['value'=> 'true', 'description' => 'Ja'],['value'=> 'false', 'description' => 'Nej']], 'required' => true, 'count' => 1],
    ['fieldName' => 'searchRelatedOtherRecords', 'description' => '', 'type' => 'bool', 'data'=> [['value'=> 'true', 'description' => 'Ja'],['value'=> 'false', 'description' => 'Nej']], 'required' => true, 'count' => 1],
    
    ['fieldName' => 'relatedRecordsName', 'description' => '', 'type' => 'text', 'required' => ['searchRelatedOtherRecords'], 'count' => 'm'],
    ['fieldName' => 'systemFileConcept', 'description' => '', 'type' => 'bool', 'data'=> [['value'=> 'true', 'description' => 'Ja'],['value'=> 'false', 'description' => 'Nej']], 'required' => true, 'count' => 1],
    
    ['fieldName' => 'multipleDataCollection', 'description' => '', 'type' => 'bool', 'data'=> [['value'=> 'true', 'description' => 'Ja'],['value'=> 'false', 'description' => 'Nej']], 'required' => true, 'count' => 1],
    
    ['fieldName' => 'personalDataRestrictedInfo', 'description' => '', 'type' => 'text', 'required' => true, 'count' => 1],
    ['fieldName' => 'otherAccessTypeRestrictions', 'description' => '', 'type' => 'text', 'required' => true, 'count' => 1],
    ['fieldName' => 'archiveApproval', 'description' => '', 'type' => 'text', 'required' => true, 'count' => 1],
    ['fieldName' => 'archiveRestrictions', 'description' => '', 'type' => 'text', 'required' => false, 'count' => 1]
];




if(isset($_POST['create_xml'])){
    createXMLFile($fields); 
}
else{
    if(isset($_GET['avid'])){
        $fields = parseXMLGetValues('xmlf/' . $_GET['avid'] . '.xml', $fields);
    }
    require_once ('form_template.php');    
}

function createXMLFile($fields)
{
    echo "Saves XML...";
    
    $xml_document = writeXMLString($fields);
    
    $path_dir = "xmlf/";
    $path_dir .= $_POST['archiveInformationPackageID'] . ".xml";
    if(file_exists($path_dir))
        unlink($path_dir);
    /* Data in Variables ready to be written to an XML file */
    $fp    = fopen($path_dir, 'w');
    $write = fwrite($fp, $xml_document);
    /* Loading the created XML file to check contents */
    $sites = simplexml_load_file($path_dir);
    echo "<br> Checking the loaded file <br>" . $path_dir . "<br>";
    echo "<br><br>Whats inside loaded XML file?<br>";
    print_r($sites);
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
        $xml_document .= '<' .$field['fieldName'] . '>';
        
        if(hasData($field['fieldName'])){
            $xml_document .= $_POST[$field['fieldName']];
        }
        
        $xml_document .= '</' . $field['fieldName'] . '>';
    }
    
    $xml_document   .= $rootElementEnd;
    
    return $xml_document;
}

function parseXMLGetValues($path, $fields)
{
    $sites = simplexml_load_file($path);
    
    foreach($sites as $key => $value)
    {
        $fields = setValue($key, $value, $fields);
    }
    
    return $fields;
}

function setValue($fieldName, $value, $fields)
{
    for($i = 0; $i < count($fields); $i++)
    {
        if($fields[$i]['fieldName'] == $fieldName){
            $fields[$i]['value'] = $value;
            break;
        }
    }
    
    return $fields;
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
    return strlen(trim($_POST[$fieldName])) !== 0;
}

?>