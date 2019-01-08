<?php
include 'SecureSession.php';
?>

<div class="col-md-10 ">
    <div class="blockCombox">
        <span class="titrePage">Importation format ics (filière par filière)</span>
        <div class="row">
            <form enctype="multipart/form-data" action="index.php?include=insertionPlan" method="post" class="formImport" name="formImport" id="formImport">
                 <input  name="fileICS" id="date" type="file" accept=".ics"/>
                 <input type="submit" value="Importer" class="btn valid"/>
            </form>
        </div>
    </div>
</div>
