<form id="shortenForm" action="{{ route('shorten') }}" method="POST">
    @csrf
    <input type="text" id="urlInput" name="url" placeholder="Enter URL to shorten">
    <button type="submit">Shorten URL</button>
</form>

<div id="shortenedUrlContainer" style="display: none;">
    Shortened URL: <span id="shortenedUrl"></span>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#shortenForm').submit(function(event) {
            event.preventDefault();

            var urlInput = $('#urlInput').val();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: {
                    _token: $('input[name="_token"]').val(),
                    url: urlInput
                },
                success: function(data) {
                    $('#shortenedUrl').text(data.shortenedUrl);
                    $('#shortenedUrlContainer').show();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>