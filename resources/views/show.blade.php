@extends('layout')

@section('content')
    <div id="show">
        <button type="button" class="btn btn-warning btn-lg mt-3" onclick="loadSecret();" id="load">
            <i class="fas fa-user-secret fa-fw"></i>
            Show This Secret
        </button>
    </div>
    <script type="text/javascript">
        function loadSecret() {
            $('#load i').removeClass('fa-user-secret').addClass('fa-sync-alt fa-spin').attr('disabled', 'disabled');
            $.get('{{ route('load', $secret) }}', function(secret) {
                $('#show').html(secret);
                $('#copy').click(copySecret);
                if ($('#file_contents').length) {
                    var data = new Blob(atob(fileContents), {
                        type: fileMime
                    });
                    var url = window.URL.createObjectURL(data);
                    $('#download').href = url;
                }
            }).fail(function() {
                $('#show').html(
                    '<p class="text-danger">Whoops, that secret has already been destroyed.</p><p><a class="btn btn-primary" href="{{ route('home') }}"><i class="fas fa-redo fa-fw"></i> Share Another Secret</a></p>'
                    );
            });
        }

        function copySecret() {
            var $secret = $('#secret');
            $secret.select();
            document.execCommand("copy");
        }
        const b64toBlob = (b64Data, contentType = '', sliceSize = 512) => {
            const byteCharacters = atob(b64Data);
            const byteArrays = [];

            for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
                const slice = byteCharacters.slice(offset, offset + sliceSize);

                const byteNumbers = new Array(slice.length);
                for (let i = 0; i < slice.length; i++) {
                    byteNumbers[i] = slice.charCodeAt(i);
                }

                const byteArray = new Uint8Array(byteNumbers);
                byteArrays.push(byteArray);
            }

            const blob = new Blob(byteArrays, {
                type: contentType
            });
            return blob;
        }
    </script>
@endsection
