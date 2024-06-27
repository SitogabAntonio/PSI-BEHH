@extends('view.home_layouts.app')
@section('styles')
@endsection
@section('content')

<section class="page-title bg-1">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block text-center">
          <h1 class="text-capitalize mb-5 text-lg">Ibadah Raya</h1>

          <!-- <ul class="list-inline breadcumb-nav">
            <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
            <li class="list-inline-item"><span class="text-white">/</span></li>
            <li class="list-inline-item"><a href="#" class="text-white-50">All Department</a></li>
          </ul> -->
        </div>
      </div>
    </div>
  </div>
</section>


<section class="section service-2">
	<div class="container">

		<div class="row">
			<div class="col-lg-4 col-md-6 ">
                @foreach ($raya as $value)
				<div class="department-block mb-5">
					<img src="{{asset('storage/'.$value->gambar)}}" alt="" class="img-fluid w-100" style="height:30vh; width:10vw; border-radius:25px;">
					<div class="content">
						<h4 class="mt-4 mb-2 title-color">{{$value->judul}}</h4>
						<p class="mb-4">{{$value->tema}}</p>
						<a href="{{url('view/acara/ibadah_raya_single')}}" class="read-more">Selengkapnya  <i class="icofont-simple-right ml-2"></i></a>
					</div>
				</div>
                @endforeach
			</div>
		</div>
	</div>
</section>

@endsection
@section('script')
@endsection