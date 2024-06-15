<!-- resources/views/search_results.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            background-color: #007bff;
            color: #fff;
        }

        header img {
            max-height: 40px;
            border-radius: 50%;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 1rem;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-size: 1.2rem;
        }

        a:hover {
            text-decoration: underline;
        }

        #search-bar {
            display: flex;
            align-items: center;
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
            position: relative;
        }

        #search-bar input[type="text"] {
            width: 80%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            margin-right: 10px;
        }

        #search-bar button {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #search-bar button:hover {
            background-color: #218838;
        }

        #autocomplete-list {
            position: absolute;
            top: 50px;
            left: 0;
            right: 0;
            border: 1px solid #ddd;
            background-color: #fff;
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
            color:black;
        }

        #autocomplete-list div {
            padding: 10px;
            cursor: pointer;
        }

        #autocomplete-list div:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <div>
            <h1>Todo List App</h1>
        </div>
        <div id="search-bar">
            <form id="search-form" action="{{ route('product.search') }}" method="GET">
                <input type="text" name="query" placeholder="Search..." id="search-input" oninput="showSuggestions(this.value)" />
            </form>
            <button type="button" onclick="document.getElementById('search-form').submit();">Search</button>
            <div id="autocomplete-list"></div>
        </div>
    </div>
</header>

<div class="container">
    <h1>Search Results</h1>
    @if($products->isEmpty())
        <p>No products found.</p>
    @else
        <ul>
            @foreach($products as $product)
                <li><a href="{{ route('product.edit', $product->id) }}">{{ $product->task }}</a></li>
            @endforeach
        </ul>
    @endif
</div>

<script>
    function showSuggestions(query) {
        if (query.length === 0) {
            document.getElementById('autocomplete-list').innerHTML = '';
            return;
        }

        fetch(`{{ route('product.suggestions') }}?query=${query}`)
            .then(response => response.json())
            .then(data => {
                let suggestions = data.map(item => `<div onclick="selectSuggestion('${item}')">${item}</div>`).join('');
                document.getElementById('autocomplete-list').innerHTML = suggestions;
            });
    }

    function selectSuggestion(value) {
        document.getElementById('search-input').value = value;
        document.getElementById('autocomplete-list').innerHTML = '';
        document.getElementById('search-form').submit();
    }
</script>
</body>
</html>
