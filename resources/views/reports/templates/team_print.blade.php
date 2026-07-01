@extends('layouts.print')

@section('content')
    @include('reports.templates.team', ['records' => $records])
@endsection
