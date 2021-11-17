{{ $content }}
<hr class="mb-0">
<ul class="list-unstyled list-group-flush">
    <li><b>Data</b>: {{ $date }}</li>
    <li><b>Nick</b>: {{ $nick }}</li>
    <li><b>Tag</b>: {{ $keyword }}</li>
    <li><b>Domena</b>: {{ $website }}</li>
    <li><b>URL</b>: <a href="{{ $url }}" target="_blank"><i class="fe-link"></i></a></li>
</ul>
@if($file && $category == 'produktowy')
    <hr>
    <img src="{{ asset('/uploads/posts/'.$file) }}" alt="">
@endif
@if($file && $category == 'film')
    <hr>
    <video width="320" height="240" controls>
        <source src="{{ asset('/uploads/posts/'.$file) }}">
        Your browser does not support the video tag.
    </video>
    <style>
        video {
            width: 100%;
            height: auto;
        }
    </style>
@endif
