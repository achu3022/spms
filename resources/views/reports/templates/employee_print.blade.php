@extends('layouts.print')

@section('content')
    @include('reports.templates.employee', ['records' => $records])
@endsection
