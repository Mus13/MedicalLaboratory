@extends("layouts.master")​
@Section("title")​
    <title>{{$title}}</title>
@endsection
@Section("content")​
    <h1>{{$title}}</h1>
    <a href="{{$url.'form/create'}}">Add new </a>
    <table>
    @foreach($data as $value)​
        <tr>
            <td>{{$value->id}}</td>
            <td>{{$value->name}}</td>
            <td>{{$value->description}}</td>
            <td>
                <select>
                @foreach($value->listBelongTo as $valueBelongs)​
                    @if ($valueBelongs!=null)
                        <option value="{{$valueBelongs->id}}">{{$valueBelongs->name}}</option>
                    @endif
                @endforeach
                </select>
            </td>
            <td>
                <a href="{{$url.'id/'.$value->id}}">display</a>
            </td>
            <td>
                <a href="{{$url.'downoald/'.$value->id}}">download</a>
            </td>
            <td>
                <a href="{{$url.'form/edit/'.$value->id}}">edit</a>
            </td>
            <td>
                {{ Form::open(array('url' => $url.'delete/'.$value->id, 'method' => 'DELETE')) }}
                    <input type="submit" value="delete"/>
                {{ Form::close() }}
            </td>
        </tr>
    @endforeach
    </table>
@endsection