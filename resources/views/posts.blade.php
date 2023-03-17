<h1>All posts</h1>
<h2>
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