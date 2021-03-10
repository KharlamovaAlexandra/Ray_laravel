<!DOCTYPE html>
<html>
<head>
    <title>laravel 6 image upload example — ItSolutionStuff.com.com</title>
    <link rel=«stylesheet» href=«getbootstrap.com/dist/css/bootstrap.css»>
</head>

<body>
<div class=«container»>


            <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class=«row»>

                    <div class=«col-md-6»>
                        <input type="text" name="id" class="form-control">
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class=«col-md-6»>
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>

                </div>
            </form>


        </div>
    </div>
</div>
</body>

</html>
