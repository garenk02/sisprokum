<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ $title }}</title>
    </head>
    <body>
        <script src="/pdfobject.min.js"></script>
        <script>PDFObject.embed("{{ asset('storage/public/uploads/files/'.$file) }}", document.body);</script>
    </body>
</html>
