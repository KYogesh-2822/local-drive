
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script src="{{asset('admin/js/bundle.min.js')}}"></script>
<script src="{{asset('admin/js/custom.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>

<!-- For Developer use -->
<script src="{{asset('admin/js/developer.js')}}"></script>

<script>
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

<script>
    document.querySelectorAll('[data-rich-text-editor]').forEach(function (element) {
        ClassicEditor.create(element, {
            toolbar: [
                'heading', '|', 'bold', 'italic', 'link', '|',
                'bulletedList', 'numberedList', 'blockQuote', 'insertTable', '|',
                'undo', 'redo'
            ]
        }).catch(function (error) {
            console.error(error);
        });
    });
</script>

</body>

</html>
