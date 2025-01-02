<!DOCTYPE html>
<html>
<head>
    <title>New Blog Post</title>
</head>
<body>
    <h1>{!! decrypt($blog->title) !!}</h1>
    <p>{!! decrypt($blog->description) !!}</p>
    <p>Check it out!</p>
    <div class="row">
        <div class="col-md-6">
            <a href="{{ url('/blog',Crypt::encrypt($blog->id))  }}" class="btn btn-primary">View Blog Post</a>
                </div>
            <div class="col-md-6">

                <a href="{{ url('blog/unsubscribe') }}" class="btn btn-warning">Click to Unsubscribe Blogs</a>
            </div>


    </div>
</body>
</html>
