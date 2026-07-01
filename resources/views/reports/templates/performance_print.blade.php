@extends('layouts.print')

@section('content')
    @include('reports.templates.performance', ['records' => $records])
@endsection
