<!DOCTYPE html>
<html>
<head>
    <title>New Book Uploaded</title>
</head>
<body>
    <h1>New Book: {{ $book->name }} has been uploaded!</h1>
    <p>Author: {{ $book->author }}</p>
    <p>Category: {{ $book->category_name }}</p>
    <p>Description: {{ $book->description }}</p>
</body>
</html>
