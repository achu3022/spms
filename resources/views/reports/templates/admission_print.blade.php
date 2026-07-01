@extends('layouts.print')

@section('content')
    @include('reports.templates.admission', ['records' => $records])
@endsection
