@extends('layouts.app')
<!--as it is paste the all content of Article.blade.php and write extra few codes for edit -->

@section('headSection')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/select2/select2.min.css')}}">

@endsection()


@section('main-content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @include('layouts.pageHead')
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Editors</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
			
			   <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Titles</h3>
            </div>
           <!-- @if (count($errors) > 0)
              @foreach($errors->all() as $error)
              <p class="alert alert-danger">{{ $error }}</p>
              @endforeach
            @endif  or to write this code we can create a separate file and include it -->
           @include('includes.messages')
            <!-- form start -->
            <form role="form" action="{{ route('article.update', $article->id) }}" method="Article" enctype="multipart/form-data">              
              {{ csrf_field() }}
              {{ method_field('PUT')}}
              
              <div class="box-body">
              	<div class="col-md-6">  

              	<div class="form-group">
                  <label for="title">Article-Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $Article->title }}">
                </div>              
            
                <div class="form-group">
                  <label for="slug">Article Slug</label>
                  <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $Article->slug }}">
                </div>

              	</div>  

            	<div class="col-md-6">
            		<div class="form-group">
                  <div class="pull-right">
                  <label for="image">File input</label>
                  <input type="file" name="image" id="image">
                  </div>
                  <div class="checkbox" class="pull-left">
                    <label>
                  <input type="checkbox" name="status" value="1" @if ($article->status==1)
                  {{'checked'}} 
                  @endif> Publish
                    </label>
                  </div>
                </div>
              <br>
    
      <div class="form-group" style="margin-top:18px;">
                <label>Select Likes</label>
                <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" tabindex="-1" aria-hidden="true" name="likes[]">
                  @foreach($likes as $like)
                  <option value="{{ $like->id }}"
                    @foreach($Article->likes as $articlelike)
                      @if($articlelike->id == $like->id)
                        selected
                      @endif
                    @endforeach
                    >{{ $like->name}}</option>
                  @endforeach
                  </select>
              </div>  
                <!--for categories -->
              <div class="form-group" style="margin-top:18px;">
                <label>Select Categories</label>
                <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" tabindex="-1" aria-hidden="true" name="categories[]">
                 @foreach($categories as $category)
                  <option value="{{ $category->id }}"
                      @foreach($article->categories as $articleCategory)
                      @if($articleCategory->id == $category->id)
                        selected
                      @endif
                    @endforeach
                    >{{ $category->name}}</option>
                  @endforeach
                  </select>
              </div>   

            	</div>
            	 
              </div>
              <!-- /.box-body -->
              <div class="box">
            <div class="box-header">
              <h3 class="box-title">Write Article
                <small>Simple and fast</small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
              <!-- /. tools -->
              </div>
            <!-- /.box-header -->

          
            <div class="box-body pad">
            <textarea class="textarea" placeholder="Place some text here" name="body" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="editor1">{{ $Article->body }}
              
            </textarea>
            
            </div>
            
            
          </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-round btn-success">Submit</button>
                <a href="{{route('Article.index')}}" class="btn btn-warning">Back</a>

              </div>
          </form>
            
          </div>
                   
          <!-- /.box -->

          
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
@endsection()


@section('footerSection')

<script src="{{asset('admin/plugins/select2/select2.full.min.js')}}"></script>
<!-- CKeditor-->
<!--<script src="//cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>  instead of this we can use other method new downloaded file code below-->
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1');
    });
</script>
<script>
  
  $(document).ready(function() {
    $(".select2").select2();
  });
</script>

@endsection()