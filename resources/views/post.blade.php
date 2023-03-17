<h1>Post</h1>

<form>
        <div>
            <h4>
                Post title
            </h4>
            <input id="title" type="text" name="title" value="{{ $filters['title'] ?? '' }}">
        </div>
        <div>
            <h4>
                Symbol code
            </h4>
            <input id="code" type="text" name="code" value="{{ $filters['code'] ?? '' }}">
        </div>
        <div>
             <h4>
                Tag
            </h4>
            <input id="tag" type="text" name="tag" value="{{ $filters['tag'] ?? '' }}">
        </div>
        <div>
            <h4>
                
            </h4>
            <input type="submit" value="Search">
        </div>
    </form>


<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>title</th>
        <th>code</th>
        <th>text</th>
        <th>date</th>
        <th>author</th>
    </tr>
@foreach($posts as $post)
    <tr>
        <td>{{$post['id']}}</td>
        <td>{{$post['title']}}</td>
        <td>{{$post['code']}}</td>
        <td>{{$post['text']}}</td>
        <td>{{$post['date']}}</td>
        <td>{{$post['author']}}</td>
    </tr>
@endforeach
</table>

<div class="text-center">
    @if($prev_url)
        <a class="btn btn-primary m-10" href="{{ route('post.index', $prev_url) }}">Previous</a>
    @endif
    @if($next_url)
        <a class="btn btn-primary m-10" href="{{ route('post.index', $next_url) }}">Next</a>
    @endif
</div>