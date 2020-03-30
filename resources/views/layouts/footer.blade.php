<!-- footer content -->
<footer>
  <div class="pull-right">
  {{ isset($source) && $source == "app" ? config('app.initial') : config('app.initial')." | ".config('app.name') }} &copy; 2017~{{ date('Y') }} HR
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
