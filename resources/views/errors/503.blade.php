@extends('errors.layout')

@php
    $title = '503 - Service Unavailable | Inkwave';
@endphp

@section('code', '503')
@section('message', 'Service Unavailable')
@section('description', 'We are currently undergoing routine maintenance to improve your gallery experience. We\'ll be back shortly!')