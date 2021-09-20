@extends("layouts.master")​
@Section("title")​
    <title>{{$title}}</title>
@endsection
@Section("content")​
    <h1>{{$title}}</h1>
    {{ Form::open(array('url' => $url, 'method' => $method)) }}
        {{csrf_field()}}
        <input type="text" name="name" value="{{$element->name}}"/>
        <input type="text" name="description" value="{{$element->description}}"/>
        <select name="data" multiple>
        @if ($listSelected!=null)
            @foreach($listSelected as $value)​
                <option value="{{$value->id}}">{{$value->name}}</option>
            @endforeach
        @endif
        @if ($list!=null)
            @foreach($list as $value)​
                <option value="{{$value->id}}">{{$value->name}}</option>
            @endforeach
        @endif
        </select>
        <input type="submit" value="Submit"/>
    {{ Form::close() }}
@endsection
