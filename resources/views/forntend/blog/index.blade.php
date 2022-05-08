@extends('layouts.forntend')
@section('title','Blog')
@section('sub_title','Our Recent Blog')
@section('content')
<!-- Page Content -->
<!-- Banner Starts Here -->
<section class="blog-posts grid-system">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="all-blog-posts">
          <div class="row">
            @if($blogs->count()>0)
            @foreach($blogs as $blog)

            <div class="col-lg-6">
              <div class="blog-post">
                <div class="blog-thumb">
                  <img src="{{ url('upload/images', $blog->image) }}" alt="{{ $blog->img_alt }}">
                </div>
                <div class="down-content">
                  <span>{{ $blog->category['name']}}</span>
                  <a href="{{ route('blog.show',$blog->slug) }}"><h4>Donec tincidunt leo</h4></a>
                  <ul class="post-info">
                    <li><a href="#">Admin</a></li>
                    <li><a href="#">{{ date('d-F-Y', strtotime($blog->created_at)) }}</a></li>
                    <li><a href="#">12 Comments</a></li>
                  </ul>
                  <p>{{ $blog->meta_discription }}</p>
                  <div class="post-options">
                    <div class="row">
                      <div class="col-lg-12">
                        <ul class="post-tags">
                         @php
                         $tag = explode(',', $blog->tags);
                         @endphp
                         <ul class="post-tags">
                          <li><i class="fa fa-tags"></i></li>
                          @foreach($tag as $data)
                          <li><a href="#">{{ $data }}</a>,</li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach


            <div class="col-lg-12">
              {{ $blogs->links() }}
            </div>
            @else
            <div class="col-lg-12">
              NO BLOG FOUND!!!
            </div>
            @endif
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        @include('forntend.partials.sidebar')
      </div>
    </div>
  </div>
</section>

@endsection