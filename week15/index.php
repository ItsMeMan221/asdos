<!DOCTYPE html>
<html lang="en">
<?php include './static/head.php' ?>

<body>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Judul</th>
                </tr>
            </thead>
            <tbody id='artikel'>
            </tbody>
        </table>
    </div>

</body>

</html>

<script>
    $(document).ready(function() {

        const getAllArtikel = () => {
            let content = ""
            let no = 1;
            $.ajax({
                type: "GET",
                url: "./backend/artikel.php",
                data: "",
                dataType: "JSON",
                success: function(response) {
                    for (x in response) {
                        const judulClean = response[x].judul
                        const result = judulClean.replaceAll(" ", "-")
                        content += `<tr>
                                        <td>${no}</td>
                                        <td><a href='news/${response[x].id}/${result}'>${response[x].judul}</a></td>
                                    </tr>`
                        no++;
                    }
                    $('#artikel').html(content);
                }
            });
        }
        getAllArtikel();

    })
</script>