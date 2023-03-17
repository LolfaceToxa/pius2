<h1>Tag</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>name</th>
            <th>post_id</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tags as $tag)
            <tr>
                <td>{{$tag['id']}}</td>
                <td>{{$tag['name']}}</td>
                <td>{{$tag['post_id']}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
