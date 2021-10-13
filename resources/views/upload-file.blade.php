<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Upload Millions records</title>
</head>

<body>
 
<div class="container">
 {{-- <form action="/upload" method="post" enctype="multipart/form-data"> --}}
<form enctype="multipart/form-data" id="mycsv">
@csrf
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Upload CSV file</label>
  <input class="form-control form-control-sm" id="formFileLg" name="mycsv" type="file">
  {{-- <input type="submit" value="Upload"> --}}
        <input type="button" class="btn btn-primary" value="upload" id='uploadcsv' />
</div>
  </form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $("#uploadcsv").click(function() {
                var postData = new FormData($("#mycsv")[0]);

                $.ajax({
                    type: 'POST',
                    url: '/upload',
                    processData: false,
                    contentType: false,
                    data: postData,
                    success: function(data) {
                        console.log("File Uploaded" + data.progress);
                    },
                    error: function(data) {
                        console.log("nope");
                    }

                });


            });

        })
    </script>
</body>

</html>
