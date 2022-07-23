<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Telkomsel | @yield("title")</title>

  @include("layouts.header")
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include("layouts.navbar")

    @include("layouts.sidebar")

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-color: beige">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">@yield("page_title")</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item" style="color: black" !important>Home</li>
                <li class="breadcrumb-item" style="color: black">@yield("title")</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          @yield("content")
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      {{-- <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div> --}}
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer" style="background-image: linear-gradient(to left,#800000,red)">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
       <strong>Partner Your Provider</strong>
      </div>
      <!-- Default to the left -->
      <strong>Telkomsel Branch Madiun &copy;2022</strong>
    </footer>
  </div>
  <!-- ./wrapper -->

  @include("layouts.footer")

</body>
</html>
