{{ $content }}
@if($file && $category == 'produktowy')
    <hr>
    <img src="/uploads/posts/{{ $file }}" alt="">
@endif
@if($file && $category == 'film')
    <hr>
    <video width="320" height="240" controls>
        <source src="/uploads/posts/{{ $file }}">
        Your browser does not support the video tag.
    </video>
    <style>
        video {
            width: 100%;
            height: auto;
        }
    </style>
@endif
