<!DOCTYPE html>
<html lang="en">

<?php
include '../framework/bootstrap.php';
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>

<body>
    <div class="container" id="content">
        <button type="button" class="btn btn-primary" onclick="loadProduct()">Load Product</button>
        <button type="button" class="btn btn-primary" onclick="loadProductWithId()">Load Product With Id</button>
        <button type="button" class="btn btn-primary" onclick="loadXMLfile()">Load XML file</button>
        <div id="product">
        </div>
    </div>
</body>

</html>

<script>
    const loadProduct = () => {
        let xhttp = new XMLHttpRequest();
        let html;
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("product").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "../backend/routes/products.php", true);
        xhttp.send();

    }
    const loadProductWithId = () => {
        const id = 6;
        let xhttp = new XMLHttpRequest();
        let html;
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("product").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", `../backend/routes/products.php?id=${id}`, true);
        xhttp.send();
    }
    const loadXMLfile = () => {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                xmlDoc = xhttp.responseXML;
                txt = "";
                x = xmlDoc.getElementsByTagName("ARTIST");
                for (i = 0; i < x.length; i++) {
                    txt += x[i].childNodes[0].nodeValue + "<br>";
                }
                document.getElementById("product").innerHTML = txt;
            }
        }
        xhttp.open("GET", "../cd_catalog.xml", true);
        xhttp.send();
    }
</script>