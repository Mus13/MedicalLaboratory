@extends("layouts.master")​
@Section("title")​
    <title>{{$title}}</title>
@endsection
@Section("content")​
    <h1>{{$title}}</h1>
    <div>
        <div>{{$value->id}}</div>
        <div>{{$value->name}}</div>
        <div>{{$value->description}}</div>
        <div>
            <select>
            @foreach($value->listBelongTo as $valueBelongs)​
                @if ($valueBelongs!=null)
                    <option value="{{$valueBelongs->id}}">{{$valueBelongs->name}}</option>
                @endif
            @endforeach
            </select>
        </div>
        <div>
            <a href="{{$url.'downoald/'.$value->id}}">download</a>
        </div>
    </div>
    <a href="/index">Home</a>
@endsection