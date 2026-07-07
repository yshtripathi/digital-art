@extends('errors.layout')

@php
    $title = '404 - Not Found | Inkwave';
@endphp

@section('code', '404')
@section('message', 'Page Not Found')
@section('description', 'We couldn\'t find the page you were looking for. It might have been moved, deleted, or never existed in the first place.')