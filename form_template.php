<!DOCTYPE html>
<html>
<head>
    <title>XML Links Data</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" ></link>
</head>
<body>
    <h1>Udfyldelse af archiveIndex</h1>
    <form action="index.php" method="post">
        
        <?php foreach($fields as $field){ ?>
        
            <?php switch ($field['type']){ 
                 
                 case 'text': ?>
                    <div class="form-inline">
                        <label for="<?php echo $field['fieldName']; ?>"><?php echo $field['description']; ?></label>
                        <input name="<?php echo $field['fieldName']; ?>" value="<?php echo isset($field['value']) ? $field['value'] : ''; ?>" placeholder="<?php echo $field['description']; ?>" size="50" type="text">
                    </div>
                <?php break; ?>
                
                <?php case 'date': ?>
                    <div class="form-inline">
                        <label for="<?php echo $field['fieldName']; ?>"><?php echo $field['description']; ?></label>
                        <input name="<?php echo $field['fieldName']; ?>" value="<?php echo isset($field['value']) ? $field['value'] : ''; ?>" size="50" type="date">
                    </div>
                <?php break; ?>
                
                <?php case 'bool': ?>
                    <div class="form-inline">
                        <label class="radio-inline">
                            <?php echo $field['description']; ?>
                        </label>
                        <label class="radio-inline">
                            <input name="<?php echo $field['fieldName']; ?>" value="<?php echo $field['data'][0]['value']; ?>" <?php echo (isset($field['value']) && $field['value'] == $field['data'][0]['value']) ? 'checked' : '' ?> type="radio"><?php echo $field['data'][0]['description']; ?>
                        </label>
                        <label class="radio-inline">
                            <input name="<?php echo $field['fieldName']; ?>" value="<?php echo $field['data'][1]['value']; ?>" <?php echo (isset($field['value']) && $field['value'] == $field['data'][1]['value']) ? 'checked' : '' ?> type="radio"><?php echo $field['data'][1]['description']; ?>
                        </label>
                    </div>
                <?php break; ?>
                
                <?php case 'multiple': ?>
                <?php break; ?>       
                
                <?php default: ?>
                <p>other field</p>
                <?php var_dump($field); ?>
                <?php break; ?>
            
            <?php } ?>
        
        <?php } ?>

        <input name="create_xml" type="hidden" value="true">
        <input name="create" type="submit" value="Gem">
    </form>
</body>
</html>