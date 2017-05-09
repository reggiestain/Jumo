<!DOCTYPE html>
<html>
    <head>
        <title>JUMO CSV File Upload</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div style="text-align:center; margin-top: 200px">
            <form action="LoanClass.php" method="post">
                Select CSV file to upload:
                <input type="file" name="file" id="fileToUpload">
                <input type="submit" value="Upload File" name="submit">
            </form>        
        </div>
    </body>
</html>