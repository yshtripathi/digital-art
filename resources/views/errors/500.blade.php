@extends('errors.layout')

@php
    $title = '500 - Server Error';
@endphp

@section('code', '500')
@section('message', 'Internal Server Error')
@section('description', 'Oops, something went wrong on our end. Our curators are looking into the issue. Please try again later.')