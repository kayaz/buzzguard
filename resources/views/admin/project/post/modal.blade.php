{{ $content }}
@if($file && $category == 'produktowy')
    <hr>
    <img src="{{ asset('/uploads/posts/{{ $file }}') }}" alt="">
@endif
@if($file && $category == 'film')
    <hr>
    <video width="320" height="240" controls>
        <source src="{{ asset('/uploads/posts/{{ $file }}') }}">
        Your browser does not support the video tag.
    </video>
    <style>
        video {
            width: 100%;
            height: auto;
        }
    </style>
@endif
