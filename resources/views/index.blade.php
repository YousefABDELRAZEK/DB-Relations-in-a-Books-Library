<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Validation Errors */
        .validation-error {
            background-color: #ffebee;
            border: 1px solid #e53935;
            color: #e53935;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 4px;
        }

        .validation-error ul {
            list-style-type: disc;
            margin-left: 1.5rem;
        }

        /* Books List */
        .books-list {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
            margin-bottom: 2rem;
        }

        .books-list h2 {
            font-size: 1.5rem;
            font-weight: bold;
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .books-list table {
            width: 100%;
            border-collapse: collapse;
        }

        .books-list th,
        .books-list td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }

        .books-list th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        /* Forms */
        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-container h2 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .form-container form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 1rem;
        }

        .form-container label {
            font-weight: bold;
        }

        .form-container input,
        .form-container select {
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
        }

        .form-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Library Management</h1>

        <!-- Show validation errors -->
        @if ($errors->any())
            <div class="validation-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Books List -->
        <div class="books-list">
            <h2>Books List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Categories</th>
                        <th>Published Year</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author->name }}</td>
                        <td>
                            @foreach ($book->categories as $category)
                                {{ $category->name }}@if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td>{{ $book->year }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Add New Book -->
        <div class="form-container">
            <h2>Add New Book</h2>
            <form action="{{ route('library.add') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="book">
                <div>
                    <label for="title">Title</label>
                    <input type="text" name="title" required>
                </div>
                <div>
                    <label for="author_id">Author</label>
                    <select name="author_id" required>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="categories">Categories</label>
                    <select name="categories[]" multiple>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="year">Published Year</label>
                    <input type="number" name="year" required>
                </div>
                <button type="submit">Add Book</button>
            </form>
        </div>

        <!-- Add New Author -->
        <div class="form-container">
            <h2>Add New Author</h2>
            <form action="{{ route('library.add') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="author">
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" required>
                </div>
                <button type="submit">Add Author</button>
            </form>
        </div>

        <!-- Add New Category -->
        <div class="form-container">
            <h2>Add New Category</h2>
            <form action="{{ route('library.add') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="category">
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" required>
                </div>
                <button type="submit">Add Category</button>
            </form>
        </div>
    </div>
</body>
</html>
