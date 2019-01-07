<?php
include 'SecureSession.php';
?>

<div class="col-md-10 ">
    <div class="blockCombox">
        <span class="titrePage">Importation format csv des étudiants</span>
        <div class="row">
            <form action="index.php?include=insertionEleve" method="post" class="formImport" name="formImport" id="formImport">
                 <input  name="file" id="date" type="file" accept=".csv"/>
                <input type="submit" value="Importer" class="btn valid"/>
            </form>
        </div>
    </div>
</div>


