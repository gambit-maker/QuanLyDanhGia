<?php
if (isset($_POST["submit"])) {
    $file = $_FILES["fileName"]['name'];

    $target_dir = 'page\admin\insert\dataImport\\'; // full path
    // $target_dir = 'page/admin/insert/dataImport/'; // full path

    $target_file = $target_dir . basename($file);

    move_uploaded_file($_FILES['fileName']['tmp_name'], $target_file);

    $myFile = fopen($target_file, 'r');
    $f = file($target_file);
    // while ($line = fgets($myFile)) {
    //     echo $line . "<br>";
    // }
    fclose($myFile);
}
?>

<form action="" enctype="multipart/form-data" method="POST">
    <div class="d-flex align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <input required class="btn btn-sm btn-outline-secondary" type="file" name="fileName" accept=".txt">
                <input type="submit" name="submit" value="Import">
            </div>
        </div>
    </div>
</form>

<!-- <form action="" method="POST">
    <div class="d-flex flex-row-reverse align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" name="submit" class="btn btn-sm btn-outline-secondary">Import</button>

                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
        </div>
    </div>
</form> -->