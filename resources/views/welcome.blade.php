<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>
<body>


    <form enctype="multipart/form-data">
        <input type="file" name="image" id="image">
        <button type="button" onclick="uploadImage()">Upload</button>
    </form>


    <img id="image-preview" src="" alt="">


    <button type="button" onclick="approveImage(id, 'approved')">Approve</button>

    <button type="button" onclick="approveImage(id, 'rejected')">Reject</button>

    <script>

function uploadImage() {
    var formData = new FormData();
    formData.append('image', $('#image')[0].files[0]);

    $.ajax({
        url: '/upload-image',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            // Display the uploaded image on the page
            $('#image-preview').attr('src', response.image_url);
        },
        error: function() {
            alert('Error uploading image');
        }
    });
}



function approveImage(id, status) {
    $.ajax({
        url: '/approve-image/' + id,
        type: 'PUT',
        data: {
            status: status
        },
        success: function(response) {
            alert(response.message);
        },
        error: function() {
            alert('Error updating image approval status');
        }
    });
}



    </script>




</body>
</html>
