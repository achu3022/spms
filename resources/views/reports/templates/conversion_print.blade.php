@extends('layouts.print')

@section('content')
    @include('reports.templates.conversion', ['records' => $records])
@endsection
