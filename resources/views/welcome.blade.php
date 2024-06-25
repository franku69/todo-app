<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Gym App</title>
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
            background-color: blue;
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

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            text-decoration: none;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #218838;
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
            border-radius: 4px;
            background-color: #fff;
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
            color: black;
        }

        #autocomplete-list div {
            padding: 10px;
            cursor: pointer;
        }

        #autocomplete-list div:hover {
            background-color: #ddd;
        }

        #featured-products {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }

        .product {
            width: 48%;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }

        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product img {
            width: 100%;
            height: auto;
        }

        .product-info {
            padding: 15px;
        }

        .product-title {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .product-description {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
<header>
    <div class="container">
        <div>
            <h1>Gym List App</h1>
        </div>
        <div id="search-bar">
            <form id="search-form" action="{{ route('product.search') }}" method="GET">
                <input type="text" name="query" placeholder="Search..." id="search-input" oninput="showSuggestions(this.value)" />
            </form>
            <button type="button" onclick="document.getElementById('search-form').submit();">Search</button>
            <div id="autocomplete-list"></div>
        </div>
        <div>
            <a href="{{ route('product.upload') }}" class="btn">Upload List</a>
        </div>
    </div>
</header>

<div class="container">
    <h2>Main Things:</h2>
    <section id="featured-products">
    @forelse($products as $product)
    <div class="product">
        <img src="{{ asset('images/train.jpg') }}" alt="{{ $product->task }}">
        <div class="product-info">
            <h3 class="product-title">{{ $product->task }}</h3>
            <p class="product-description">{{ $product->description }}</p>
        </div>
    </div>
@empty
    <p>No products found.</p>
@endforelse
    </section>
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
