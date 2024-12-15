@extends('szablon.szablon')
@section('tytul','Lista postów')
@section('podtytul', 'Lista postów')
@section('tresc')
@auth
<a href="{{route('post.create')}}"><button class="btn btn-primary form-btn m-2" type="button">Dodaj post</button></a>    
@endauth

<table class="table table-striped">
    <thead>
        <th scope="col">Lp</th>
        <th scope="col">Tytuł</th>
        <th scope="col">Autor</th>
        <th scope="col">Data utworzenia</th>
        @auth
        <th scope="col">Akcja</th>            
        @endauth
    </thead>
    <tbody>
        @isset($posty)
            @if ($posty->count())
            @php($lp=1)
            @php($lp=$posty->firstItem())
                @foreach ($posty as $post)
                <tr>
                    <td>{{$lp++}}</td>
                    <td><a href="{{route('post.show',$post->id)}}">{{$post->tytul}}</a></td>
                    <td>{{$post->autor}}</td>
                    <td>{{date('j F Y',strtotime($post->created_at))}}</td>
                    @auth
                    <td class="d-flex">
                        <a href="{{route('post.edit',$post->id)}}">
                            <button type="button" class="btn btn-success form-btn m-1">E</button>
                        </a>
                        <form action="{{route('post.destroy',$post->id)}}" method="post" onsubmit="return confirmDelete()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger form-btn m-1">X</button>
                        </form>
                    </td>                        
                    @endauth

                </tr>
                @endforeach 
            @else
            <tr>
                <th scope="row" colspan="5" class="text-center">Nie ma żadnych postów</th>
            </tr>
            @endif
        @else
        <tr>
            <th scope="row" colspan="5" class="text-center">Nie ma żadnych postów</th>
        </tr>
        @endisset
    </tbody>
</table>
@isset($posty)
    {{$posty->links()}}
@endisset
<script>
    function confirmDelete()
    {
        return confirm('Czy na pewno usunąc posta?');
    }
</script>
@endsection