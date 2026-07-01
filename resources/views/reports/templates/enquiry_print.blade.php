@extends('layouts.print')

@section('content')
    @include('reports.templates.enquiry', ['records' => $records])
@endsection
