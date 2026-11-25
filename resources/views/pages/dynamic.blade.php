@extends('layouts.app')
@section('content')
@foreach($page->sections as $section)
  @php $c = $section->c(); @endphp
  @includeFirst(['sections.'.$section->type, 'sections.text_block'], ['c' => $c, 'section' => $section])
@endforeach
@endsection
