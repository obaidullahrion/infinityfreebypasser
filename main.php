<?php


if (isset($_POST['merge'])) {

    $outputFile = "merged.zip";

    $inputFiles = $_POST['files'] ?? [];



    if (empty($inputFiles)) {

        echo "<script>alert('No files selected for merging!');</script>";

    } else {

        $out = fopen($outputFile, "wb");

        foreach ($inputFiles as $file) {

            $in = fopen($file, "rb");

            while (!feof($in)) {

                fwrite($out, fread($in, 8192));

            }

            fclose($in);

        }

        fclose($out);

        echo "<script>alert('Files merged successfully!');</script>";

    }

}



if (isset($_POST['extract'])) {

    $zip = new ZipArchive;

    if ($zip->open('merged.zip') === TRUE) {

        $zip->extractTo('./');

        $zip->close();

        echo "<script>alert('Extraction successful!');</script>";

    } else {

        echo "<script>alert('Extraction failed!');</script>";

    }

}



$files = array_diff(scandir(__DIR__), array('..', '.', 'file_manager.php'));

?>



<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>File Manager</title>

    <style>

        body { font-family: Arial, sans-serif; margin: 20px; }

        table { width: 100%; border-collapse: collapse; margin-top: 10px; }

        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }

        th { background-color: #f2f2f2; }

        button { padding: 10px; margin-top: 10px; cursor: pointer; }

    </style>

</head>

<body>

    <h2>File Manager- ob infinityfree bypass </h2>


    <form method="post">

        <table>

            <tr>

                <th>Select</th>

                <th>Filename</th>

            </tr>

            <?php foreach ($files as $file): ?>

                <tr>

                    <td><input type="checkbox" name="files[]" value="<?php echo $file; ?>"></td>

                    <td><?php echo $file; ?></td>

                </tr>

            <?php endforeach; ?>

        </table>

        <button type="submit" name="merge">Merge Selected Files</button>

    </form>

    <form method="post">

        <button type="submit" name="extract">Extract Merged ZIP</button>

    </form>
    <p>developer:</p><a href = 'github.com/obaidullahrion'> @obaidullahrion</a>
</body>

</html>

