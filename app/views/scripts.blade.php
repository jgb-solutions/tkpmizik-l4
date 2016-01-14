{{-- <script src="/js/lib/jquery.min.js"></script>
<script src="/js/lib/jquery.form.min.js"></script>
<script src="/js/lib/bootstrap.min.js"></script>
<script src="/js/lib/underscore.min.js"></script>
<script src="/js/lib/backbone.min.js"></script>
<script src="/js/lib/berniecode-animator.js"></script>
<script src="/js/lib/soundmanager2.js"></script>
<script src="/js/lib/360player.js"></script>
<script src="/js/source/bb-search.js"></script>
<script src="/js/source/app.js"></script> --}}

@if (App::environment() == 'local')
<script src="/js/app.js"></script>
@else
<script src="//tkpmizik.jgbcdn.ml/js/app.js"></script>
@endif