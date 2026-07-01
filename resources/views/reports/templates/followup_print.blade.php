@extends('layouts.print')

@section('content')
    @include('reports.templates.followup', ['records' => $records])
@endsection
