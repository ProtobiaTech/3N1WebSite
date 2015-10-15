<!-- simditor -->
<link rel="stylesheet" type="text/css" href="{{ asset('/bowerAssets/simditor/styles/simditor.css') }}">
<script type="text/javascript" src="{{ asset('/bowerAssets/simple-module/lib/module.js') }}"></script>
<script type="text/javascript" src="{{ asset('/bowerAssets/simple-hotkeys/lib/hotkeys.js') }}"></script>
<script type="text/javascript" src="{{ asset('/bowerAssets/simple-uploader/lib/uploader.js') }}"></script>
<script type="text/javascript" src="{{ asset('/bowerAssets/simditor/lib/simditor.js') }}"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('/bowerAssets/simditor-emoji/styles/simditor-emoji.css') }}">
<script type="text/javascript" src="{{ asset('/bowerAssets/simditor-emoji/lib/simditor-emoji.js') }}"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('/bowerAssets/simditor-markdown/styles/simditor-markdown.css') }}">
<script type="text/javascript" src="{{ asset('/bowerAssets/marked/lib/marked.js') }}"></script>
<script type="text/javascript" src="{{ asset('/bowerAssets/to-markdown/dist/to-markdown.js') }}"></script>
<script type="text/javascript" src="{{ asset('/bowerAssets/simditor-markdown/lib/simditor-markdown.js') }}"></script>


<!-- simditor -->
<script>
if (typeof simditorToolbar === 'undefined') {
    var simditorToolbar = [
        'title', 'bold', 'italic', 'underline', 'strikethrough', 'color', '|',
        'indent', 'outdent', 'alignment', 'ol', 'ul', 'blockquote', 'table', 'hr', '|',
        'link', 'image', 'code', '|',
        'emoji', 'markdown',
    ];
}

var editor = new Simditor({
    textarea: $('#simditor'),
    toolbar: simditorToolbar,
    emoji: {
        imagePath: '/bowerAssets/simditor-emoji/images/emoji/'
    },
    defaultImage: '/simditor-upload/default.jpg',
    upload: {
        url: '/simditor-img-upload',
        params: {'_token': '{{ csrf_token() }}'},
        fileKey: 'img',
    },
    breaks: true,
});

// markdown setting
marked.setOptions({
  renderer: new marked.Renderer(),
  gfm: true,
  tables: true,
  breaks: true,
  pedantic: false,
  sanitize: true,
  smartLists: true,
  smartypants: false
});
</script>
