@extends('layouts.guest')

@section('title', 'Selamat Datang di Qalsum Education Center')

@section('content')
    @include('home.section.home')
    @include('home.section.programkursus')
    @include('home.section.jadwalkursus')
    @include('home.section.galeri')
    @include('home.section.agenda')
    @include('home.section.berita')
    @include('home.section.profil')
    @include('home.section.syarat')
    
@endsection
