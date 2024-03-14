<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Scraper</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }

        div:has(input[type="checkbox"]:checked) + div [data-nofollow="true"] {
            display: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form action="{{ route('crawler') }}" method="GET">
                <div class="form-group
                {{ $errors->has('url') ? 'has-error' : '' }}">
                    <label for="url">
                        Enter URL
                    </label>
                    <input type="text" name="url" id="url" class="form-control" placeholder="Enter URL">
                    @if ($errors->has('url'))
                        <span class="help-block text-danger">
                            {{ $errors->first('url') }}
                        </span>
                    @endif
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-success" type="submit">Crawl</button>
                </div>
            </form>
            <label for="nofollow" class="inline">Hide Nofollow links</label>
            <input type="checkbox" id="nofollow" name="nofollow" class="checkbox checkbox-inline" value="1">
        </div>
        <div class="col-md-6 col-md-offset-3">
            @if (!empty(request('url')))
                @forelse($links as $link)
                    <div class="alert alert-success" data-nofollow="{{ $link['nofollow'] }}">
                        <a href="{{ $link['href'] }}" style="word-wrap: break-word">{{ $link['href'] }}</a>
                    </div>
                @empty
                    <div class="alert alert-danger">
                        No links found.
                    </div>
                @endforelse
            @endif
        </div>
    </div>
</div>
</body>
</html>
